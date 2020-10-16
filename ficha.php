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
    $query_curso = 'SELECT modalidad_id modalidad, condicion, nombre, tiempom FROM cursos WHERE id=' . $registro['curso_id'] . '';
    $resultado_curso = $obj->query($query_curso);

    /*
     * Obtenemos datos del cliente
     */
    $query_cliente = 'SELECT * FROM cliente WHERE id=' . $registro['cliente_id'] . '';
    $resultado_cliente = $obj->query($query_cliente);


    $query_dist = "SELECT distrito, idProv FROM ubdistrito WHERE idDist=" . $resultado_cliente[0]['lndistrito'];
    $resultado_dist = $obj->query($query_dist);

    $query_prov = "SELECT provincia, idDepa FROM ubprovincia WHERE idProv =" . $resultado_dist[0]['idProv'];
    $resultado_prov = $obj->query($query_prov);

    $query_dep = "SELECT departamento FROM ubdepartamento WHERE idDepa=" . $resultado_prov[0]['idDepa'];
    $resultado_dep = $obj->query($query_dep);
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Ver Ficha | <?php
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
                                <a href="#" class="btn btn-primary disabled">Ver Ficha</a>
                            </div>
                        </div>

                        <form class="form-horizontal form-label-left" action="generarPDF.php" method="post">

                            <div class="page-title">
                                <div class="title_left">
                                    <h3>Ficha</h3>
                                </div>
                                <div class="title_right">
                                    <div class="pull-right ">
                                        <div class="input-group">
                                            <button class="btn btn-info" type="submit" name="submit"><i class="fa fa-print m-right-xs"></i> Imprimir Ficha</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div  class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="detalle-ficha" class="x_panel">
                                        <div class="x_title">
                                            <h2> Ficha <b> <?php echo $registro['id']; ?> </b> <?php
                                                if ($registro['estado'] == '0'): echo '<span class="label label-danger" style="color: #ffffff!important;">Ficha eliminada</span>';
                                                endif;
                                                ?></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($resultado_curso[0]['modalidad'] == 'p') {
                                                            $h_modalidad = 'Presencial';
                                                            echo 'Presencial';
                                                        } elseif ($resultado_curso[0]['modalidad'] == 'v') {
                                                            $h_modalidad = 'Virtual';
                                                            echo 'Virtual';
                                                        }
                                                        ?>
                                                    </p>
                                                    <input  type="hidden" id="h_modalidad" name="h_modalidad" value="<?php echo $h_modalidad; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Condición</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($resultado_curso[0]['condicion'] == 'auns') {
                                                            echo 'Alumno o Ex - Alumno UNS';
                                                        } elseif ($resultado_curso[0]['condicion'] == 'tuns') {
                                                            echo 'Trabajador UNS';
                                                        } elseif ($resultado_curso[0]['condicion'] == 'pgen') {
                                                            echo 'Público en general';
                                                        }
                                                        ?>
                                                    </p>
                                                    <input  type="hidden" id="h_condicion" name="h_condicion" value="<?php echo $resultado_curso[0]['condicion'] ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Curso</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $resultado_curso[0]['nombre']; ?></p>
                                                    <input  type="hidden" id="h_curso" name="h_curso" value="<?php echo $resultado_curso[0]['nombre'] ?>">
                                                    <input  type="hidden" id="h_tiempom" name="h_tiempom" value="<?php echo $resultado_curso[0]['tiempom'] ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $resultado_cliente[0]['id'] . " - " . $resultado_cliente[0]['apellidos'] . " " . $resultado_cliente[0]['nombres']; ?></p>
                                                    <input  type="hidden" id="h_apellidos" name="h_apellidos" value="<?php echo $resultado_cliente[0]['apellidos'] ?>">
                                                    <input  type="hidden" id="h_nombres" name="h_nombres" value="<?php echo $resultado_cliente[0]['nombres'] ?>">
                                                    <input  type="hidden" id="h_id" name="h_id" value="<?php echo $resultado_cliente[0]['id'] ?>">
                                                    <input  type="hidden" id="h_fnacimiento" name="h_fnacimiento" value="<?php echo $resultado_cliente[0]['fnacimiento'] ?>">
                                                    <input  type="hidden" id="h_domicilio" name="h_domicilio" value="<?php echo $resultado_cliente[0]['domicilio'] ?>">
                                                    <input  type="hidden" id="h_sexo" name="h_sexo" value="<?php echo $resultado_cliente[0]['sexo'] ?>">
                                                    <input  type="hidden" id="h_email" name="h_email" value="<?php echo $resultado_cliente[0]['email'] ?>">
                                                    <input  type="hidden" id="h_tfijo" name="h_tfijo" value="<?php echo $resultado_cliente[0]['tfijo'] ?>">
                                                    <input  type="hidden" id="h_tcelular" name="h_tcelular" value="<?php echo $resultado_cliente[0]['tcelular'] ?>">
                                                    <input  type="hidden" id="h_distrito" name="h_distrito" value="<?php echo $resultado_dist[0]['distrito'] ?>">
                                                    <input  type="hidden" id="h_provincia" name="h_provincia" value="<?php echo $resultado_prov[0]['provincia'] ?>">
                                                    <input  type="hidden" id="h_departamento" name="h_departamento" value="<?php echo $resultado_dep[0]['departamento'] ?>">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">F. Creación</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['created']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo por mes (S/.)</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static"><?php echo $registro['costo']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Horario</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <p class="form-control-static">
                                                        <?php
                                                        if ($registro['horario'] == NULL) {
                                                            echo '<i>No especificado</i>';
                                                        } else {
                                                            echo $registro['horario'];
                                                        }
                                                        ?>
                                                    </p>
                                                    <input  type="hidden" id="h_horario" name="h_horario" value="<?php echo $registro['horario'] ?>">
                                                </div>
                                            </div>



                                            <div class="ln_solid"></div>

                                            <div class="x_title">
                                                <h2>Voucher de Ficha</h2>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="x_content">
                                                <?php
                                                $query = "SELECT v.id voucher_id, v.codigo voucher_codigo, v.fecha voucher_fecha FROM voucher v WHERE v.ficha_id ='" . $registro['id'] . "'";
                                                $voucher = $obj->query($query);
                                                if (!empty($voucher)) :
                                                    ?>
                                                    <table class="table table-striped table-bordered " cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" >Código</th>
                                                                <th class="text-center" >Fecha</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($voucher AS $row):
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['voucher_codigo']; ?></td>
                                                                    <td><?php echo $row['voucher_fecha']; ?></td>
                                                                </tr>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                else:
                                                    ?>
                                                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                        Aún no se ha registrado voucher para esta ficha.
                                                    </div>
                                                <?php
                                                endif;
                                                ?>
                                            </div>




                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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

            <!-- END JS -->

            <script>
                /*
                 function printContent(el) {
                 var restorepage = document.body.innerHTML;
                 var printcontent = document.getElementById(el).innerHTML;
                 document.body.innerHTML = printcontent;
                 window.print();
                 document.body.innerHTML = restorepage;
                 }*/



            </script>



        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

