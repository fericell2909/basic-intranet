<?php
require_once '../../config/db.php';

$tabla = 'ficha';
$obj = new DB();
switch ($_GET['accion']) {
    case 'nuevo':
        /* Datos de la Ficha */
        date_default_timezone_set('America/Lima');

        //Asignamos id
        $id = idFicha();

        $curso_id   = $_POST['cbx_curso'];
        $creado     = date("Y-m-d H:i:s");
        $costo      = $_POST['costo_mes'];
        $horario    = $_POST['cbx_horario'];

        /* Datos del Voucher */
        $codigo_voucher = $_POST['cod_voucher'];
        $fecha_voucher  = $_POST['fecha_voucher'];

        /* Datos del Cliente */

        $valor_cliente = $_POST['valor_cliente'];

        $cliente_id         = $_POST['codigo']; 
        $condicion          = $_POST['cbx_condicion'];
        $apellidos          = $_POST['apellidos'];
        $nombres            = $_POST['nombres'];
        $fnacimiento        = $_POST['fnacimiento'];
        $cbx_distrito       = $_POST['cbx_distrito'];
        $sexo               = $_POST['sexo'];
        $domicilio          = $_POST['domicilio'];
        $email              = $_POST['email'];
        $facebook           = $_POST['facebook'];
        $tfijo              = $_POST['tfijo'];
        $tcelular           = $_POST['tcelular'];
        $ocupacion          = $_POST['ocupacion'];


        if ($valor_cliente == 'nuevo') {
            echo '<br> Cliente Nuevo <br>';
            /* Inserción Cliente */
            $query      = "SELECT * FROM cliente WHERE id='" . $cliente_id . "'";
            $resultado  = $obj->query($query);

            if (empty($resultado)) {
                $query      = "INSERT INTO cliente (id, condicion, apellidos, nombres, fnacimiento, lndistrito, sexo, domicilio, email, facebook, tfijo, tcelular, ocupacion) VALUES ('$cliente_id', '$condicion', '$apellidos', '$nombres', '$fnacimiento', '$cbx_distrito', '$sexo', '$domicilio', '$email', IF('$facebook'='',NULL,'$facebook'), IF('$tfijo'='',NULL,'$tfijo'), '$tcelular', '$ocupacion')";
                $resultado  = $obj->InsertUpdateQuery($query);
                echo $resultado;
            } else {
                $query      = "UPDATE cliente SET condicion='$condicion', apellidos='$apellidos', nombres='$nombres', fnacimiento='$fnacimiento', lndistrito='$cbx_distrito', sexo='$sexo', domicilio='$domicilio', email='$email', facebook=IF('$facebook'='',NULL,'$facebook'), tfijo=IF('$tfijo'='',NULL,'$tfijo'), tcelular='$tcelular', ocupacion='$ocupacion' WHERE id = '$cliente_id'";
                $resultado  = $obj->InsertUpdateQuery($query);
                echo $resultado;
            }
        } else {

            $cliente_id = $_POST['cbx_cliente'];
            echo '<br> Cliente existente <br>';
        }


        /* Inserción Ficha */
        $query      = "INSERT INTO ficha (id, cliente_id, curso_id, created, costo, horario, estado) VALUES ('$id', '$cliente_id', '$curso_id', '$creado', '$costo', IF('$horario'='',NULL,'$horario'), '1')";
        $resultado  = $obj->InsertUpdateQuery($query);
        echo '<br> Ficha insertada: ' . $resultado;

        /* Última Ficha */
        $query          = 'SELECT id FROM ficha ORDER BY SUBSTRING(id, -5) DESC LIMIT 1';
        $resultado      = $obj->query($query);
        $ultima_ficha   = $resultado[0][0];

        echo '<br> Ultima ficha: ' . $ultima_ficha;

        /* Insercion voucher */
        if ((!empty($codigo_voucher) == true) && (!empty($fecha_voucher) == true)) {


            $arrColumnas    = array('codigo', 'fecha', 'ficha_id');
            $arrValores     = array($codigo_voucher, $fecha_voucher, $ultima_ficha);
            $resultado      = $obj->nuevo('voucher', $arrColumnas, $arrValores);
            echo '<br>Voucher insertado ' . $resultado;
        }
        //BITACORA
        $bitacora = $obj->Bitacora($ultima_ficha, "la ficha ".$ultima_ficha, "Agregar", $tabla);
        echo $bitacora;

        break;

    case 'nuevo_fp':
        /* Datos de la Ficha */
        date_default_timezone_set('America/Lima');

        //Asignamos id
        $id = idFicha();

        $curso_id   = $_POST['cbx_curso'];
        $creado     = date("Y-m-d H:i:s");
        $costo      = $_POST['costo_mes'];
        $horario    = $_POST['cbx_horario'];

        /* Datos del Voucher */
        $codigo_voucher = $_POST['cod_voucher'];
        $fecha_voucher  = $_POST['fecha_voucher'];

        /* Datos del Cliente */
        //$valor_cliente = $_POST['valor_cliente'];

        $cliente_id         = $_POST['codigo']; //
        $condicion          = $_POST['cbx_condicion'];
        $apellidos          = $_POST['apellidos'];
        $nombres            = $_POST['nombres'];
        $fnacimiento        = $_POST['fnacimiento'];
        $cbx_distrito       = $_POST['cbx_distrito'];
        $sexo               = $_POST['sexo'];
        $domicilio          = $_POST['domicilio'];
        $email              = $_POST['email'];
        $facebook           = $_POST['facebook'];
        $tfijo              = $_POST['tfijo'];
        $tcelular           = $_POST['tcelular'];
        $ocupacion          = $_POST['ocupacion'];


        /* Inserción Cliente */
        $query      = "SELECT * FROM cliente WHERE id='" . $cliente_id . "'";
        $resultado  = $obj->query($query);

        if (empty($resultado)) {
            $query      = "INSERT INTO cliente (id, condicion, apellidos, nombres, fnacimiento, lndistrito, sexo, domicilio, email, facebook, tfijo, tcelular, ocupacion) VALUES ('$cliente_id', '$condicion', '$apellidos', '$nombres', '$fnacimiento', '$cbx_distrito', '$sexo', '$domicilio', '$email', IF('$facebook'='',NULL,'$facebook'), IF('$tfijo'='',NULL,'$tfijo'), '$tcelular', '$ocupacion')";
            $resultado  = $obj->InsertUpdateQuery($query);
            echo $resultado;
        } else {
            $query      = "UPDATE cliente SET condicion='$condicion', apellidos='$apellidos', nombres='$nombres', fnacimiento='$fnacimiento', lndistrito='$cbx_distrito', sexo='$sexo', domicilio='$domicilio', email='$email', facebook=IF('$facebook'='',NULL,'$facebook'), tfijo=IF('$tfijo'='',NULL,'$tfijo'), tcelular='$tcelular', ocupacion='$ocupacion' WHERE id = '$cliente_id'";
            $resultado  = $obj->InsertUpdateQuery($query);
            echo $resultado;
        }


        /* Inserción Ficha */
        $query      = "INSERT INTO ficha (id, cliente_id, curso_id, created, costo, horario, estado) VALUES ('$id', '$cliente_id', '$curso_id', '$creado', '$costo', IF('$horario'='',NULL,'$horario'), '1')";
        $resultado  = $obj->InsertUpdateQuery($query);
        echo '<br> Ficha insertada: ' . $resultado;

        /* Última Ficha */
        $query          = 'SELECT id FROM ficha ORDER BY SUBSTRING(id, -5) DESC LIMIT 1';
        $resultado      = $obj->query($query);
        $ultima_ficha   = $resultado[0][0];

        echo '<br> Ultima ficha: ' . $ultima_ficha;

        /* Insercion voucher */
        if ((!empty($codigo_voucher) == true) && (!empty($fecha_voucher) == true)) {

            $arrColumnas    = array('codigo', 'fecha', 'ficha_id');
            $arrValores     = array($codigo_voucher, $fecha_voucher, $ultima_ficha);
            $resultado      = $obj->nuevo('voucher', $arrColumnas, $arrValores);
            echo '<br>Voucher insertado ' . $resultado;
        }

        break;




    case 'editar':
        $id         = $_POST['ficha_id'];
        $cliente_id = $_POST['cbx_cliente'];
        $curso_id   = $_POST['cbx_curso'];
        $costo      = $_POST['costo_mes'];
        $horario    = $_POST['cbx_horario'];

        $query      = "UPDATE ficha SET cliente_id ='$cliente_id', curso_id ='$curso_id', costo='$costo', horario=IF('$horario'='',NULL,'$horario') WHERE id = '$id'";
        $resultado  = $obj->InsertUpdateQuery($query);
        echo '<br> Ficha actualizada: ' . $resultado;

        //BITACORA
        $bitacora = $obj->Bitacora($id, "la ficha ".$id, "Editar", $tabla);
        echo $bitacora;

        break;

    case 'buscarCodigo':
        $query = 'SELECT id FROM ficha WHERE id = "' . $_POST['codigoFicha'].'"';
        echo count($obj->query($query));
        break;

    case 'eliminar':
        $id         = $_POST['ficha_id'];
        $query      = "UPDATE ficha SET estado='0' WHERE id = '$id'";
        $resultado  = $obj->InsertUpdateQuery($query);
        //echo $resultado;

        //BITACORA
        $bitacora = $obj->Bitacora($id, "la ficha ".$id, "Eliminar", $tabla);
        //echo $bitacora;

        header('location:../../fichas.php');
        break;

    case 'recuperar':
        $id         = $_POST['ficha_id'];
        $query      = "UPDATE ficha SET estado='1' WHERE id = '$id'";
        $resultado  = $obj->InsertUpdateQuery($query);
        //echo $resultado;

        header('location:../../papelera.php');
        break;
}

function idFicha() {
    //F011800001
    $obj            = new DB();
    $query          = 'SELECT id FROM ficha ORDER BY SUBSTRING(id, -5) DESC LIMIT 1';
    $ultima_ficha   = $obj->query($query);

    if (empty($ultima_ficha[0][0])) {
        $id = 'F' . date('my') . '00001';
        return $id;
    } else {
        $base       = 'F' . date('my') . '00000';
        $auxiliar   = intval(substr($ultima_ficha[0][0], 5));
        $auxiliar++;
        $longitud   = strlen((string) $auxiliar);
        $id         = substr($base, 0, -1 * ($longitud)) . $auxiliar;
        return $id;
    }
}


