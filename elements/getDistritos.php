<?php
	require_once '../config/db.php';
    $obj = new DB();
    $id_prov= $_POST['id_provincia'];

    $queryD = "SELECT idDist, distrito FROM ubdistrito WHERE idProv='$id_prov'";

   	$resultadoD = $obj->query($queryD);

        $html = "<option></option>";

	foreach ($resultadoD as $rowD):
		$html.= "<option value='".$rowD['idDist']."'>".$rowD['distrito']."</option>";
	endforeach;

	echo $html;
