<?php

require_once '../../config/db.php';
$tabla = 'curso';
$obj = new DB();
switch ($_GET['accion']) {
    case 'nuevo':
        /* Datos del Curso */
        $modalidad = $_POST['cbx_modalidad'];
        $condicion = $_POST['cbx_condicion'];
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $horas_acad = $_POST['horas_acad'];
        $tiempo_meses = $_POST['tiempo_meses'];
        $costo = $_POST['costo'];
        $url_info = $_POST['url_info'];
        $visible = $_POST['rbvisible'];

        $query = "INSERT INTO cursos (codigo, modalidad_id, condicion, nombre, horas_acad, tiempom, costom, url_info, visible) VALUES ('$codigo', '$modalidad', '$condicion', '$nombre', IF('$horas_acad'='',NULL,'$horas_acad'), IF('$tiempo_meses'='',NULL,'$tiempo_meses'), '$costo', IF('$url_info'='',NULL,'$url_info'), '$visible' )";
        $resultado = $obj->InsertUpdateQuery($query);
        echo $resultado;

        /* Datos del Horario del Curso */
        $ultimo_curso = $obj->ultimoID();
        $horarios = $_POST['horario'];

        if (!empty($horarios)) {
            $arrColumnas = array('curso_id', 'horario');
            for ($i = 0; $i < count($horarios); $i++) {
                $arrValores = array($ultimo_curso, $horarios[$i]);
                $resultado = $obj->nuevo('horario', $arrColumnas, $arrValores);
                echo $resultado;
            }
        }

        //BITACORA
        $descripcion = $nombre;
        if ($modalidad == 'p') {
            $descripcion.= ' - presencial - ';
        } else {
            $descripcion.= '- virtual - ';
        }

        if ($condicion == 'pgen') {
            $descripcion.= 'Pub. General';
        } elseif ($condicion == 'tuns') {
            $descripcion.= 'Trabajador UNS';
        } elseif ($condicion == 'auns') {
            $descripcion.= 'Alumno UNS';
        }


        $bitacora = $obj->Bitacora($ultimo_curso, "el curso " . $descripcion, "Agregar", $tabla);
        echo $bitacora;

        break;
    case 'editar':

        $id = $_POST['curso_id'];
        $modalidad = $_POST['cbx_modalidad'];
        $condicion = $_POST['cbx_condicion'];
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $horas_acad = $_POST['horas_acad'];
        $tiempo_meses = $_POST['tiempo_meses'];
        $costo = $_POST['costo'];
        $url_info = $_POST['url_info'];
        $visible = $_POST['rbvisible'];

        $query = "UPDATE cursos SET codigo ='$codigo', modalidad_id='$modalidad', condicion='$condicion', nombre='$nombre', horas_acad=IF('$horas_acad'='',NULL,'$horas_acad'), tiempom=IF('$tiempo_meses'='',NULL,'$tiempo_meses'), costom='$costo', url_info=IF('$url_info'='',NULL,'$url_info'), visible='$visible' WHERE id = '$id'";
        $resultado = $obj->InsertUpdateQuery($query);
        echo $resultado;



        //BITACORA
        $descripcion = $nombre;
        if ($modalidad == 'p') {
            $descripcion.= ' - presencial - ';
        } else {
            $descripcion.= '- virtual - ';
        }

        if ($condicion == 'pgen') {
            $descripcion.= 'Pub. General';
        } elseif ($condicion == 'tuns') {
            $descripcion.= 'Trabajador UNS';
        } elseif ($condicion == 'auns') {
            $descripcion.= 'Alumno UNS';
        }

        $bitacora = $obj->Bitacora($id, "el curso " . $descripcion, "Editar", $tabla);
        echo $bitacora;


        break;

    case 'eliminar':
        $id = $_POST['curso_id'];

        //BITACORA
        $registro = $obj->registroID('cursos', $id);
        $descripcion = $registro['nombre'];
        if ($registro['modalidad_id'] == 'p') {
            $descripcion.= ' - presencial - ';
        } else {
            $descripcion.= '- virtual - ';
        }

        if ($registro['condicion'] == 'pgen') {
            $descripcion.= 'Pub. General';
        } elseif ($registro['condicion'] == 'tuns') {
            $descripcion.= 'Trabajador UNS';
        } elseif ($registro['condicion'] == 'auns') {
            $descripcion.= 'Alumno UNS';
        }
        $bitacora = $obj->Bitacora($id, "el curso " . $descripcion, "Eliminar", $tabla);
        //echo $bitacora;


        $obj->eliminarID('cursos', $id);

        header('location:../../cursos.php');
        break;
}
