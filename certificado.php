<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);

    $tabla = 'certificado';
    $id = $_GET['id'];

    $registro = $obj->registroID($tabla, $id);

    /*
     * Obtenemos la modalidad y condición del curso
     */
    $query_curso = 'SELECT modalidad_id modalidad, condicion, nombre, horas_acad FROM cursos WHERE id=' . $registro['curso_id'] . '';
    $resultado_curso = $obj->query($query_curso);


    /*
     * Obtenemos apellidos y nombre del cliente
     */
    $query_cliente = 'SELECT id, apellidos, nombres FROM cliente WHERE id=' . $registro['cliente_id'] . '';
    $resultado_cliente = $obj->query($query_cliente);
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Ver Certificado | <?php
                if ($resultado_tusuario[0]['is_admin'] == '1'): echo 'ADMIN';
                else: echo 'TRABAJADOR';
                endif;
                ?> </title>

            <!-- Stylesheets -->
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="fonts/css/font-awesome.min.css" rel="stylesheet" />
            <link href="css/animate.min.css" rel="stylesheet" type="text/css"/>
            <link href="css/custom.css" rel="stylesheet" type="text/css"/>
            <link href="css/icheck/flat/green.css" rel="stylesheet" type="text/css"/>
            <!-- END Stylesheets -->

            <!-- JS -->
            <script src="js/jquery.min.js" type="text/javascript"></script>
            <!-- JS -->

        </head>
        <body class="nav-md">

            <div class="container body">
                <div class="main_container">

                    <!-- Sidebar -->
                    <?php include ('./elements/sidebar.php'); ?>
                    <!-- END Sidebar -->

                    <!-- top navigation -->
                    <?php include ('./elements/header.php'); ?>
                    <!-- END navigation -->

                    <!-- page content -->
                    <div id="contenedor" class="right_col" role="main">
                        <div class="row">
                            <div class="btn-group btn-breadcrumb">
                                <a href="https://centrocomputouns.edu.pe" class="btn btn-primary" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Inicio"><i class="glyphicon glyphicon-home"></i></a>
 <a href="https://centrocomputouns.edu.pe" class="btn btn-primary" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="co"><i class="glyphicon glyphicon-home"></i></a>
                                <a href="certificados.php" class="btn btn-primary">Lista de Certificados</a>
                                <a href="#" class="btn btn-primary disabled">Ver Certificado</a>
                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Certificado</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2> Certificado <b> <?php echo $registro['id']; ?> </b></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="form-horizontal form-label-left">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['estado'] == '0'):echo 'En Trámite';
                                                        else: echo 'Emitido';
                                                        endif;
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php
                                            if ($registro['estado'] == '1'):
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Decanatura</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <p class="form-control-static"><?php echo $registro['coddec']; ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            endif;
                                            ?>


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($resultado_curso[0]['modalidad'] == 'p') {
                                                            echo 'Presencial';
                                                        } elseif ($resultado_curso[0]['modalidad'] == 'v') {
                                                            echo 'Virtual';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Condición</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($resultado_curso[0]['condicion'] == 'auns') {
                                                            echo 'Alumno o Ex - Alumno UNS';
                                                        } elseif ($resultado_curso[0]['condicion'] == 'tuns') {
                                                            echo 'Trabajador UNS';
                                                        } elseif ($resultado_curso[0]['condicion'] == 'pgen') {
                                                            echo 'Público en general';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Curso</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $resultado_curso[0]['nombre']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Horas académicas</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($resultado_curso[0]['horas_acad']): echo $resultado_curso[0]['horas_acad'];
                                                        else: echo '<i>No especificado</i>';
                                                        endif;
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha curso</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['cemes'] . ' de ' . $registro['ceanio']; ?></p>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $resultado_cliente[0]['id'] . " - " . $resultado_cliente[0]['apellidos'] . " " . $resultado_cliente[0]['nombres']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nota Final</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['nota_final']; ?></p>
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class='form-group'>
                                                <h4 style='text-align:center'>Codigo QR Generado: </h4>
                                                <center>
                                                    <div id='qr-div' class='qrframe' style='border:2px solid black; width:210px; height:210px;'>
                                                        <img src='media/crt/<?php echo $registro['id']; ?>.png' style = 'width:200px; height:200px;' >
                                                    </div>
                                                    <a class='btn btn-primary submitBtn' style='width:210px; margin:5px 0;' href='modulos/certificado/acciones.php?accion=descargar&file=<?php echo $registro['id']; ?>.png' > Descargar código QR </a>
                                                </center>
                                            </div>

                                            <?php
                                            if ($registro['estado'] == '1'):
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">F. Emisión</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <p class="form-control-static"><?php echo $registro['femision']; ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            endif;
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- footer content -->
                        <?php include ('./elements/footer.php'); ?>
                        <!-- END footer content -->
                    </div>
                    <!-- END content -->
                </div>
            </div>

            <!-- JS -->
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
            <script src="js/progressbar/bootstrap-progressbar.min.js" type="text/javascript"></script>
            <script src="js/nicescroll/jquery.nicescroll.min.js" type="text/javascript"></script>
            <script src="js/icheck/icheck.min.js" type="text/javascript"></script>
            <script src="js/custom.js" type="text/javascript"></script>
            <script src="js/pace/pace.min.js" type="text/javascript"></script>


        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

