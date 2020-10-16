<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);

    $tabla = 'cursos';
    $id = $_GET['id'];

    $registro = $obj->registroID($tabla, $id);
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Ver Curso | <?php
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
                                <a href="panel.php" class="btn btn-primary" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Inicio"><i class="glyphicon glyphicon-home"></i></a>
                                <a href="cursos.php" class="btn btn-primary">Lista de Cursos</a>
                                <a href="#" class="btn btn-primary disabled">Ver Curso</a>
                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Curso</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2> Detalle del Curso <strong><?php echo $registro['nombre']; ?></strong>,
                                            <?php
                                            if ($registro['modalidad_id'] == 'p') {
                                                echo 'presencial';
                                            } else {
                                                echo 'virtual';
                                            }
                                            ?> -
                                            <?php
                                            if ($registro['condicion'] == 'pgen') {
                                                echo 'Pub. General';
                                            } elseif ($registro['condicion'] == 'tuns') {
                                                echo 'Trabajador UNS';
                                            } elseif ($registro['condicion'] == 'auns') {
                                                echo 'Alumno UNS';
                                            }
                                            ?></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="form-horizontal form-label-left">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['modalidad_id'] == 'p') {
                                                            echo 'Presencial';
                                                        } else {
                                                            echo 'Virtual';
                                                        }
                                                        ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Condición</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['condicion'] == 'pgen') {
                                                            echo 'Pub. General';
                                                        } elseif ($registro['condicion'] == 'tuns') {
                                                            echo 'Trabajador UNS';
                                                        } elseif ($registro['condicion'] == 'auns') {
                                                            echo 'Alumno UNS';
                                                        }
                                                        ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['nombre']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Horas académicas</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['horas_acad'] == NULL) {
                                                            echo '<i>No especificado</i>';
                                                        } else {
                                                            echo $registro['horas_acad'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tiempo en meses</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['tiempom'] == NULL) {
                                                            echo '<i>No especificado</i>';
                                                        } else {
                                                            echo $registro['tiempom'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo por mes (S/.)</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['costom']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">URL de infor. adicional</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['url_info'] == NULL) {
                                                            echo '<i>No especificado</i>';
                                                        } else {
                                                            echo $registro['url_info'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Visible</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['visible'] == '1') {
                                                            echo 'Si';
                                                        } else {
                                                            echo 'No';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="x_title">
                                                <h2>Horarios del Curso</h2>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="x_content">
                                                <?php
                                                $query = "SELECT h.horario hor FROM horario h WHERE curso_id='" . $registro['id'] . "'";
                                                $horarios = $obj->query($query);
                                                if (!empty($horarios)) :
                                                    ?>
                                                    <table class="table table-striped table-bordered " cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" >Horario</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($horarios AS $row):
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['hor']; ?></td>
                                                                </tr>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                else:
                                                    ?>
                                                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                        Aún no se han registrado horarios para este curso.
                                                    </div>
                                                <?php
                                                endif;
                                                ?>
                                            </div>
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

            <!-- END JS -->



        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

