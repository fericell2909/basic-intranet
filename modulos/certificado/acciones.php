<?php

require_once '../../config/db.php';
require_once '../../libs/phpqrcode/qrlib.php';

$tabla = 'certificado';
$obj = new DB();
switch ($_GET['accion']) {
    case 'nuevo':
        //Asignamos id
        $id = idCertificado();

        $coddec         = $_POST['coddec'];
        $cliente_id     = $_POST['cbx_cliente'];
        $curso_id       = $_POST['cbx_curso'];
        $femision       = $_POST['femision'];
        $cemes          = $_POST['cbx_cemes'];
        $ceanio         = $_POST['ceanio'];
        $nota_final     = $_POST['nota_final'];
        $estado         = $_POST['rbestado'];

        if ($estado == 'tramite') {
            //echo '<br> Certificado en trámite <br>';
             /* Inserción Certificado */
            $arrColumnas    = array('id', 'cliente_id', 'curso_id', 'cemes', 'ceanio', 'nota_final', 'estado');
            $arrValores     = array($id, $cliente_id, $curso_id, $cemes, $ceanio, $nota_final, '0');
            $resultado      = $obj->nuevo($tabla, $arrColumnas, $arrValores);
            //echo '<br> Certificado insertado: ' . $resultado;
            //$qrRegDec   = 'En trámite';
            //$qrFemision = 'En trámite';

        }else{
            //echo '<br> Certificado emitido <br>';
             /* Inserción Certificado */
            $arrColumnas    = array('id', 'coddec', 'cliente_id', 'curso_id', 'femision', 'cemes', 'ceanio', 'nota_final', 'estado');
            $arrValores     = array($id, $coddec, $cliente_id, $curso_id, $femision, $cemes, $ceanio, $nota_final, '1');
            $resultado      = $obj->nuevo($tabla, $arrColumnas, $arrValores);
            //echo '<br> Certificado insertado: ' . $resultado;
            //$qrRegDec   = $coddec;
            //$qrFemision = $femision;
        }


        /* Último Certificado */
        $query          = 'SELECT id FROM certificado ORDER BY SUBSTRING(id, -5) DESC LIMIT 1';
        $resultado      = $obj->query($query);
        $ultimo_certificado   = $resultado[0][0];

        echo $ultimo_certificado;

        //BITACORA
        $bitacora = $obj->Bitacora($ultimo_certificado, "el certificado ".$ultimo_certificado, "Agregar", $tabla);
        //echo $bitacora;



        //QR
        $tempDir = '../../media/crt/';

        $registro_cliente = $obj->registroID('cliente', $cliente_id);
        $registro_curso   = $obj->registroID('cursos', $curso_id);

        $qrContenido =  "> Num. Certificado:\n\t\t\t".$ultimo_certificado."\n".
                        "> Apellidos:\n\t\t\t".$registro_cliente['apellidos']."\n".
                        "> Nombres:\n\t\t\t".$registro_cliente['nombres']."\n".
                        "> Curso:\n\t\t\t".$registro_curso['nombre']."\n".
                        "> Mes/Año:\n\t\t\t".$cemes." - ".$ceanio."\n".
                        "> Nota Final:\n\t\t\t".$nota_final;
	$filename = $ultimo_certificado;


	QRcode::png($qrContenido, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);



        break;



    case 'editar':
        $id             = $_POST['certificado_id'];
        $coddec         = $_POST['coddec'];
        $cliente_id     = $_POST['cbx_cliente'];
        $curso_id       = $_POST['cbx_curso'];
        $femision       = $_POST['femision'];
        $cemes          = $_POST['cbx_cemes'];
        $ceanio         = $_POST['ceanio'];
        $nota_final     = $_POST['nota_final'];
        $estado         = $_POST['rbestado'];

        if ($estado == 'tramite') {
            $query      = "UPDATE certificado SET coddec = NULL, cliente_id ='$cliente_id', curso_id ='$curso_id', femision =NULL, cemes ='$cemes', ceanio ='$ceanio', nota_final='$nota_final', estado='0' WHERE id = '$id'";
            $resultado  = $obj->InsertUpdateQuery($query);
            echo '<br> Certificado actualizado - TRAMITE: ' . $resultado;
        }else{
            $query      = "UPDATE certificado SET coddec ='$coddec', cliente_id ='$cliente_id', curso_id ='$curso_id', femision ='$femision', cemes ='$cemes', ceanio ='$ceanio', nota_final='$nota_final', estado='1' WHERE id = '$id'";
            $resultado  = $obj->InsertUpdateQuery($query);
            echo '<br> Certificado actualizado - EMITIDO: ' . $resultado;
        }

        //BITACORA
        $bitacora = $obj->Bitacora($id, "el certificado ".$id, "Editar", $tabla);
        echo $bitacora;

        //QR
        $tempDir = '../../media/crt/';

        $registro_cliente = $obj->registroID('cliente', $cliente_id);
        $registro_curso   = $obj->registroID('cursos', $curso_id);

        $qrContenido =  "> Num. Certificado:\n\t\t\t".$id."\n".
                        "> Apellidos:\n\t\t\t".$registro_cliente['apellidos']."\n".
                        "> Nombres:\n\t\t\t".$registro_cliente['nombres']."\n".
                        "> Curso:\n\t\t\t".$registro_curso['nombre']."\n".
                        "> Mes/Año:\n\t\t\t".$cemes." - ".$ceanio."\n".
                        "> Nota Final:\n\t\t\t".$nota_final;
	$filename = $id;


	QRcode::png($qrContenido, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);

        break;

    case 'eliminar':
        $id = $_POST['certificado_id'];

        $bitacora = $obj->Bitacora($id, "el certificado " . $id, "Eliminar", $tabla);
        //echo $bitacora;

        $obj->eliminarID($tabla, $id);

        //QR
        unlink('../../media/crt/'.$id.'.png');

        header('location:../../certificados.php');
        break;


    case 'descargar':
        if(!empty($_GET['file'])){
        $fileName = basename($_GET['file']);
        $filePath = '../../media/crt/'.$fileName;
        if(!empty($fileName) && file_exists($filePath)){
            // Define headers
            header('Content-Length: ' . filesize($filePath));
            header('Content-Encoding: none');
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            // Read the file
            readfile($filePath);
            exit;
        }else{
            echo 'El archivo '.$fileName.' no existe.';
        }
}
        break;

}

function idCertificado() {
    //CE011800001
    $obj            = new DB();
    $query          = 'SELECT id FROM certificado ORDER BY SUBSTRING(id, -5) DESC LIMIT 1';
    $ultimo_certificado   = $obj->query($query);

    if (empty($ultimo_certificado[0][0])) {
        $id = 'CE' . date('my') . '00001';
        return $id;
    } else {
        $base       = 'CE' . date('my') . '00000';
        $auxiliar   = intval(substr($ultimo_certificado[0][0], 6));
        $auxiliar++;
        $longitud   = strlen((string) $auxiliar);
        $id         = substr($base, 0, -1 * ($longitud)) . $auxiliar;
        return $id;
    }
}


