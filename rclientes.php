<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Reportes Cliente | <?php
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
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Clientes más concurrentes</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="form-horizontal ">
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12">Desde  <span class="required">*</span></label>
                                                <div class=" col-md-3 col-sm-3 col-xs-12 margin-bot">
                                                    <input id="fdesde" name="fdesde"  type="date" class="form-control" step="1" min="1940-01-01" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo date("Y-m-d"); ?>" required autocomplete="off">
                                                </div>

                                                <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12">Hasta  <span class="required">*</span></label>
                                                <div class=" col-md-3 col-sm-3 col-xs-12 margin-bot">
                                                    <input id="fhasta" name="fhasta"  type="date" class="form-control" step="1" min="1940-01-01" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo date("Y-m-d"); ?>" required autocomplete="off">
                                                </div>
                                            </div>
                                        </form>

                                        <br><br>
                                        <div id="reporte3-container">
                                        </div>
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
            <!-- moris js -->
            <script src="js/moris/raphael-min.js" type="text/javascript"></script>
            <script src="js/morris.js" type="text/javascript"></script>
            <!-- END JS -->

            <script>
                $(document).ready(function () {
                    $('#reporte3-container').load('modulos/reportes/reporte3.php?fdesde=' + $('#fdesde').val() + '&fhasta=' + $('#fhasta').val());


                    $("#fdesde").change(function () {
                            fdesde = $(this).val();
                            fhasta = $("#fhasta").val();
                            $('#reporte3-container').load('modulos/reportes/reporte3.php?fdesde=' + fdesde + '&fhasta=' + fhasta);
                    });

                    $("#fhasta").change(function () {
                            fhasta = $(this).val();
                            fdesde = $("#fdesde").val();
                            $('#reporte3-container').load('modulos/reportes/reporte3.php?fdesde=' + fdesde + '&fhasta=' + fhasta);
                    });
                });
            </script>

        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

