<?php

require_once '../config/db.php';
$obj = new DB();
$id_curso = $_POST['id_curso'];

/* Obtenemos datos del Curso */
$queryC     = " SELECT  c.horas_acad horas_acad  FROM cursos c WHERE c.id = '$id_curso'";
$resultadoC = $obj->query($queryC);

foreach ($resultadoC as $rowC):
    $horas_acad     = $rowC['horas_acad'];
endforeach;

echo $horas_acad;