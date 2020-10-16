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
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Nuevo Cliente | <?php
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
                                <a href="clientes.php" class="btn btn-primary">Lista de Clientes</a>
                                <a href="#" class="btn btn-primary disabled">Nuevo Cliente</a>
                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Cliente</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Nuevo Cliente</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <form id="nuevo_cliente" name="nuevo_cliente" action="modulos/cliente/acciones.php?accion=nuevo" method="POST" data-parsley-validate class="form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Condición <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <select id="cbx_condicion" name="cbx_condicion" class="form-control select-condicion" required>
                                                        <option></option>
                                                        <option value="auns">Alumno UNS</option>
                                                        <option value="tuns">Trabajador UNS</option>
                                                        <option value="pgen">Público en general</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">DNI  <span class="required">*</span></label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 margin-bot" >
                                                    <input id="codigo" name="codigo" type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8" pattern=".{8,8}" title="El DNI debe contener 8 caracteres" placeholder="DNI" required autocomplete="off">
                                                    <span id="dni-valid" style="color: red;">El DNI es inválido.</span>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 margin-bot" >
                                                    <button class="btn btn-primary" id="btn-buscar-dni">Buscar</button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos</label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="apellidos" name="apellidos" type="text" class="form-control" pattern="[aábcdeéfghijklmnñoópqrstuúüvwxyzAÁBCDEÉFGHIJKLMNÑOÓPQRSTUÚÜVWXYZ ]{5,}" title="Ingrese 5 o más caracteres" placeholder="Apellido paterno y materno" required autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombres</label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="nombres" name="nombres" type="text" class="form-control" pattern="[aábcdeéfghijklmnñoópqrstuúüvwxyzAÁBCDEÉFGHIJKLMNÑOÓPQRSTUÚÜVWXYZ ]{3,}" title="Ingrese 3 o más caracteres" placeholder="Nombres" required autocomplete="off">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <!--<label class="control-label col-md-3 col-sm-3 col-xs-12">DNI  <span class="required">*</span></label>-->
                                                <!--<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 margin-bot" >-->
                                                <!--    <input id="codigo" name="codigo" type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8" pattern=".{8,8}" title="El DNI debe contener 8 caracteres" placeholder="DNI" required autocomplete="off">-->
                                                <!--</div>-->

                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">F. Nacimiento  <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="fnacimiento" name="fnacimiento"  type="date" class="form-control" step="1" min="1940-01-01" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo date("1992-m-d"); ?>" required autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Domicilio <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <textarea id="domicilio" name="domicilio" rows="4" cols="50" maxlength="160" class="form-control" placeholder="Domicilio"  required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sexo" value="m" checked> Maculino
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="sexo" value="f"> Femenino
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lugar de Residencia <span class="required">*</span></label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <select id="cbx_departamento" name="cbx_departamento" class="form-control select-departamento" required>
                                                        <option></option>
                                                        <?php
                                                        $query = 'SELECT * FROM ubdepartamento';
                                                        $departamentos = $obj->query($query);
                                                        foreach ($departamentos as $row):
                                                            ?>
                                                            <option value="<?php echo $row['idDepa']; ?>"><?php echo $row['departamento']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <select id="cbx_provincia" name="cbx_provincia" class="form-control select-provincia" required>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <select id="cbx_distrito" name="cbx_distrito" class="form-control select-distrito" required>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">¿Estudia o estudió alguna carrera?  <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="col-xs-12">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="rbocupacion" id="ocupacion_si" value="si"  required> Si
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="rbocupacion" id="ocupacion_no"  value="no"> No
                                                        </label>
                                                    </div>
                                                    <br><br>
                                                    <div id="carreras-container" class="row col-xs-12" >
                                                        <select id="cbxcarreras" name="cbxcarreras" class="form-control select-carreras" >
                                                            <option></option>
                                                            <?php
                                                            include ('./elements/arrayCarreras.php');

                                                            for ($i = 0; $i < sizeof($carreras); $i++) {
                                                                ?>
                                                                <option value="<?php echo $carreras[$i]; ?>"><?php echo $carreras[$i]; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <p class="text-muted">Si la carrera no esta en la lista, escriba el nombre de la misma y presione la tecla Enter</p>
                                                    </div>

                                                    <div id="otros-container" class="row col-xs-12">
                                                        <label class="col-xs-12">* Especifique a que se dedica:</label>
                                                        <div class="col-xs-12">

                                                            <input id="otra_ocupacion" name="otra_ocupacion"  type="text" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <input id="ocupacion" name="ocupacion" type="hidden" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="email" name="email"  type="email" class="form-control" placeholder="Email" required autocomplete="off">
                                                    <span id="email-valid" style="color: red;">El correo es inválido.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Facebook </label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="facebook" name="facebook" type="text" class="form-control" placeholder="Nombre con que se encuentra en Facebook"  autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-xs-3 col-sm-3" >Telf. Fijo </label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 ">
                                                    <input id="tfijo" name="tfijo"  type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Telf. Fijo"  autocomplete="off">
                                                </div>
                                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12" >Telf. Celular <span class="required">*</span></label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <input id="tcelular" name="tcelular"  type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Telf. Celular" required autocomplete="off">
                                                    <span id="tcelular-valid" style="color: red;">El telefono celular es invalido</span>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                                                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Crear">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal SUCCESS -->
                        <div class="modal fade" id="ClienteSuccessAddModal" data-backdrop="static" data-keyboard="false" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Cliente creado</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>¡El cliente ha sido satisfactoriamente creado!. </p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-success" href="addcliente.php">Crear otro cliente</a>
                                        <a type="button" class="btn btn-primary" href="clientes.php">Volver a lista de cliente</a>
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
            <script src="js/pace/pace.min.js" type="text/javascript"></script>
            <script src="js/select2/select2.min.js" type="text/javascript"></script>
            <script src="js/select2/i18n/es.js" type="text/javascript"></script>
            <script src="js/cliente.js" type="text/javascript"></script>
            <script src="js/waitingdialog.js" type="text/javascript"></script>
            <!-- END JS -->

            <script>
                                                        $(document).ready(function () {
                                                            // Muestra un modal cuando el submit es success
                                                            $('#nuevo_cliente').submit(function (e) {
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
                                                                            $('#ClienteSuccessAddModal').modal();
                                                                        })
                                                                        .always(function () {
                                                                            waitingDialog.hide();
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

