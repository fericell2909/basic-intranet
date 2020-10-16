<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);

    $tabla = 'ficha';
    $id = $_GET['id'];

    $registro = $obj->registroID($tabla, $id);

    /*
     * Obtenemos la modalidad y condición del curso
     */
    $query_curso = 'SELECT modalidad_id modalidad, condicion FROM cursos WHERE id=' . $registro['curso_id'] . '';
    $resultado_curso = $obj->query($query_curso);
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Editar Ficha | <?php
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
                                <a href="fichas.php" class="btn btn-primary">Lista de Fichas</a>
                                <a href="#" class="btn btn-primary disabled">Editar Ficha</a>
                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Ficha</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Editar Ficha <b> <?php echo $registro['id']; ?> </b></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form id="editar_ficha" name="editar_ficha" action="modulos/ficha/acciones.php?accion=editar" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                            <input type="hidden" id="ficha_id" name="ficha_id" value="<?php echo $registro['id']; ?>">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="cbx_modalidad" name="cbx_modalidad" class="form-control select-modalidad" required>
                                                        <option></option>
                                                        <option value="p" <?php
                                                        if ($resultado_curso[0]['modalidad'] == 'p'): echo 'selected';
                                                        endif;
                                                        ?>>Presencial</option>
                                                        <option value="v" <?php
                                                        if ($resultado_curso[0]['modalidad'] == 'v'): echo 'selected';
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
                                                        if ($resultado_curso[0]['modalidad'] == 'v'):
                                                            ?>
                                                            <option value = "pgen" selected>Público en general</option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="auns"
                                                            <?php
                                                            if ($resultado_curso[0]['condicion'] == 'auns'): echo 'selected';
                                                            endif;
                                                            ?> >
                                                                Alumno o Ex - Alumno UNS
                                                            </option>

                                                            <option value="tuns"
                                                            <?php
                                                            if ($resultado_curso[0]['condicion'] == 'tuns'): echo 'selected';
                                                            endif;
                                                            ?>>
                                                                Trabajador UNS
                                                            </option>

                                                            <option value="pgen"
                                                            <?php
                                                            if ($resultado_curso[0]['condicion'] == 'pgen'): echo 'selected';
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
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Curso:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="cbx_curso" name="cbx_curso" class="form-control select-curso" required>
                                                        <option></option>
                                                        <?php
                                                        $found = false;
                                                        $query = "SELECT id, nombre, costom FROM cursos WHERE modalidad_id='" . $resultado_curso[0]['modalidad'] . "' AND condicion='" . $resultado_curso[0]['condicion'] . "'";
                                                        $cursos = $obj->query($query);
                                                        foreach ($cursos AS $row):
                                                            if (!$found && $registro['curso_id'] == $row['id']):
                                                                $found = true;
                                                                $costo = $row['costom']
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>" selected><?php echo $row['nombre']; ?></option>
                                                                <?php
                                                            else:
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>





                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Horario </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  id="cbx_horario" name="cbx_horario" class="form-control select-horariof">
                                                        <option></option>
                                                        <?php
                                                        $found = false;
                                                        $query = 'SELECT id, horario FROM horario WHERE curso_id="' . $registro['curso_id'] . '"';
                                                        $horarios = $obj->query($query);


                                                        if ($registro['horario'] != NULL):
                                                            ?>
                                                            <option value="<?php echo $registro['horario']; ?>" selected><?php echo $registro['horario']; ?></option>
                                                            <?php
                                                            if (!empty($horarios)) :
                                                                foreach ($horarios AS $row):
                                                                    ?>
                                                                    <option value="<?php echo $row['horario']; ?>"><?php echo $row['horario']; ?></option>
                                                                    <?php
                                                                endforeach;
                                                            endif;


                                                        else:
                                                            if (!empty($horarios)) :
                                                                foreach ($horarios AS $row):
                                                                    ?>
                                                                    <option value="<?php echo $row['horario']; ?>"><?php echo $row['horario']; ?></option>
                                                                    <?php
                                                                endforeach;
                                                            endif;
                                                        endif;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" id="costo_mes" name="costo_mes" value="<?php echo $costo; ?>">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  id="cbx_cliente" name="cbx_cliente" class="form-control select-cliente" >
                                                        <?php
                                                        $found = false;
                                                        $query = "SELECT id, apellidos, nombres FROM cliente";
                                                        $clientes = $obj->query($query);
                                                        foreach ($clientes AS $row):
                                                            if (!$found && $registro['cliente_id'] == $row['id']):
                                                                $found = true;
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>" selected><?php echo $row['id'] . " - " . $row['apellidos'] . " " . $row['nombres']; ?></option>
                                                                <?php
                                                            else:
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>" ><?php echo $row['id'] . " - " . $row['apellidos'] . " " . $row['nombres']; ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar">
                                                </div>
                                            </div>
                                        </form>


                                        <div class="ln_solid"></div>

                                        <div class="x_title">
                                            <h2>Voucher de Ficha</h2>
                                            <div class="pull-right ">
                                                <div class="input-group">
                                                    <a href="#VoucherNuevoModal" data-toggle="modal" onclick="NuevoVoucher('<?php echo $registro['id']; ?>')" title="Nuevo Voucher" class="btn btn-success"><i class="fa fa-plus m-right-xs"></i> Nuevo Voucher</a>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="x_content">
                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Código</th>
                                                        <th class="text-center">Fecha</th>
                                                        <th class="text-center">Editar</th>
                                                        <th class="text-center">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "SELECT v.id voucher_id, v.codigo voucher_codigo, v.fecha voucher_fecha FROM voucher v WHERE v.ficha_id ='" . $registro['id'] . "'";
                                                    $registros = $obj->query($query);
                                                    foreach ($registros AS $row):
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['voucher_codigo']; ?></td>
                                                            <td><?php echo $row['voucher_fecha']; ?></td>
                                                            <td><a href="#VoucherEditarModal" data-toggle="modal" onclick="EditarVoucher('<?php echo $row['voucher_id']; ?>', '<?php echo $registro['id']; ?>')" title="Editar" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                                            <td><a href="#VoucherEliminarModal" data-toggle="modal" onclick="EliminarVoucher('<?php echo $row['voucher_id']; ?>', '<?php echo $registro['id']; ?>')" title="Eliminar" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
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


                        <!-- Nuevo Voucher Modal -->
                        <div class="modal fade" id="VoucherNuevoModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalVoucherNuevoLabel">
                        </div>
                        <!-- END Nuevo Voucher Modal -->

                        <!-- Editar Voucher Modal -->
                        <div class="modal fade" id="VoucherEditarModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalVoucherEditarLabel">
                        </div>
                        <!-- END Editar Voucher Modal -->

                        <!-- Eliminar Voucher Modal  -->
                        <div class="modal fade" id="VoucherEliminarModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalVoucherEliminarLabel">
                        </div>
                        <!-- END Voucher Modal -->


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
            <script src="js/ficha.js" type="text/javascript"></script>

            <script src="js/waitingdialog.js" type="text/javascript"></script>
            <!-- END JS -->

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
                    $('#editar_ficha').submit(function (e) {
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
                                    $(location).attr('href', 'ficha.php?id=' + $('#ficha_id').val());
                                })
                                .always(function () {
                                    waitingDialog.hide();
                                });
                        //return false;
                    });
                });
            </script>

            <script type="text/javascript">
                function NuevoVoucher(id_ficha) {
                    $("#cod_voucher").val('');
                    $("#fecha_voucher").val('');

                    $.post("modulos/voucher/voucher-modal-nuevo.php", {id_ficha: id_ficha}, function (data) {
                        $('#VoucherNuevoModal').html(data);
                    });
                }

                function EditarVoucher(id, id_ficha) {
                    $("#cod_voucher").val('');
                    $("#fecha_voucher").val('');

                    $.post("modulos/voucher/voucher-modal-editar.php", {id: id, id_ficha: id_ficha}, function (data) {
                        $('#VoucherEditarModal').html(data);
                    });
                }
                function EliminarVoucher(id, id_ficha) {
                    $.post("modulos/voucher/voucher-modal-eliminar.php", {id: id, id_ficha: id_ficha}, function (data) {
                        $('#VoucherEliminarModal').html(data);
                    });
                }
            </script>


        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

