<?php

if (isset($_POST['submit'])) {

    $modalidad      = $_POST['h_modalidad'];
    $condicion      = $_POST['h_condicion'];
    $curso          = $_POST['h_curso'];
    $apellidos      = $_POST['h_apellidos'];
    $nombres        = $_POST['h_nombres'];
    $dni            = $_POST['h_id'];
    $fnacimiento    = $_POST['h_fnacimiento'];
    $domicilio      = $_POST['h_domicilio'];
    $sexo           = $_POST['h_sexo'];
    $email          = $_POST['h_email'];
    $tfijo          = $_POST['h_tfijo'];
    $tcelular       = $_POST['h_tcelular'];
    $distrito       = $_POST['h_distrito'];
    $provincia      = $_POST['h_provincia'];
    $departamento   = $_POST['h_departamento'];
    $horario        = $_POST['h_horario'];
    $tiempom        = $_POST['h_tiempom'];



    define('FPDF_FONTPATH', "libs/pdf/font/");
    require_once('libs/pdf/tfpdf.php');

    // map FPDF to tFPDF so FPDF_TPL can extend it
    class FPDF extends tFPDF {
        /**
         * "Remembers" the template id of the imported page
         */
        protected $_tplIdx;
    }

    require_once('libs/pdf/fpdi.php');

    $pdf = new FPDI();

    $pdf->AddFont('DejaVuSansCondensed', '', 'DejaVuSansCondensed.ttf', true);

    $pdf->setSourceFile("media/template/ficha2017.pdf");

    $tplIdx = $pdf->importPage(1, '/MediaBox');


    $pdf->addPage();

    $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);

    $pdf->SetFont('DejaVuSansCondensed', '', 10);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->SetXY(62, 40);
    $pdf->Write(0, $apellidos);

    $pdf->SetXY(62, 48);
    $pdf->Write(0, $nombres);

    $pdf->SetXY(62, 56);
    $split_dni = str_split($dni);

    $x = 64;
    for ($index = 0; $index < count($split_dni); $index++) {
        $pdf->SetXY($x, 56);
        $pdf->Write(0, $split_dni[$index]);
        $x+=8;
    }

    list($year, $month, $day) = explode('-', $fnacimiento);
    $pdf->SetXY(153, 56);
    $pdf->Write(0, $day);
    $pdf->SetXY(165, 56);
    $pdf->Write(0, $month);
    $pdf->SetXY(177, 56);
    $pdf->Write(0, $year);


    $pdf->SetXY(62, 65);
    $pdf->Write(0, $domicilio);

    if ($sexo == 'm') {
        $pdf->SetXY(118, 73);
        $pdf->Write(0, 'X');
    } else {
        $pdf->SetXY(180, 73);
        $pdf->Write(0, 'X');
    }

    $pdf->SetXY(97, 81);
    $pdf->Write(0, $departamento);

    $pdf->SetXY(159, 81);
    $pdf->Write(0, $provincia);

    $pdf->SetXY(97, 89);
    $pdf->Write(0, $distrito);

    $pdf->SetXY(54, 114);
    $pdf->Write(0, $email);

    $pdf->SetXY(54, 123);
    $pdf->Write(0, $tfijo);

    $pdf->SetXY(132, 123);
    $pdf->Write(0, $tcelular);

    $pdf->SetFont('DejaVuSansCondensed', '', 9);
    $pdf->SetXY(81, 148);
    $pdf->Write(0, $curso);

    $pdf->SetFont('DejaVuSansCondensed', '', 10);
    $pdf->SetXY(58, 157);
    $pdf->Write(0, $horario);

    $pdf->SetXY(58, 165);
    if (!empty($tiempom)) {
        if ($tiempom == 1) {
            $pdf->Write(0, $tiempom." mes");
        }  else {
            $pdf->Write(0, $tiempom." meses");
        }
    }


    if ($condicion == 'auns') {
        $pdf->SetXY(96, 193);
        $pdf->Write(0, 'X');
    } elseif ($condicion == 'tuns') {
        $pdf->SetXY(138, 193);
        $pdf->Write(0, 'X');
    } else {
        $pdf->SetXY(181, 193);
        $pdf->Write(0, 'X');
    }


    $pdf->Output('fichapdf.pdf', 'I');
}

