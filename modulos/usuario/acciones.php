<?php

require_once '../../config/db.php';
$tabla = 'usuario';
$obj = new DB();
switch ($_GET['accion']) {
    case 'verificar':
        $user   = $_POST['user'];
        $pass   = $_POST['pass'];
        $admin  = $obj->registroAdmin($tabla, $user, md5($pass));

        if (isset($admin)) {
            date_default_timezone_set('America/Lima');
            session_start();
            $_SESSION['id']     = $admin['id'];
            $_SESSION['user']   = $user;
            $_SESSION['pass']   = $pass;
            $_SESSION['nombre'] = $admin['name'];

            /* Modificamos el ultimo acceso del usuario */
            $last_login     = date("Y-m-d H:i:s");
            $tabla          = 'usuario';
            $arrColumnas    = array('last_login');
            $arrValores     = array($last_login);
            $resultado      = $obj->editarID($tabla, $arrColumnas, $arrValores, $admin['id']);

            header('location:../../panel.php');
        } else {
            header('location:../../index.php?error=yes');
        }
        break;

    case 'config':
        $id         = $_POST['usuario_id'];
        $nombre     = $_POST['nombre'];
        $rbpassword = $_POST['rbpassword'];

        if ($rbpassword == 'no') {
            $arrColumnas    = array('name');
            $arrValores     = array($nombre);
            $resultado      = $obj->editarID($tabla, $arrColumnas, $arrValores, $id);
            //echo $resultado;
        } elseif ($rbpassword == 'si') {
            $pw_nueva       = $_POST['pw_nueva'];
            $arrColumnas    = array('name', 'pass');
            $arrValores     = array($nombre, md5($pw_nueva));
            $resultado      = $obj->editarID($tabla, $arrColumnas, $arrValores, $id);
            //echo $resultado;
        }
        session_start();
        session_destroy();
        header('location:../../index.php');
        break;

    case 'nuevo':
        date_default_timezone_set('America/Lima');
        $usuario    = $_POST['usuario'];
        $contra     = $_POST['contra'];
        $nombre     = $_POST['nombre'];
        $rol        = $_POST['rol'];
        $created    = date("Y-m-d H:i:s");

        $arrColumnas    = array('user', 'pass', 'name', 'is_admin', 'created', 'last_login');
        $arrValores     = array($usuario, md5($contra), $nombre, $rol, $created, $created);
        $resultado      = $obj->nuevo($tabla, $arrColumnas, $arrValores);
        echo $resultado;
        break;

    case 'editar':
        $id         = $_POST['usuario_id'];
        $nombre     = $_POST['nombre'];
        $rol        = $_POST['rol'];
        $rbpassword = $_POST['rbpassword'];

        if ($rbpassword == 'no') {
            $arrColumnas    = array('name', 'is_admin');
            $arrValores     = array($nombre, $rol);
            $resultado      = $obj->editarID($tabla, $arrColumnas, $arrValores, $id);
            //echo $resultado;
        } elseif ($rbpassword == 'si') {
            $pw_nueva       = $_POST['pw_nueva'];
            $arrColumnas    = array('pass', 'name', 'is_admin');
            $arrValores     = array(md5($pw_nueva), $nombre, $rol);
            $resultado      = $obj->editarID($tabla, $arrColumnas, $arrValores, $id);
            //echo $resultado;
        }

        header('location:../../usuarios.php');
        break;

    case 'eliminar':
        $id = $_POST['usuario_id'];
        $obj->eliminarID($tabla, $id);
        header('location:../../usuarios.php');
        break;

    case 'cerrar':
        session_start();
        session_destroy();
        header('location:../../index.php');
        break;

    case 'respaldo':
        $tipo_resp = $_POST['tipo_resp'];
        //aca los parametros de conexion, si tienes aparte la conexión , solo incluyuela
        $usuario    = "root";
        $passwd     = "";
        $host       = "localhost";
        $bd         = "cecomp";

        date_default_timezone_set('America/Lima');
        $fecha = date("Ymd-His");
        $nombre = $bd . '_backup' . $fecha . '.txt'; //Este es el nombre del archivo a generar

        /* Determina si la tabla será vaciada (si existe) cuando  restauremos la tabla. */
        $drop = false;
        $tablas = false; //tablas de la bd
        // Tipo de compresion.
        // Puede ser "gz", "bz2", o false (sin comprimir)

        $compresion = false;

        /* Conexion */
        $conexion = mysql_connect($host, $usuario, $passwd)
                or die("No se puede conectar con el servidor MySQL: " . mysql_error());
        mysql_select_db($bd, $conexion)
                or die("No se pudo seleccionar la Base de Datos: " . mysql_error());
        /* Se busca las tablas en la base de datos */
        if (empty($tablas)) {
            $consulta = "SHOW TABLES FROM $bd;";
            $respuesta = mysql_query($consulta, $conexion)
                    or die("No se pudo ejecutar la consulta: " . mysql_error());
            while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
                $tablas[] = $fila[0];
            }
        }
        /* Se crea la cabecera del archivo */
        $info['dumpversion'] = "1.1b";
        $info['fecha'] = date("d-m-Y");
        $info['hora'] = date("h:m:s A");
        $info['mysqlver'] = mysql_get_server_info();
        $info['phpver'] = phpversion();
        ob_start();
        print_r($tablas);
        $representacion = ob_get_contents();
        ob_end_clean();
        preg_match_all('/(\[\d+\] => .*)\n/', $representacion, $matches);
        $info['tablas'] = implode(";  ", $matches[1]);
        $dump = <<<EOT
# +===================================================================
# |
# | Generado el {$info['fecha']} a las {$info['hora']}
# | Servidor: {$_SERVER['HTTP_HOST']}
# | MySQL Version: {$info['mysqlver']}
# | PHP Version: {$info['phpver']}
# | Base de datos: '$bd'
# | Tablas: {$info['tablas']}
# |
# +-------------------------------------------------------------------

EOT;
        foreach ($tablas as $tabla) {

            $drop_table_query = "";
            $create_table_query = "";
            $insert_into_query = "";

            /* Se halla el query que será capaz vaciar la tabla. */
            if ($drop) {
                $drop_table_query = "DROP TABLE IF EXISTS `$tabla`;";
            } else {
                $drop_table_query = "# No especificado.";
            }

            /* Se halla el query que será capaz de recrear la estructura de la tabla. */
            $create_table_query = "";
            $consulta = "SHOW CREATE TABLE $tabla;";
            $respuesta = mysql_query($consulta, $conexion)
                    or die("No se pudo ejecutar la consulta: " . mysql_error());
            while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
                $create_table_query = $fila[1] . ";";
            }

            /* Se halla el query que será capaz de insertar los datos. */
            $insert_into_query = "";
            $consulta = "SELECT * FROM $tabla;";
            $respuesta = mysql_query($consulta, $conexion)
                    or die("No se pudo ejecutar la consulta: " . mysql_error());
            while ($fila = mysql_fetch_array($respuesta, MYSQL_ASSOC)) {
                $columnas = array_keys($fila);
                foreach ($columnas as $columna) {
                    if (gettype($fila[$columna]) == "NULL") {
                        $values[] = "NULL";
                    } else {
                        $values[] = "'" . mysql_real_escape_string($fila[$columna]) . "'";
                    }
                }
                $insert_into_query .= "INSERT INTO `$tabla` VALUES (" . implode(", ", $values) . ");\n";
                unset($values);
            }

            if ($tipo_resp == "all") {
                $dump .= <<<EOT

# | Vaciado de tabla '$tabla'
# +------------------------------------->
$drop_table_query


# | Estructura de la tabla '$tabla'
# +------------------------------------->
SET FOREIGN_KEY_CHECKS=0;
$create_table_query
SET FOREIGN_KEY_CHECKS=1;


# | Carga de datos de la tabla '$tabla'
# +------------------------------------->
SET FOREIGN_KEY_CHECKS=0;
$insert_into_query
SET FOREIGN_KEY_CHECKS=1;

EOT;
            } elseif ($tipo_resp == "est") {
                $dump .= <<<EOT

# | Vaciado de tabla '$tabla'
# +------------------------------------->
$drop_table_query


# | Estructura de la tabla '$tabla'
# +------------------------------------->
SET FOREIGN_KEY_CHECKS=0;
$create_table_query
SET FOREIGN_KEY_CHECKS=1;

EOT;
            } else {
                $dump .= <<<EOT

# | Vaciado de tabla '$tabla'
# +------------------------------------->
$drop_table_query

# | Carga de datos de la tabla '$tabla'
# +------------------------------------->
SET FOREIGN_KEY_CHECKS=0;
$insert_into_query
SET FOREIGN_KEY_CHECKS=1;

EOT;
            }
        }

        /* Envio */
        if (!headers_sent()) {
            header("Pragma: no-cache");
            header("Expires: 0");
            header("Content-Transfer-Encoding: binary");
            switch ($compresion) {
                case "gz":
                    header("Content-Disposition: attachment; filename=$nombre.gz");
                    header("Content-type: application/x-gzip");
                    echo gzencode($dump, 9);
                    break;
                case "bz2":
                    header("Content-Disposition: attachment; filename=$nombre.bz2");
                    header("Content-type: application/x-bzip2");
                    echo bzcompress($dump, 9);
                    break;
                default:
                    header("Content-Disposition: attachment; filename=$nombre");
                    header("Content-type: application/force-download");
                    echo $dump;
            }
        } else {
            echo "<b>ATENCION: Probablemente ha ocurrido un error</b><br />\n<pre>\n$dump\n</pre>";
        }
        break;
}
