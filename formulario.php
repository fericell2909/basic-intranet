<?php
require_once 'config/db.php';
$obj = new DB();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Llenado de Ficha</title>

        <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
        <!-- Stylesheets -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/formficha.css" rel="stylesheet" type="text/css"/>
        <link href="css/customwizard/customwizard.css" rel="stylesheet" type="text/css"/>
        <!-- END Stylesheets -->

        <!-- JS -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- END JS -->

    </head>
    <body>
        <!-- MENU -->
        <header>
            <div class="container">
                <nav class="navbar navbar-inverse navbar-fixed-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
                                <span class="sr-only">menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="#" class="navbar-brand">CECOMP</a>
                        </div>

                        <div class="collapse navbar-collapse navbar-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active"><a href="formulario.php" ><span class="glyphicon glyphicon-list-alt"></span> Llenar Ficha</a></li>
                                <li><a href="conscertificado.php" ><span class="glyphicon glyphicon-search"></span> Consulta Certificados</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- END MENU-->

        <!-- Form Block-->
        <div class="container fondo-blanco">
            <div class="page-header text-center">
                <h1>Llenado de Ficha </h1>
            </div>
            <!-- Steps Block -->
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary  wstep">1</a>
                        <p>Datos del Curso</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default wstep disabled">2</a>
                        <p> Datos Personales</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default  wstep disabled">3</a>
                        <p> Datos del Pago</p>
                    </div>
                </div>
            </div>
            <!-- END Steps Block -->

            <!-- Form content -->
            <form id="ficha" name="ficha" role="form" action="modulos/ficha/acciones.php?accion=nuevo_fp" method="POST" class="form-horizontal font-formulario">

                <!-- Datos del Curso -->
                <div class="row setup-content" id="step-1">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <h2 class="StepTitle ">Datos del Curso</h2>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad  <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="cbx_modalidad" name="cbx_modalidad" class="form-control select-modalidad" required>
                                        <option></option>
                                        <option value="p">Presencial</option>
                                        <option value="v">Virtual</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="control-label col-md-3 col-sm-3 col-xs-12">Condición <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="cbx_condicion" name="cbx_condicion" class="form-control select-condicion" required>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Curso  <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="cbx_curso" name="cbx_curso" class="form-control select-curso" required>
                                    </select>
                                    <a id="url_info" target="_blank">Click aquí para obtener información adicional</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Código de curso </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <p class="form-control-static" id="cod_curso" name="cod_curso"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Horas académicas </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <p class="form-control-static" id="horas_acad" name="horas_acad"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tiempo </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <p class="form-control-static" id="tiempo" name="tiempo"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Horario </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select  id="cbx_horario" name="cbx_horario" class="form-control select-horariof">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo por mes </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <p class="form-control-static" id="costo_mes2" ></p>
                                    <input id="costo_mes" name="costo_mes" type="hidden" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad de Pago </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="col-xs-12">
                                        <label class="radio-inline">
                                            <input type="radio" name="rbpago" id="pago_interior" value="interior" > Banco de la Nación Interior UNS
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="rbpago" id="pago_exterior"  value="exterior"> Otro Banco de la Nación
                                        </label>
                                    </div>
                                    <br><br>
                                    <div id="pago-container" class="row col-xs-12"></div>
                                </div>
                            </div>

                            <br><br>
                            <hr>
                            <button class="btn btn-primary nextBtn btn-md pull-right" type="button" >Siguiente >></button>
                        </div>
                    </div>
                </div>
                <!-- END Datos del Curso -->

                <!-- Datos Personales -->
                <div class="row setup-content" id="step-2">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <h2 class="StepTitle">Datos Personales</h2>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="apellidos" name="apellidos" type="text" class="form-control" pattern="[aábcdeéfghijklmnñoópqrstuúüvwxyzAÁBCDEÉFGHIJKLMNÑOÓPQRSTUÚÜVWXYZ ]{5,}" title="Ingrese 5 o más caracteres" placeholder="Apellido paterno y materno"  required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombres <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="nombres" name="nombres" type="text" class="form-control" pattern="[aábcdeéfghijklmnñoópqrstuúüvwxyzAÁBCDEÉFGHIJKLMNÑOÓPQRSTUÚÜVWXYZ ]{3,}" title="Ingrese 3 o más caracteres" placeholder="Nombres" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">DNI  <span class="required">*</span></label>
                                <div class=" col-md-3 col-sm-3 col-xs-12 margin-bot" >
                                    <input id="codigo" name="codigo" type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8" pattern=".{8,8}" title="El DNI debe contener 8 caracteres" placeholder="DNI" required autocomplete="off">
                                </div>

                                <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12">F. Nacimiento  <span class="required">*</span></label>
                                <div class=" col-md-3 col-sm-3 col-xs-12 margin-bot">
                                    <input id="fnacimiento" name="fnacimiento"  type="date" class="form-control" step="1" min="1940-01-01" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo date("1992-m-d"); ?>" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Domicilio <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="domicilio" name="domicilio" rows="4" cols="50" maxlength="160" class="form-control" placeholder="Domicilio" required ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo <span class="required">*</span></label>
                                <div class=" col-md-9 col-sm-9 col-xs-12">
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
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                    <select id="cbx_departamento" name="cbx_departamento" class="form-control select-departamento" required style="width: 100%"  >
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
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <select id="cbx_provincia" name="cbx_provincia" class="form-control select-provincia" required style="width: 100%"  >
                                        <option></option>
                                    </select>
                                </div>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                    <select id="cbx_distrito" name="cbx_distrito" class="form-control select-distrito" required style="width: 100%"  >
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">¿Estudia o estudió alguna carrera?  <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-xs-12">
                                        <label class="radio-inline">
                                            <input type="radio" name="rbocupacion" id="ocupacion_si" value="si" required > Si
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="rbocupacion" id="ocupacion_no"  value="no"> No
                                        </label>
                                    </div>
                                    <br><br>
                                    <div id="carreras-container" class="row col-xs-12" >
                                        <select id="cbxcarreras" name="cbxcarreras" class="form-control select-carreras" style="width: 100%">
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
                                <div class=" col-md-9 col-sm-9 col-xs-12">
                                    <input id="email" name="email"  type="email" class="form-control" placeholder="Email" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Facebook </label>
                                <div class=" col-md-9 col-sm-9 col-xs-12">
                                    <input id="facebook" name="facebook" type="text" class="form-control" placeholder="Nombre con que se encuentra en Facebook"  autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-3" >Telf. Fijo </label>
                                <div class=" col-md-3 col-sm-3 col-xs-12 ">
                                    <input id="tfijo" name="tfijo"  type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Telf. Fijo"  autocomplete="off">
                                </div>
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Telf. Celular <span class="required">*</span></label>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                    <input id="tcelular" name="tcelular"  type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Telf. Celular" required autocomplete="off">
                                </div>
                            </div>

                            <br><br>
                            <hr>
                            <button class="btn btn-primary prevBtn btn-md pull-left" type="button" ><< Anterior</button>
                            <!--CHEQUEAR !!! -->
                            <button class="btn btn-primary nextBtn btn-md pull-right" type="button" >Siguiente >></button>
                        </div>
                    </div>
                </div>
                <!-- END Datos Personales -->

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
                                    <p>*La imagen mostrada es referencial, usted deberá ingresar el código de voucher y fecha de su pago.</p>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                                    <img src="images/voucher.jpg" alt="Voucher de referencia" style="width: 100%;"/>
                                </div>
                            </div>
                            <br><br>
                            <hr>
                            <div class="form-group">
                                <div class="col-xs-12 ">
                                    <input type="submit" class="btn btn-danger btn-lg btn-block" value="Enviar">
                                </div>
                            </div>
                            <button class="btn btn-primary prevBtn btn-md pull-left" type="button" ><< Anterior</button>
                        </div>
                    </div>
                </div>
                <!-- END Datos del Pago -->
            </form>
            <!-- END Form content-->
        </div>
        <!--END Form Block-->

        <!-- Modal SUCCESS -->
        <div class="modal fade" id="FichaModal" data-backdrop="static" data-keyboard="false" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ficha Registrada</h4>
                    </div>

                    <div class="modal-body" id="contenidoFichaModal">
                    </div>

                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary" href="https://www.centrocomputouns.edu.pe/">Entendido</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal SUCCESS -->

        <!-- Footer -->
        <footer>
            <div class="container">
                <p class="pfooter">
                    <span class="glyphicon glyphicon-earphone"></span> Telefono : (043) 31-0445 Anexo: 1018<br>
                    <span class="glyphicon glyphicon-envelope"></span> Correo : cecomp@uns.edu.pe<br>
                    <span class="glyphicon glyphicon-envelope"></span> Correo : centro_computo_uns@hotmail.com<br>
                    <span class="glyphicon glyphicon-map-marker"></span> Urb. Bellamar, Av. Universitaria S/N- Pabellón de la E.A.P.I.S.I.<br>
                </p>
            </div>
        </footer>
        <!-- END Footer -->

        <!-- JS -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/select2/select2.min.js" type="text/javascript"></script>
        <script src="js/select2/i18n/es.js" type="text/javascript"></script>
        <script src="js/progressbar/bootstrap-progressbar.min.js" type="text/javascript"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js" type="text/javascript"></script>

        <script src="js/ficha.js" type="text/javascript"></script>
        <script src="js/cliente.js" type="text/javascript"></script>
        <script src="js/curso.js" type="text/javascript"></script>
        <script src="js/waitingdialog.js" type="text/javascript"></script>
        <!-- END JS -->


    </body>
</html>


