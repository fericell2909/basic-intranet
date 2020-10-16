<?php
	require_once '../config/db.php';
    $obj = new DB();
    $id_depto= $_POST['id_departamento'];

    $queryP = "SELECT idProv, provincia FROM ubprovincia WHERE idDepa='$id_depto'";

   	$resultadoP = $obj->query($queryP);

        $html = "<option></option>";
        
	foreach ($resultadoP as $rowP):
		$html.= "<option value='".$rowP['idProv']."'>".$rowP['provincia']."</option>";
	endforeach;

	echo $html;
?>