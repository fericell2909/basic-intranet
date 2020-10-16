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
            <title>Nuevo Curso | <?php
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
                                <a href="#" class="btn btn-primary disabled">Nuevo Curso</a>
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
                                        <h2>Nuevo Curso</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form id="nuevo_curso" name="nuevo_curso" action="modulos/curso/acciones.php?accion=nuevo" method="POST" data-parsley-validate class="form-horizontal form-label-left">
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
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="nombre" name="nombre" class="form-control" required autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Código de pago <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="codigo" name="codigo" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8"  pattern=".{8,8}" title="Ingrese un código de 8 caracteres" required autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Horas académicas
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="horas_acad" name="horas_acad" class="form-control" min="1" max="400"  >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tiempo en meses
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="tiempo_meses" name="tiempo_meses" class="form-control" min="1" max="12"  >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo por mes (S/.)<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="costo" name="costo" class="form-control" min="1" max="1000"  required autocomplete="off">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">URL de infor. adicional
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="url_info" name="url_info" class="form-control" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Visible  <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rbvisible"  value="1"  checked=""> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rbvisible"  value="0"> No
                                                    </label>
                                                    <br>
                                                    <p><i>*Un curso visible estará disponible al momento de llenar una ficha</i></p>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="x_title">
                                                <h2>Horarios del Curso</h2>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="x_content">

                                                <table id="data_table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="60%" class="text-center">Horario</th>
                                                            <th class="text-center">Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td id="td-add-horario">
                                                                <select id="new_name" name="new_name" class="form-control select-horario ">
                                                                    <option></option>
                                                                    <?php
                                                                    include ('./elements/arrayHorarios.php');

                                                                    for ($i = 0; $i < sizeof($horarios_comunes); $i++) {
                                                                        ?>
                                                                        <option value="<?php echo $horarios_comunes[$i]; ?>"><?php echo $horarios_comunes[$i]; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>


                                                            </td>
                                                            <td><a class="btn btn-success btn-xs" type="button" onclick="add_row();" ><i class="fa fa-plus"></i> Agregar Horario </a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p class="text-muted"><i>** Si el horario no esta en la lista, escriba el horario y presione la tecla <kbd>Enter</kbd></i></p>
                                            </div>



                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Crear">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal SUCCESS -->
                        <div class="modal fade" id="CursoSuccessAddModal" data-backdrop="static" data-keyboard="false" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Curso creado</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>¡El curso ha sido satisfactoriamente creado!. </p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-success" href="addcurso.php">Crear otro curso</a>
                                        <a type="button" class="btn btn-primary" href="cursos.php">Volver a lista de cursos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal SUCCESS -->
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

            <!-- Datatables -->
            <script src="js/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
            <script src="js/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
            <script src="js/datatables/buttons.bootstrap.min.js" type="text/javascript"></script>
            <script src="js/datatables/jszip.min.js" type="text/javascript"></script>
            <script src="js/datatables/pdfmake.min.js" type="text/javascript"></script>
            <script src="js/datatables/vfs_fonts.js" type="text/javascript"></script>
            <script src="js/datatables/buttons.html5.min.js" type="text/javascript"></script>
            <script src="js/datatables/buttons.print.min.js" type="text/javascript"></script>
            <script src="js/datatables/dataTables.fixedHeader.min.js" type="text/javascript"></script>
            <script src="js/datatables/dataTables.keyTable.min.js" type="text/javascript"></script>
            <script src="js/datatables/dataTables.responsive.min.js" type="text/javascript"></script>
            <script src="js/datatables/responsive.bootstrap.min.js" type="text/javascript"></script>
            <script src="js/datatables/dataTables.scroller.min.js" type="text/javascript"></script>
            <!-- End Datatables -->


            <script src="js/pace/pace.min.js" type="text/javascript"></script>
            <script src="js/select2/select2.min.js" type="text/javascript"></script>
            <script src="js/select2/i18n/es.js" type="text/javascript"></script>
            <script src="js/curso.js" type="text/javascript"></script>
            <script src="js/waitingdialog.js" type="text/javascript"></script>
            <!-- END JS -->

            <script>

                                                                $(document).ready(function () {
                                                                    // Muestra un modal cuando el submit es success
                                                                    $('#nuevo_curso').submit(function (e) {
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
                                                                                    // Socilitud ajax finalizada, mostramos el modal de success
                                                                                    $('#CursoSuccessAddModal').modal();
                                                                                })
                                                                                .always(function () {
                                                                                    waitingDialog.hide();
                                                                                });
                                                                        //return false;
                                                                    });
                                                                });
            </script>
            <script>
                function edit_row(no)
                {
                    document.getElementById("edit_button" + no).style.display = "none";
                    document.getElementById("save_button" + no).style.display = "inline-block";
                    document.getElementById("name_text" + no).readOnly = false;
                    document.getElementById("name_text" + no).style.borderStyle = "solid";

                    var name = document.getElementById("name_row" + no);

                    var name_data = name.innerHTML;

                    name.innerHTML = name_data;
                }

                function save_row(no)
                {
                    var name_val = document.getElementById("name_text" + no).value;

                    document.getElementById("name_row" + no).innerHTML = "<input type='text' id='name_text" + no + "' value='" + name_val + "' name='horario[]' style='border:none;width: 100%;' readonly>";


                    document.getElementById("edit_button" + no).style.display = "inline-block";
                    document.getElementById("save_button" + no).style.display = "none";
                    document.getElementById("name_text" + no).readOnly = true;
                    document.getElementById("name_text" + no).style.borderStyle = "none";
                }

                function delete_row(no)
                {
                    document.getElementById("row" + no + "").outerHTML = "";
                }

                function add_row()
                {
                    var new_name = document.getElementById("new_name").value;


                    $("#new_name").attr('required', true);
                    var inpObj = document.getElementById("new_name");
                    document.getElementById("td-add-horario").style.backgroundColor = "initial";

                    if (!inpObj.checkValidity()) {
                        $("#new_name").removeAttr('required');
                        document.getElementById("td-add-horario").style.backgroundColor = "#DC143C";
                    } else {
                        $("#new_name").removeAttr('required');
                        var table = document.getElementById("data_table");
                        var table_len = (table.rows.length) - 1;
                        var row = table.insertRow(table_len).outerHTML = "<tr id='row" + table_len + "'><td id='name_row" + table_len + "'>   <input type='text' id='name_text" + table_len + "' value='" + new_name + "' name='horario[]'  style='border:none;width: 100%;' readonly>   </td><td><a  id='edit_button" + table_len + "' onclick='edit_row(" + table_len + ")' title='Editar' class='btn btn-xs btn-default'><i class='fa fa-pencil'></i></a> <a  id='save_button" + table_len + "' style='display:none;' onclick='save_row(" + table_len + ")' title='Guardar' class='btn btn-xs btn-default'><i class='fa fa-save'></i></a> <a  onclick='delete_row(" + table_len + ")' title='Eliminar' class='btn btn-xs btn-danger'><i class='fa fa-times'></i></a> </td></tr>";

                        //$("#select-horario").select2('val', '');
                        //document.getElementById("new_name").value = "";


                    }


                }
            </script>
        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

