<?php

require_once 'database.php';

class DB {

    private $CON;

    private function conexion() {
        try {
            $this->CON = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='es_PE',NAMES utf8"));
            $this->CON->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error " . $e->getMessage());
            echo "Linea del error " . $e->getLine();
        }
    }

    /**
     * Inserta un nuevo registro en la tabla nombrada
     * @param String $tabla Nombre de la tabla a insertar
     * @param String[] $arrColumnas Columnas donde se va insertar
     * @param String[] $arrValores Valores a insertar
     * @return boolean True si se creo existosamente o False si ocurrio algun problema
     */
    public function nuevo($tabla, $arrColumnas, $arrValores) {
        try {
            $this->conexion();
            $atrib = null;
            $sig = null;
            for ($i = 0; $i < count($arrColumnas); $i++) {
                $atrib = $atrib . $arrColumnas[$i] . ',';
                $sig = $sig . '?,';
            }
            $atrib = substr($atrib, 0, strlen($atrib) - 1);
            $sig = substr($sig, 0, strlen($sig) - 1);
            $accion = $this->CON->prepare('INSERT INTO ' . $tabla . '( ' . $atrib . ' ) VALUES ( ' . $sig . ' ) ');
            for ($j = 0; $j < count($arrValores); $j++) {
                $accion->bindParam($j + 1, $arrValores[$j]);
            }
            $accion->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Edita un registro segun el ID nombrado
     * @param String $tabla Nombre de la tabla a editar
     * @param String[] $arrColumnas Columnas donde se van editar
     * @param String[] $arrValores Valores editado
     * @param type $id
     * @return boolean True si se edito existosamente o False si ocurrio algun problema
     */
    public function editarID($tabla, $arrColumnas, $arrValores, $id) {
        try {
            $this->conexion();
            $data = null;
            for ($i = 0; $i < count($arrColumnas); $i++) {
                $data = $data . $arrColumnas[$i] . '= "' . $arrValores[$i] . '",';
            }
            $data = substr($data, 0, strlen($data) - 1);
            $accion = $this->CON->prepare('UPDATE ' . $tabla . ' SET ' . $data . '  WHERE id = ' . $id);
            $accion->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Retorna un array con los datos segun el ID enviado
     * @param String $tabla Nombre de la tabla a buscar
     * @param type $id
     * @return array Datos obtenidos de la busqueda
     */
    public function registroID($tabla, $id) {
        try {
            $this->conexion();
            $accion = $this->CON->prepare('SELECT * FROM ' . $tabla . ' WHERE id = ?');
            $accion->bindParam(1, $id);
            $accion->execute();
            foreach ($accion->fetchAll() as $fila) {
                $array = $fila;
            }
            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * (Uso solo de administrador)
     * Regresa un array que contiene la informacion del usuario
     * @param String $tabla Nombre de la tabla a buscar
     * @param String $user
     * @param String $pass
     * @return array Datos obtenidos de la busqueda
     */
    public function registroAdmin($tabla, $user, $pass) {
        try {
            $this->conexion();
            $accion = $this->CON->prepare('SELECT * FROM ' . $tabla . ' WHERE user = ? AND pass = ? ');
            $accion->bindParam(1, $user);
            $accion->bindParam(2, $pass);
            $accion->execute();
            foreach ($accion->fetchAll() as $fila) {
                $array = $fila;
            }
            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Elimina el resgistro segun el ID enviado
     * @param String $tabla Nombre de la tabla donde eliminar
     * @param type $id
     * @return boolean True si se elimino existosamente o False si ocurrio algun problema
     */
    public function eliminarID($tabla, $id) {
        try {
            $this->conexion();
            $accino = $this->CON->prepare('DELETE FROM ' . $tabla . ' WHERE id = ?');
            $accino->bindParam(1, $id);
            $accino->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Retorna un solo registro segun el query enviado
     * @param String $query Query a ejecutar
     * @return String[] array
     */
    public function ultimoQuery($query) {
        try {
            $this->conexion();
            $array = null;
            $accion = $this->CON->query($query);
            foreach ($accion->fetchAll() as $fila) {
                $array = $fila;
            }
            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Retorna los registros segun el query enviado
     * @param String $query Query a ejecutar
     * @return String[] array
     */
    public function query($query) {
        try {
            $this->conexion();
            $accion = $this->CON->query($query);
            $array = array();
            foreach ($accion->fetchAll() as $fila) {
                $array[] = $fila;
            }
            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Funcion utilizada para Actualizar o Insertar en función al query enviado
     * @param String $query Query a ejecutar
     * @return String[] array
     */
    public function InsertUpdateQuery($query) {
        try {
            $this->conexion();
            $accion = $this->CON->prepare($query);
            $accion->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Reinicia la tabla enviada con DELETE FROM
     * @param String $tabla
     * @return boolean
     */
    public function reinicio($tabla) {
        try {
            $this->conexion();
            $this->CON->exec('DELETE FROM ' . $tabla);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Retorna el ultimo ID insertado
     * @return type
     */
    public function ultimoID() {
        return $this->CON->lastInsertId();
    }

    public function __destruct() {
        unset($this->CON);
    }

    public function Bitacora($id, $etiqueta_desc, $operacion, $tabla) {
        date_default_timezone_set('America/Lima');
        session_start();

        $usuario_id = $_SESSION['id'];
        $fecha = date("Y-m-d H:i:s");
        $descripcion = '';

        if ($operacion == 'Editar') {
            $descripcion = 'Cambios en <a href="' . $tabla . '.php?id=' . $id . '" target="_blank" ><b>' . $etiqueta_desc . '</b></a>';
        } elseif ($operacion == 'Eliminar') {
            $descripcion = 'Eliminó <b>' . $etiqueta_desc . '</b>';
        } elseif ($operacion == 'Agregar') {
            $descripcion = 'Agregó  <a href="' . $tabla . '.php?id=' . $id . '" target="_blank" ><b>' . $etiqueta_desc . '</b></a>';
        }


        $arrColumnas = array('usuario_id', 'fecha', 'operacion', 'tabla', 'descripcion');
        $arrValores = array($usuario_id, $fecha, $operacion, $tabla, $descripcion);
        $resultado = $this->nuevo('bitacora', $arrColumnas, $arrValores);
        return '<br>Bitacora actualizada' . $resultado;
    }

}
