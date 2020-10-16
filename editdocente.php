<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);

    $tabla = 'docente';
    $id = $_GET['id'];

    $registro = $obj->registroID($tabla, $id);


    $query_prov = "SELECT idProv FROM ubdistrito WHERE idDist=" . $registro['lndistrito'];
    $resultado_prov = $obj->query($query_prov);

    $query_dep = "SELECT idDepa FROM ubprovincia WHERE idProv =" . $resultado_prov[0]['idProv'];
    $resultado_dep = $obj->query($query_dep);


    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Editar docente | <?php
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
                                <a href="docentes.php" class="btn btn-primary">Lista de Docentes</a>
                                <a href="#" class="btn btn-primary disabled">Editar Docente</a>
                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Docente</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Editar Docente <b> <?php echo $registro['id']; ?> </b></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form id="editar_docente" name="editar_docente" action="modulos/docente/acciones.php?accion=editar" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                            <input type="hidden" id="docente_id" name="docente_id" value="<?php echo $registro['id']; ?>">
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="apellidos" name="apellidos" type="text" class="form-control" pattern="[aábcdeéfghijklmnñoópqrstuúüvwxyzAÁBCDEÉFGHIJKLMNÑOÓPQRSTUÚÜVWXYZ ]{5,}" title="Ingrese 5 o más caracteres" placeholder="Apellido paterno y materno"  value="<?php echo $registro['apellidos']; ?>" required autocomplete="off">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombres <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="nombres" name="nombres" type="text" class="form-control" pattern="[aábcdeéfghijklmnñoópqrstuúüvwxyzAÁBCDEÉFGHIJKLMNÑOÓPQRSTUÚÜVWXYZ ]{3,}" title="Ingrese 3 o más caracteres" placeholder="Nombres" value="<?php echo $registro['nombres']; ?>" required autocomplete="off">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">F. Nacimiento <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="fnacimiento" name="fnacimiento" type="date" class="form-control" step="1" min="1940-01-01" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo $registro['fnacimiento']; ?>" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Domicilio <span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <textarea id="domicilio" name="domicilio" rows="4" cols="50" maxlength="160" class="form-control" placeholder="Domicilio"  required><?php echo $registro['domicilio']; ?></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo<span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sexo" value="m" <?php
                                                        if ($registro['sexo'] == 'm'): echo 'checked';
                                                        endif;
                                                        ?>> Maculino
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="sexo" value="f" <?php
                                                        if ($registro['sexo'] == 'f'): echo 'checked';
                                                        endif;
                                                        ?>> Femenino
                                                    </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lugar de Nacimiento<span class="required">*</span></label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <select id="cbx_departamento" name="cbx_departamento" class="form-control select-departamento" required>
                                                        <option></option>
                                                        <?php
                                                        $query = 'SELECT * FROM ubdepartamento';
                                                        $departamentos = $obj->query($query);
                                                        $found = false;
                                                        foreach ($departamentos as $row):
                                                            if (!$found && $resultado_dep[0]['idDepa'] == $row['idDepa']) :
                                                                $found = true;
                                                                ?>
                                                                <option value="<?php echo $row['idDepa']; ?>" selected><?php echo $row['departamento']; ?></option>
                                                                <?php
                                                            else:
                                                                ?>
                                                                <option value="<?php echo $row['idDepa']; ?>" ><?php echo $row['departamento']; ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <select id="cbx_provincia" name="cbx_provincia" class="form-control select-provincia" required>
                                                        <option></option>
                                                        <?php
                                                        $query = 'SELECT idProv, provincia FROM ubprovincia WHERE idDepa='.$resultado_dep[0]['idDepa'];

                                                        $provincias = $obj->query($query);
                                                        $found = false;
                                                        foreach ($provincias as $row):
                                                            if (!$found && $resultado_prov[0]['idProv'] == $row['idProv']) :
                                                                $found = true;
                                                                ?>
                                                                <option value="<?php echo $row['idProv']; ?>" selected><?php echo $row['provincia']; ?></option>
                                                                <?php
                                                            else:
                                                                ?>
                                                                <option value="<?php echo $row['idProv']; ?>" ><?php echo $row['provincia']; ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <select id="cbx_distrito" name="cbx_distrito" class="form-control select-distrito" required>
                                                        <option></option>
                                                        <?php
                                                        $query = 'SELECT idDist, distrito FROM ubdistrito WHERE idProv='.$resultado_prov[0]['idProv'];
                                                        $distritos = $obj->query($query);
                                                        $found = false;
                                                        foreach ($distritos as $row):
                                                            if (!$found && $registro['lndistrito'] == $row['idDist']) :
                                                                $found = true;
                                                                ?>
                                                                <option value="<?php echo $row['idDist']; ?>" selected><?php echo $row['distrito']; ?></option>
                                                                <?php
                                                            else:
                                                                ?>
                                                                <option value="<?php echo $row['idDist']; ?>" ><?php echo $row['distrito']; ?></option>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Carrera/Ocupación<span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="ocupacion" name="ocupacion" type="text" class="form-control" placeholder="Carrera u ocupación del docente" value="<?php echo $registro['ocupacion']; ?>" required autocomplete="off">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span></label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="email" name="email"  type="email" class="form-control" placeholder="Email" value="<?php echo $registro['email']; ?>" required autocomplete="off">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Facebook</label>
                                                <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                                    <input id="facebook" name="facebook" type="text" class="form-control" placeholder="Nombre con que se encuentra en Facebook" value="<?php echo $registro['facebook']; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-xs-3 col-sm-3" >Telf. Fijo</label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <input id="tfijo" name="tfijo"  type="text" class="form-control" placeholder="Telf. Fijo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $registro['tfijo']; ?>" autocomplete="off">
                                                </div>
                                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12" >Telf. Celular<span class="required">*</span></label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                    <input id="tcelular" name="tcelular"  type="text" class="form-control" placeholder="Telf. Celular" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $registro['tcelular']; ?>" required autocomplete="off">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                                                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar">
                                                </div>
                                            </div>
                                        </form>
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
            <script src="js/select2/select2.min.js" type="text/javascript"></script>
            <script src="js/select2/i18n/es.js" type="text/javascript"></script>
            <script src="js/cliente.js" type="text/javascript"></script>
            <script src="js/waitingdialog.js" type="text/javascript"></script>
            <!-- END JS -->

            <script>
                                                        $(document).ready(function () {
                                                            $('#editar_docente').submit(function (e) {
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
                                                                            $(location).attr('href', 'docente.php?id=' + $('#docente_id').val());
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

