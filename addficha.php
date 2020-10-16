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
            <title>Nuevo Ficha | <?php
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
            <link href="css/customwizard/customwizard.css" rel="stylesheet" type="text/css"/>

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
                                <a href="#" class="btn btn-primary disabled">Nueva Ficha</a>
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
                                        <h2>Nueva Ficha</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <div class="stepwizard">
                                            <div class="stepwizard-row setup-panel">
                                                <div class="stepwizard-step">
                                                    <a href="#step-1" type="button" class="btn btn-primary  wstep">1</a>
                                                    <p>Datos del Curso</p>
                                                </div>
                                                <div class="stepwizard-step">
                                                    <a href="#step-2" type="button" class="btn btn-default wstep disabled">2</a>
                                                    <p> Datos del Cliente</p>
                                                </div>
                                                <div class="stepwizard-step">
                                                    <a href="#step-3" type="button" class="btn btn-default  wstep disabled">3</a>
                                                    <p> Datos del Pago</p>
                                                </div>
                                            </div>
                                        </div>

                                        <form id="nueva_ficha" name="nueva_ficha" action="modulos/ficha/acciones.php?accion=nuevo" method="POST" data-parsley-validate class="form-horizontal">
                                            <!-- Datos del Curso -->
                                            <div class="row setup-content" id="step-1">
                                                <div class="col-xs-12">
                                                    <div class="col-md-12">
                                                        <h2 class="StepTitle ">Datos del Curso</h2>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad  <span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select id="cbx_modalidad" name="cbx_modalidad" class="form-control select-modalidad" required>
                                                                    <option></option>
                                                                    <option value="p">Presencial</option>
                                                                    <option value="s">Semi Presencial</option>
                                                                    <option value="v">Virtual</option>
                                                                    <option value="e">Especializaciones</option>
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
                                                                <a id="url_info" target="_blank">Click aquí para obtener información adicional</a>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group" id="slc_tipo">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12"> 
                                                                <select class="form-control select-tipo" id="cbx_tipo" name="cbx_tipo">
                                                                    <option value="n">Regular</option>
                                                                    <option value="i">Intensivo</option>
                                                                    <option value="s">Semi intensivo</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Código de curso </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <p class="form-control-static" id="cod_curso" name="cod_curso"></p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Horas académicas </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <p class="form-control-static" id="horas_acad" name="horas_acad"></p>
                                                            </div>
                                                        </div>

                                                        <!--<div class="form-group">-->
                                                        <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tiempo </label>-->
                                                        <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                                                        <!--        <p class="form-control-static" id="tiempo" name="tiempo"></p>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Horario </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select  id="cbx_horario" name="cbx_horario" class="form-control select-horariof">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo por mes </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <p class="form-control-static" id="costo_mes2" ></p>
                                                                <input id="costo_mes" name="costo_mes" type="hidden" >
                                                            </div>
                                                        </div>

                                                        <br><br>
                                                        <hr>
                                                        <button class="btn btn-primary nextBtn btn-md pull-right" type="button" >Siguiente >></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Datos del Curso -->


                                            <!-- Datos del Cliente -->
                                            <div class="row setup-content" id="step-2">
                                                <div class="col-xs-12">
                                                    <div class="col-md-12">
                                                        <h2 class="StepTitle">Datos del Cliente</h2>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente  <span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="rbcliente" id="cliente_si" value="existe"  required> Existente
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="rbcliente" id="cliente_no"  value="nuevo"> Nuevo
                                                                </label>
                                                                <br><br>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" id="valor_cliente" name="valor_cliente">

                                                        <div id="list_cliente-container" class="row col-xs-12" >
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">* Seleccione al cliente:</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select  id="cbx_cliente" name="cbx_cliente" class="form-control select-cliente" style="width: 100%" >
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
                                                        </div>
                                                        <div id="new_cliente-container" class="row col-xs-12">
                                                            <label class="col-xs-12">* Especifique los datos del cliente:</label>

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
                                                                    <!--
                                                                    <div id="otros-container" class="row col-xs-12">
                                                                        <label class="col-xs-12">* Especifique a que se dedica:</label>
                                                                        <div class="col-xs-12">
                
                                                                            <input id="otra_ocupacion" name="otra_ocupacion"  type="text" class="form-control" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    -->
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
                                                        </div>
                                                        <br><br>
                                                        <hr>
                                                        <button class="btn btn-primary prevBtn btn-md pull-left" type="button" ><< Anterior</button>
                                                        <button class="btn btn-primary nextBtnCliente btn-md pull-right" type="button" >Siguiente >></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Datos del Cliente -->


                                            <!-- Datos del Pago -->
                                            <div class="row setup-content" id="step-3">
                                                <div class="col-xs-12">
                                                    <div class="col-md-12">
                                                        <h2 class="StepTitle">Datos del Pago</h2>

                                                        <div class="form-group">
                                                            <br><br>
                                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="control-label col-xs-3">Código de Voucher </label>
                                                                    <div class="col-xs-9 " >
                                                                        <input id="cod_voucher" name="cod_voucher" type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="7" pattern=".{7,7}" title="El código de voucher debe contener 7 caracteres" placeholder="Código de voucher" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-xs-3">Fecha </label>
                                                                    <div class="col-xs-9" >
                                                                        <input id="fecha_voucher" name="fecha_voucher" type="text" class="form-control"  maxlength="9"  pattern="([0-9]{2,2})+([A-Z]{3,3})+([0-9]{4,4})$" title="La fecha debe tener el formato establecido en la imagen" placeholder="Fecha de voucher" autocomplete="off" >
                                                                    </div>
                                                                </div>
                                                                <p>*Si todavía no ha realizado el pago puede omitir este paso dejando en blanco el código de voucher y fecha.</p>
                                                            </div>
                                                            <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                                                                <img src="images/voucher.jpg" alt="Voucher de referencia" style="width: 100%;"/>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <hr>
                                                        <div class="form-group">
                                                            <div class="col-xs-12 ">
                                                                <input type="submit" class="btn btn-danger btn-lg btn-block" value="Crear">
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary prevBtn btn-md pull-left" type="button" ><< Anterior</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Datos del Pago -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal SUCCESS -->
                        <div class="modal fade" id="FichaSuccessAddModal" data-backdrop="static" data-keyboard="false" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ficha creada</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>¡Ficha ha sido satisfactoriamente creada!. </p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-success" href="addficha.php">Crear otra ficha</a>
                                        <a type="button" class="btn btn-primary" href="fichas.php">Volver a lista de fichas</a>
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
            <script src="js/curso.js" type="text/javascript"></script>
            <script src="js/ficha.js" type="text/javascript"></script>
            <!-- <script src="js/cliente.js" type="text/javascript"></script> -->


            <script src="js/waitingdialog.js" type="text/javascript"></script>
            <!-- END JS -->

            <script>

            $(document).ready(function () {
                // Muestra un modal cuando el submit es success

                $('#nueva_ficha').submit(function (e) {
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
                                $('#FichaSuccessAddModal').modal();
                            })
                            .always(function () {
                                waitingDialog.hide();
                            });
                    //return false;
                });
            });
            </script>
        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

