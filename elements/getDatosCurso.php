<?php

require_once '../config/db.php';
$obj = new DB();
$id_curso = $_POST['id_curso'];

/* Obtenemos datos del Curso */
$queryC     = " SELECT  c.id curso_id, c.codigo codigo_curso, c.nombre nombre, c.horas_acad horas_acad, c.tiempom tiempo_meses, c.costom costo_mes, c.url_info url_info FROM cursos c WHERE c.id = '$id_curso'";
$resultadoC = $obj->query($queryC);

foreach ($resultadoC as $rowC):
    $horas_acad     = $rowC['horas_acad'];
    $tiempo_meses   = $rowC['tiempo_meses'];
    $url_info       = $rowC['url_info'];
    $costo_mes      = $rowC['costo_mes'];
    $codigo_curso   = $rowC['codigo_curso'];

    $nombre_curso   = $rowC['nombre'];
endforeach;

/* Obtenemos horarios del Curso */
$queryH     = "SELECT h.id horario_id , h.horario horario FROM horario h WHERE h.curso_id = '$id_curso'";
$resultadoH = $obj->query($queryH);

$horario = '<option></option>';

if (!empty($resultadoH)) :
    foreach ($resultadoH as $rowH):
        $horario.= '<option value="' . $rowH['horario'] . '">' . $rowH['horario'] . '</option>';
    endforeach;
endif;


/* Organizamos el retorno en un string */
$return = '';
$return = $url_info . "||" . $horas_acad . "||" . $tiempo_meses . "||" . $horario . "||" . $costo_mes . "||" . $nombre_curso . "||" . $codigo_curso;

echo $return;