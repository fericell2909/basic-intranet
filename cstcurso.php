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
                                        <h2>Número de Clientes Pre - Inscritos por Curso</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="form-horizontal ">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="cbx_modalidad" name="cbx_modalidad" class="form-control select-modalidad" required>
                                                        <option></option>
                                                        <option value="p">Presencial</option>
                                                        <option value="v">Virtual</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="control-label col-md-3 col-sm-3 col-xs-12">Condición <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="cbx_condicion" name="cbx_condicion" class="form-control select-condicion" required>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Curso  <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="cbx_curso" name="cbx_curso" class="form-control select-curso" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
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
                                        <div id="consulta2-container">
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
            <script src="js/curso.js" type="text/javascript"></script>

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
                    $('.select-curso').select2({
                        language: "es",
                        placeholder: "Especifique un curso",
                        allowClear: true,
                        width: 'resolve'
                    });

                    /* Devuelve una lista de cursos en función a la modalidad y condición */
                    $("#cbx_condicion").change(function () {
                        $('#cbx_curso').find('option').remove();

                        $("#cbx_condicion option:selected").each(function () {
                            condicion = $(this).val();
                            tipo_modalidad = $("#cbx_modalidad option:selected").val();

                            $.post("elements/getCursosAll.php", {tipo_modalidad: tipo_modalidad, condicion: condicion}, function (data) {
                                $("#cbx_curso").html(data);
                            });
                        });
                    });


                    $("#cbx_curso").change(function () {
                        if (!$('#cbx_modalidad').val() || !$('#cbx_condicion').val() || !$('#cbx_curso').val()) {
                            $('#consulta2-container').html('<div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">¡Especifique Modalidad, Condición y el Curso!</div>');
                        } else {
                            $("#cbx_curso option:selected").each(function () {
                                curso_id = $(this).val();
                                fdesde = $("#fdesde").val();
                                fhasta = $("#fhasta").val();
                                $('#consulta2-container').load('modulos/consultas/consulta2.php?idCurso=' + curso_id + '&fdesde=' + fdesde + '&fhasta=' + fhasta);
                            });
                        }
                    });


                    $("#fdesde").change(function () {
                        if (!$('#cbx_modalidad').val() || !$('#cbx_condicion').val() || !$('#cbx_curso').val()) {
                            $('#consulta2-container').html('<div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">¡Especifique Modalidad, Condición y el Curso!</div>');
                        } else {
                            fdesde = $(this).val();
                            fhasta = $("#fhasta").val();
                            curso_id = $("#cbx_curso option:selected").val();
                            $('#consulta2-container').load('modulos/consultas/consulta2.php?idCurso=' + curso_id + '&fdesde=' + fdesde + '&fhasta=' + fhasta);
                        }
                    });

                    $("#fhasta").change(function () {
                        if (!$('#cbx_modalidad').val() || !$('#cbx_condicion').val() || !$('#cbx_curso').val()) {
                            $('#consulta2-container').html('<div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">¡Especifique Modalidad, Condición y el Curso!</div>');
                        } else {
                            fhasta = $(this).val();
                            fdesde = $("#fdesde").val();
                            curso_id = $("#cbx_curso option:selected").val();
                            $('#consulta2-container').load('modulos/consultas/consulta2.php?idCurso=' + curso_id + '&fdesde=' + fdesde + '&fhasta=' + fhasta);
                        }
                    });
                });
            </script>
        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

