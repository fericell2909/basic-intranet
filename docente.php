<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);

    $tabla = 'docente';
    $id = $_GET['id'];

    $registro = $obj->registroID($tabla, $id);
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Ver Docente | <?php
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
                                <a href="docentes.php" class="btn btn-primary">Lista de Docentes</a>
                                <a href="#" class="btn btn-primary disabled">Ver Docente</a>
                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Docente</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2> Docente <b> <?php echo $registro['id']; ?> </b></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="form-horizontal form-label-left">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['apellidos']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombres</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['nombres']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">F. Nacimiento</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['fnacimiento']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Domicilio</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea name="domicilio" rows="4" cols="50" maxlength="160" placeholder="Domicilio" disabled=""><?php echo $registro['domicilio']; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['sexo'] == 'm') {
                                                            echo 'Masculino';
                                                        } elseif ($registro['sexo'] == 'f') {
                                                            echo 'Femenino';
                                                        }
                                                        ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lugar de Nacimiento</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php
                                                    $query_dist = "SELECT distrito, idProv FROM ubdistrito WHERE idDist=" . $registro['lndistrito'];
                                                    $resultado_dist = $obj->query($query_dist);

                                                    $query_prov = "SELECT provincia, idDepa FROM ubprovincia WHERE idProv =" . $resultado_dist[0]['idProv'];
                                                    $resultado_prov = $obj->query($query_prov);

                                                    $query_dep = "SELECT departamento FROM ubdepartamento WHERE idDepa=" . $resultado_prov[0]['idDepa'];
                                                    $resultado_dep = $obj->query($query_dep);
                                                    ?>
                                                    <p class="form-control-static"><?php echo $resultado_dep[0]['departamento'] . " - " . $resultado_prov[0]['provincia'] . " - " . $resultado_dist[0]['distrito']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Carrera/Ocupación</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['ocupacion']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['email']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Facebook</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['facebook'] == NULL) {
                                                            echo '<i>No especificado</i>';
                                                        } else {
                                                            echo $registro['facebook'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Telf. Fijo</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['tfijo'] == NULL) {
                                                            echo '<i>No especificado</i>';
                                                        } else {
                                                            echo $registro['tfijo'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Telf. Celular</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['tcelular']; ?></p>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

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

