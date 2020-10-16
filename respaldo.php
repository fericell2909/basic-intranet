<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);


    if ($resultado_tusuario[0]['is_admin'] == '1'):
        ?>
        <!-- ADMIN Menu -->
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
                <title>Respaldo | ADMIN </title>

                <!-- Stylesheets -->
                <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="fonts/css/font-awesome.min.css" rel="stylesheet" />
                <link href="css/animate.min.css" rel="stylesheet" type="text/css"/>
                <link href="css/custom.css" rel="stylesheet" type="text/css"/>
                <link href="css/icheck/flat/green.css" rel="stylesheet" type="text/css"/>
                <!-- END Stylesheets -->

                <!-- JS -->
                <script src="js/jquery.min.js" type="text/javascript"></script>
                <!-- END JS -->
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
                                    <a href="" class="btn btn-primary disabled">Respaldo de Datos</a>

                                </div>
                            </div>
                            <div class="page-title">
                                <div class="title_left">
                                    <h3>Respaldo de Datos</h3>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Respaldo de Datos</h2>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <div class="pricing">
                                                            <div class="title" style="background: #6292e5;">
                                                                <h1>Estructura y Data</h1>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="">
                                                                    <div class="pricing_features">
                                                                        <ul class="list-unstyled text-left">
                                                                            <li><i class="fa fa-check text-success"></i> Estructura de las <strong>tablas y sus relaciones</strong>.</li>
                                                                            <li><i class="fa fa-check text-success"></i> Inserción de <strong>datos de todas las tablas</strong>.</li>
                                                                            <li><i class="fa fa-check text-success"></i> Información referencial del respaldo.</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="pricing_footer">
                                                                    <a href="#RespaldoModal" class="btn btn-success btn-block" role="button" data-toggle="modal" onclick="DecargarBD('<?php echo $_SESSION['id']; ?>', 'all')">Descargar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <div class="pricing" >
                                                            <div class="title" >
                                                                <h1>Solo Estructura</h1>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="">
                                                                    <div class="pricing_features">
                                                                        <ul class="list-unstyled text-left">
                                                                            <li><i class="fa fa-check text-success"></i> Estructura de las <strong>tablas y sus relaciones</strong>.</li>
                                                                            <li><i class="fa fa-times text-danger"></i> Inserción de <strong>datos de todas las tablas</strong>.</li>
                                                                            <li><i class="fa fa-check text-success"></i> Información referencial del respaldo.</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="pricing_footer">
                                                                    <a href="#RespaldoModal" class="btn btn-success btn-block" role="button" data-toggle="modal" onclick="DecargarBD('<?php echo $_SESSION['id']; ?>', 'est')">Descargar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <div class="pricing">
                                                            <div class="title" style="background: #04dbd0;">
                                                                <h1>Solo Data</h1>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="">
                                                                    <div class="pricing_features">
                                                                        <ul class="list-unstyled text-left">
                                                                            <li><i class="fa fa-times text-danger"></i> Estructura de las <strong>tablas y sus relaciones</strong>.</li>
                                                                            <li><i class="fa fa-check text-success"></i> Inserción de <strong>datos de todas las tablas</strong>.</li>
                                                                            <li><i class="fa fa-check text-success"></i> Información referencial del respaldo.</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="pricing_footer">
                                                                    <a href="#RespaldoModal" class="btn btn-success btn-block" role="button" data-toggle="modal" onclick="DecargarBD('<?php echo $_SESSION['id']; ?>', 'dat')">Descargar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Respaldo Modal -->
                            <div class="modal fade" id="RespaldoModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalRespaldoLabel">
                            </div>
                            <!-- END Respaldo Modal -->

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


                <script type="text/javascript">
                function DecargarBD(id, tipo) {
                    $.post("modulos/usuario/respaldo-modal.php", {id: id, tipo: tipo}, function (data) {
                        $('#RespaldoModal').html(data);
                    });
                }
                </script>
            </body>
        </html>

        <?php
    else:
        header('location: 403.php');
    endif;
else:
    header('location: 403.php');
endif;

