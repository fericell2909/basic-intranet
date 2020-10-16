<?php

require_once '../../config/db.php';
$tabla = 'voucher';
$obj = new DB();
switch ($_GET['accion']) {
    case 'nuevo':
        /* Datos de la Ficha */
        $ficha_id = $_POST['id_ficha'];

        /* Datos del Voucher */
        $cod_voucher    = $_POST['cod_voucher'];
        $fecha_voucher  = $_POST['fecha_voucher'];
        $arrColumnas    = array('ficha_id', 'codigo', 'fecha');
        $arrValores     = array($ficha_id, $cod_voucher, $fecha_voucher);
        $resultado      = $obj->nuevo($tabla, $arrColumnas, $arrValores);
        //echo $resultado;

        //BITACORA
        $bitacora = $obj->Bitacora($ficha_id, "el voucher ".$cod_voucher." a la ficha ".$ficha_id, "Agregar", 'ficha');
        //echo $bitacora;

        header('location:../../editficha.php?id='.$ficha_id);
        break;

    case 'editar':
        /* Datos de la Ficha */
        $ficha_id = $_POST['ficha_id'];

        /* Datos del Voucher */
        $id             = $_POST['voucher_id'];
        $cod_voucher    = $_POST['cod_voucher'];
        $fecha_voucher  = $_POST['fecha_voucher'];

        $arrColumnas    = array('codigo', 'fecha');
        $arrValores     = array($cod_voucher, $fecha_voucher);
        $resultado      = $obj->editarID($tabla, $arrColumnas, $arrValores, $id);
        //echo $resultado;

        //BITACORA
        $bitacora = $obj->Bitacora($ficha_id, "el voucher ".$cod_voucher." de la ficha ".$ficha_id, "Editar", 'ficha');
        //echo $bitacora;

        header('location:../../editficha.php?id='.$ficha_id);
        break;

    case 'eliminar':
        /* Datos de la Ficha */
        $ficha_id = $_POST['ficha_id'];

        /* Datos del Voucher */
        $id = $_POST['voucher_id'];


        //BITACORA
        $registro = $obj->registroID($tabla, $id);
        $cod_voucher = $registro['codigo'];
        $bitacora = $obj->Bitacora($ficha_id, "el voucher ".$cod_voucher." de la ficha ".$ficha_id, "Eliminar", 'ficha');
        //echo $bitacora;

        $obj->eliminarID($tabla, $id);

        header('location:../../editficha.php?id='.$ficha_id);
        break;

}
