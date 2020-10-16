<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);
    ?>
    <!-- ADMIN Menu -->
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Consultas | <?php
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


            <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
            <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>

            <!-- END Stylesheets -->

            <!-- JS -->
            <script src="js/jquery.min.js" type="text/javascript"></script>
            <!-- END JS -->
            <script>
                function cargarFicha() {
                    var codigo = $('#codigo').val();
                    if (codigo == "") {
                        $('#consulta1-container').html('<div id="CodigoError" class="alert alert-danger alert-dismissible fade in" role="alert">¡Ingrese el número de Ficha!</div>');

                    } else {
                        var parametros = {codigoFicha: codigo};
                        $.ajax({
                            data: parametros,
                            url: 'modulos/ficha/acciones.php?accion=buscarCodigo',
                            type: 'post',
                            success: function (msg) {
                                if (msg == 0) {
                                    $('#consulta1-container').html('<div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">¡El número de Ficha no existe!</div>');

                                } else {
                                    $('#consulta1-container').load('modulos/consultas/consulta1.php?codigoFicha=' + codigo);
                                }
                            }
                        });
                    }
                }
            </script>


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
                                <a href="" class="btn btn-primary disabled">Consultas</a>

                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Consultas</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Consulta por Número de Ficha</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <div class="input-group col-lg-4 col-lg-offset-4">
                                            <input id="codigo" name="codigo" type="text" pattern="[^A-Za-z0-9]{10}"  maxlength="10"  title="El Num. de Ficha debe contener solamente letras y números, y 10 caracteres"  class="form-control"  placeholder="Ingrese el número de ficha"  autocomplete="off" >
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary" type="button" onclick="cargarFicha()">
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <br><br>
                                        <div id="consulta1-container"></div>
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

            <!-- Datatables-->
            <script src="js/datatables/jquery.dataTables.min.js"></script>
            <script src="js/datatables/dataTables.bootstrap.js"></script>
            <script src="js/datatables/dataTables.buttons.min.js"></script>
            <script src="js/datatables/buttons.bootstrap.min.js"></script>
            <script src="js/datatables/jszip.min.js"></script>
            <script src="js/datatables/pdfmake.min.js"></script>
            <script src="js/datatables/vfs_fonts.js"></script>
            <script src="js/datatables/buttons.html5.min.js"></script>
            <script src="js/datatables/buttons.print.min.js"></script>
            <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
            <script src="js/datatables/dataTables.keyTable.min.js"></script>
            <script src="js/datatables/dataTables.responsive.min.js"></script>
            <script src="js/datatables/responsive.bootstrap.min.js"></script>
            <script src="js/datatables/dataTables.scroller.min.js"></script>
            <!-- End Datatables -->

            <script src="js/pace/pace.min.js" type="text/javascript"></script>
            <!-- END JS -->



        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

