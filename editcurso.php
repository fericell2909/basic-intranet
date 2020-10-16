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
            <title>Editar Curso | <?php
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
                                <a href="#" class="btn btn-primary disabled">Editar Curso</a>
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
                                        <h2>Editar Curso
                                            <strong><?php echo $registro['nombre']; ?></strong>,
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
                                            ?>
                                        </h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form id="editar_curso" name="editar_curso" action="modulos/curso/acciones.php?accion=editar" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                            <input type="hidden" id="curso_id" name="curso_id" value="<?php echo $registro['id']; ?>">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="cbx_modalidad" name="cbx_modalidad" class="form-control select-modalidad" required>
                                                        <option></option>
                                                        <option value="p" <?php
                                                        if ($registro['modalidad_id'] == 'p'): echo 'selected';
                                                        endif;
                                                        ?>>Presencial</option>
                                                        <option value="v" <?php
                                                        if ($registro['modalidad_id'] == 'v'): echo 'selected';
                                                        endif;
                                                        ?>>Virtual</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="control-label col-md-3 col-sm-3 col-xs-12">Condición <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="cbx_condicion" name="cbx_condicion" class="form-control select-condicion" required>
                                                        <option></option>

                                                        <?php
                                                        if ($registro['modalidad_id'] == 'v'):
                                                            ?>
                                                            <option value = "pgen" selected>Público en general</option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="auns"
                                                            <?php
                                                            if ($registro['condicion'] == 'auns'): echo 'selected';
                                                            endif;
                                                            ?> >
                                                                Alumno o Ex - Alumno UNS
                                                            </option>

                                                            <option value="tuns"
                                                            <?php
                                                            if ($registro['condicion'] == 'tuns'): echo 'selected';
                                                            endif;
                                                            ?>>
                                                                Trabajador UNS
                                                            </option>

                                                            <option value="pgen"
                                                            <?php
                                                            if ($registro['condicion'] == 'pgen'): echo 'selected';
                                                            endif;
                                                            ?>>
                                                                Público en general
                                                            </option>
                                                        <?php
                                                        endif;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $registro['nombre']; ?>" required autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Código de pago <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="codigo" name="codigo" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8"  pattern=".{8,8}" title="Ingrese un código de 8 caracteres" value="<?php echo $registro['codigo']; ?>" required autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Horas académicas
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="horas_acad" name="horas_acad" class="form-control" min="1" max="400" value="<?php echo $registro['horas_acad']; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tiempo en meses
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="tiempo_meses" name="tiempo_meses" class="form-control" min="1" max="12" value="<?php echo $registro['tiempom']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo por mes (S/.)<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="costo" name="costo" class="form-control" min="1" max="1000"  value="<?php echo $registro['costom']; ?>" required autocomplete="off">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">URL de infor. adicional
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="url_info" name="url_info" class="form-control" value="<?php echo $registro['url_info']; ?>" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Visible  <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rbvisible"  value="1"
                                                        <?php
                                                        if ($registro['visible'] == '1'): echo 'checked=""';
                                                        endif;
                                                        ?>> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rbvisible"  value="0"
                                                        <?php
                                                        if ($registro['visible'] == '0'): echo 'checked=""';
                                                        endif;
                                                        ?>> No
                                                    </label>
                                                    <br>
                                                    <p><i>*Un curso visible estará disponible al momento de llenar una ficha</i></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar">
                                                </div>
                                            </div>
                                        </form>


                                        <div class="ln_solid"></div>

                                        <div class="x_title">
                                            <h2>Horarios del Curso</h2>
                                            <div class="pull-right ">
                                                <div class="input-group">
                                                    <a href="#HorarioNuevoModal" data-toggle="modal" onclick="NuevoHorario('<?php echo $registro['id']; ?>')" title="Nuevo Horario" class="btn btn-success"><i class="fa fa-plus m-right-xs"></i> Nuevo Horario</a>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="x_content">
                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" width="60%">Horario</th>
                                                        <th class="text-center">Editar</th>
                                                        <th class="text-center">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "SELECT h.id id_hor , h.horario hor FROM horario h WHERE curso_id='" . $registro['id'] . "'";
                                                    $registros = $obj->query($query);
                                                    foreach ($registros AS $row):
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['hor']; ?></td>
                                                            <td><a href="#HorarioEditarModal" data-toggle="modal" onclick="EditarHorario('<?php echo $row['id_hor']; ?>', '<?php echo $registro['id']; ?>')" title="Editar" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                                            <td><a href="#HorarioEliminarModal" data-toggle="modal" onclick="EliminarHorario('<?php echo $row['id_hor']; ?>', '<?php echo $registro['id']; ?>')" title="Eliminar" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nuevo Horario Modal -->
                        <div class="modal fade" id="HorarioNuevoModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalHorarioNuevoLabel">
                        </div>
                        <!-- END Nuevo Horario Modal -->

                        <!-- Editar Horario Modal -->
                        <div class="modal fade" id="HorarioEditarModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalHorarioEditarLabel">
                        </div>
                        <!-- END Editar Horario Modal -->

                        <!-- Eliminar Horario Modal  -->
                        <div class="modal fade" id="HorarioEliminarModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalHorarioEliminarLabel">
                        </div>
                        <!-- END Eliminar Horario Modal -->

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
            <script src="js/select2/select2.min.js" type="text/javascript"></script>
            <script src="js/select2/i18n/es.js" type="text/javascript"></script>
            <script src="js/curso.js" type="text/javascript"></script>
            <script src="js/waitingdialog.js" type="text/javascript"></script>
            <!-- END JS -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!--<script src="js/bootstrap-show-password.min.js" type="text/javascript"></script>-->
            <!-- Scripts para Datatable -->
            <script>
                                                                var handleDataTableButtons = function () {
                                                                    "use strict";
                                                                    0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                                                                        dom: 'lBfrtip',
                                                                        buttons: [{
                                                                                extend: "copy",
                                                                                className: "btn-sm"
                                                                            }, {
                                                                                extend: "csv",
                                                                                className: "btn-sm"
                                                                            }, {
                                                                                extend: "excel",
                                                                                className: "btn-sm"
                                                                            }, {
                                                                                extend: "pdf",
                                                                                className: "btn-sm"
                                                                            }, {
                                                                                extend: "print",
                                                                                className: "btn-sm"
                                                                            }],
                                                                        responsive: !0,
                                                                        language: {
                                                                            buttons: {
                                                                                copyTitle: 'Copiado al portapapeles',
                                                                                copyKeys: 'Presione <i>ctrl</i> o <i>âŒ˜</i> + <i>C</i> para copiar la data de la tabla <br>a tu portapapeles.<br><br>Para cancelar, de click a este mensaje o presione la tecla Esc.',
                                                                                copySuccess: {
                                                                                    _: '%d filas copiadas',
                                                                                    1: '1 fila copiada'
                                                                                }
                                                                            }
                                                                        }
                                                                    })
                                                                },
                                                                        TableManageButtons = function () {
                                                                            "use strict";
                                                                            return {
                                                                                init: function () {
                                                                                    handleDataTableButtons()
                                                                                }
                                                                            }
                                                                        }();
            </script>
            <script type="text/javascript">
                TableManageButtons.init();
            </script>
            <!-- END Scripts para Datatable -->

            <script>

                $(document).ready(function () {
                    $('#editar_curso').submit(function (e) {
                        e.preventDefault();

                        $.ajax({
                            url: this.action,
                            type: this.method,
                            data: $(this).serialize(),
                            beforeSend: function () {
                                waitingDialog.show('Enviando');
                            }
                        })
                                .done(function () {
                                   $(location).attr('href', 'curso.php?id='+ $('#curso_id').val());
                                })
                                .always(function () {
                                    waitingDialog.hide();
                                });
                        //return false;
                    });
                });
            </script>

            <script type="text/javascript">
                function NuevoHorario(id_curso) {
                    $("#horario").val('');

                    $.post("modulos/horario/horario-modal-nuevo.php", {id_curso: id_curso}, function (data) {
                        $('#HorarioNuevoModal').html(data);
                    });
                }

                function EditarHorario(id, id_curso) {
                    $("#horario").val('');

                    $.post("modulos/horario/horario-modal-editar.php", {id: id, id_curso: id_curso}, function (data) {
                        $('#HorarioEditarModal').html(data);
                    });
                }
                function EliminarHorario(id, id_curso) {
                    $.post("modulos/horario/horario-modal-eliminar.php", {id: id, id_curso: id_curso}, function (data) {
                        $('#HorarioEliminarModal').html(data);
                    });
                }
            </script>
        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

