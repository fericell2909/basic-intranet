<?php

require_once '../../config/db.php';
$tabla = 'horario';
$obj = new DB();
switch ($_GET['accion']) {
    case 'nuevo':
        /* Datos del Curso */
        $curso_id = $_POST['curso_id'];

        /* Datos del Horario */
        $horario        = $_POST['horario'];
        $arrColumnas    = array('curso_id', 'horario');
        $arrValores     = array($curso_id, $horario);
        $resultado      = $obj->nuevo($tabla, $arrColumnas, $arrValores);
        //echo $resultado;

        header('location:../../editcurso.php?id='.$curso_id);
        break;

    case 'editar':
        /* Datos de Curso */
        $curso_id = $_POST['curso_id'];

        /* Datos de Horario */
        $id         = $_POST['horario_id'];
        $horario    = $_POST['horario'];

        $arrColumnas    = array('horario');
        $arrValores     = array($horario);
        $resultado      = $obj->editarID($tabla, $arrColumnas, $arrValores, $id);
        //echo $resultado;

        header('location:../../editcurso.php?id='.$curso_id);
        break;
    case 'eliminar':
        /* Datos de Curso */
        $curso_id = $_POST['curso_id'];

        /* Datos de Horario */
        $id = $_POST['horario_id'];
        $obj->eliminarID($tabla, $id);

        header('location:../../editcurso.php?id='.$curso_id);
        break;

}
