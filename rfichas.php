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
            <title>Reportes Ficha | <?php
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
                        <!-- Indicadores TOP -->
                        <div class="row top_tiles">
                            <div class="animated flipInY col-md-4 col-sm-4 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-list-alt"></i>
                                    </div>
                                    <?php
                                    $query = "select count(*) fichas_hoy from ficha f where f.created >= curdate() AND  f.estado = '1'";
                                    $resultado = $obj->query($query);
                                    foreach ($resultado as $row):
                                        ?>
                                        <div class="count"><?php echo $row['fichas_hoy']; ?></div>
                                        <?php
                                        if ($row['fichas_hoy'] == 1):
                                            echo '<h3>Ficha Hoy</h3>';
                                        else:
                                            echo '<h3>Fichas Hoy</h3>';
                                        endif;
                                        ?>
                                        <?php
                                    endforeach;
                                    ?>

                                </div>
                            </div>
                            <div class="animated flipInY col-md-4 col-sm-4 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-list-alt"></i>
                                    </div>
                                    <?php
                                    $query = "SELECT COUNT(*) fichas_mes FROM ficha f WHERE  YEAR(f.created) = YEAR(CURDATE()) AND MONTH(f.created) = MONTH(CURDATE())  AND  f.estado = '1'";
                                    $resultado = $obj->query($query);
                                    foreach ($resultado as $row):
                                        ?>
                                        <div class="count"><?php echo $row['fichas_mes']; ?></div>
                                        <?php
                                        if ($row['fichas_mes'] == 1):
                                            echo '<h3>Ficha este mes</h3>';
                                        else:
                                            echo '<h3>Fichas este mes</h3>';
                                        endif;
                                        ?>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                            <div class="animated flipInY col-md-4 col-sm-4 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-list-alt"></i>
                                    </div>
                                    <?php
                                    $query = "SELECT COUNT(*) fichas_anio FROM ficha f WHERE  YEAR(f.created) = YEAR(CURDATE())   AND  f.estado = '1'";
                                    $resultado = $obj->query($query);
                                    foreach ($resultado as $row):
                                        ?>
                                        <div class="count"><?php echo $row['fichas_anio']; ?></div>
                                        <?php
                                        if ($row['fichas_anio'] == 1):
                                            echo '<h3>Ficha este año</h3>';
                                        else:
                                            echo '<h3>Fichas este año</h3>';
                                        endif;
                                        ?>
                                        <?php
                                    endforeach;
                                    ?>

                                </div>
                            </div>
                        </div>
                        <!-- END Indicadores TOP -->


                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <br>
                                        <div class="form-group  col-md-offset-3 col-sm-offset-3">
                                            <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12"><b>ESPECIFIQUE AÑO</b></label>
                                            <div class=" col-md-3 col-sm-3 col-xs-12 margin-bot">
                                                <input id="fanio" name="fanio" type="number"  class="form-control"  min="2012" max="<?php echo date("Y"); ?>" step="1" value="<?php echo date("Y"); ?>" required autocomplete="off" />
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div id="reporte1-container">
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
                    $('#reporte1-container').load('modulos/reportes/reporte1.php?fanio=' + $('#fanio').val());

                    $("#fanio").change(function () {
                        fanio = $(this).val();
                        $('#reporte1-container').load('modulos/reportes/reporte1.php?fanio=' + fanio);
                    });
                });

            </script>

        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

