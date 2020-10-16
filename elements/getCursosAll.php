<?php

require_once '../config/db.php';
$obj = new DB();
$t_modalidad = $_POST['tipo_modalidad'];
$condicion = $_POST['condicion'];

$queryC = "SELECT id, nombre FROM cursos WHERE modalidad_id='$t_modalidad' AND condicion='$condicion'";

$resultadoC = $obj->query($queryC);

$cur = '<option></option>';

foreach ($resultadoC as $rowC):
    $cur.= "<option value='" . $rowC['id'] . "'>" . $rowC['nombre'] . "</option>";
endforeach;

echo $cur;
