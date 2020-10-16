<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);

    $tabla = 'certificado';
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
            <title>Editar Certificado | <?php
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
                                <a href="certificados.php" class="btn btn-primary">Lista de Certificados</a>
                                <a href="#" class="btn btn-primary disabled">Editar Certificado</a>
                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Certificado</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Editar Certificado
                                            <strong><?php echo $registro['id']; ?></strong>
                                        </h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form id="editar_certificado" name="editar_certificado" action="modulos/certificado/acciones.php?accion=editar" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                            <input type="hidden" id="certificado_id" name="certificado_id" value="<?php echo $registro['id']; ?>">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado  <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rbestado"  value="tramite"  required <?php
                                                        if ($registro['estado'] == '0'): echo 'checked';
                                                        endif;
                                                        ?>> En trámite
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="rbestado"   value="emitido" <?php
                                                        if ($registro['estado'] == '1'): echo 'checked';
                                                        endif;
                                                        ?>> Emitido
                                                    </label>
                                                    <br><br>
                                                </div>
                                            </div>


                                            <div id="coddec-container" class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Decanatura <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="coddec" name="coddec" type="text" class="form-control" data-inputmask="'mask': '9999-9999'" value="<?php echo $registro['coddec']; ?>">
                                                </div>
                                            </div>

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
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Curso <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="cbx_curso" name="cbx_curso" class="form-control select-curso" required>
                                                        <option></option>
                                                        <?php
                                                        $found = false;
                                                        $query = "SELECT id, nombre, horas_acad FROM cursos WHERE modalidad_id='" . $resultado_curso[0]['modalidad'] . "' AND condicion='" . $resultado_curso[0]['condicion'] . "'";
                                                        $cursos = $obj->query($query);
                                                        foreach ($cursos AS $row):
                                                            if (!$found && $registro['curso_id'] == $row['id']):
                                                                $found = true;
                                                                $horas = $row['horas_acad'];
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
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Horas académicas </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static" id="horas_acad" name="horas_acad">
                                                        <?php
                                                        if ($horas): echo $horas;
                                                        else: echo '<i>No especificado</i>';
                                                        endif;
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-xs-3 col-sm-3" >Fecha curso <span class="required">*</span></label>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                                                    <div >
                                                        <select id="cbx_fmes" name="cbx_cemes" class="form-control select-mes " required   >
                                                            <?php
                                                            include ('./elements/arrayMeses.php');
                                                            $found = false;
                                                            for ($i = 0; $i < sizeof($meses); $i++) {
                                                                if (!$found && $registro['cemes'] == $meses[$i]):
                                                                    $found = true;
                                                                    ?>
                                                                    <option value="<?php echo $meses[$i]; ?>" selected><?php echo $meses[$i]; ?></option>
                                                                    <?php
                                                                else:
                                                                    ?>
                                                                    <option value="<?php echo $meses[$i]; ?>" ><?php echo $meses[$i]; ?></option>
                                                                <?php
                                                                endif;
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <label class="control-label col-lg-1 col-xs-1 col-sm-1" style="text-align: center;" >de</label>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                                                    <input id="ceanio" name="ceanio" type="number"  class="form-control"  min="2012" max="<?php echo date("Y"); ?>" step="1" value="<?php echo $registro['ceanio']; ?>" required autocomplete="off" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  id="cbx_cliente" name="cbx_cliente" class="form-control select-cliente" required>
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

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nota Final <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="nota_final" name="nota_final" class="form-control" min="14" max="20" value="<?php echo $registro['nota_final']; ?>" required >
                                                </div>
                                            </div>

                                            <div id="femision-container" class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">F. Emisión  <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="femision" name="femision"  type="date" class="form-control" step="1" min="2012-01-01" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo $registro['femision']; ?>" autocomplete="off">
                                                </div>
                                            </div>

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
            <script src="js/input_mask/jquery.inputmask.js" type="text/javascript"></script>
            <script src="js/curso.js" type="text/javascript"></script>
            <script src="js/certificado.js" type="text/javascript"></script>

            <script src="js/waitingdialog.js" type="text/javascript"></script>

            <!-- END JS -->
        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

