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
            <link href="css/select2/select2.min.css" rel="stylesheet" type="text/css"/>

            <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
            <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>

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
                                        <h2>Número de Fichas por Cliente</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="form-horizontal ">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  id="cbx_cliente" name="cbx_cliente" class="form-control select-cliente">
                                                        <option></option>
                                                        <?php
                                                        $query = "SELECT id, apellidos, nombres FROM cliente";
                                                        $clientes = $obj->query($query);
                                                        foreach ($clientes AS $row):
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['id'] . " - " . $row['apellidos'] . " " . $row['nombres']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>

                                        <br><br>
                                        <div id="consulta3-container">
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
            <script src="js/select2/select2.min.js" type="text/javascript"></script>
            <script src="js/select2/i18n/es.js" type="text/javascript"></script>


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

            <script>
                $(document).ready(function () {
                    // Select 2
                    $('.select-cliente').select2({
                        language: "es",
                        placeholder: "Especifique un cliente",
                        allowClear: true,
                        width: 'resolve'
                    });

                    $("#cbx_cliente").change(function () {
                        $("#cbx_cliente option:selected").each(function () {
                            cliente_id = $(this).val();
                            $('#consulta3-container').load('modulos/consultas/consulta3.php?idCliente=' + cliente_id);
                        });
                    });
                });
            </script>
        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

