<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);
    $tabla = 'ficha';
    ?>
    <!-- ADMIN Menu -->
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Fichas | <?php
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
                                <a href="" class="btn btn-primary disabled">Lista de Fichas</a>

                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Ficha</h3>
                            </div>
                            <div class="title_right">
                                <div class="pull-right ">
                                    <div class="input-group">
                                        <a href="addficha.php" class="btn btn-success"><i class="fa fa-plus m-right-xs"></i> Nuevo Ficha</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Lista de Fichas</h2>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Ver Detalle</th>
                                                    <th>Num. Ficha</th>
                                                    <th>Fecha</th>
                                                    <th>Modalidad</th>
                                                    <th>Condición</th>
                                                    <th>Curso</th>
                                                    <th>Apellidos</th>
                                                    <th>Nombres</th>
                                                    <th>Num. Identificación</th>
                                                    <th>Editar</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = 'SELECT f.id ficha_id, f.created fecha, cur.nombre curso_nombre, cur.condicion cond_curso,  cur.modalidad_id modalidad, c.apellidos apellidos, c.nombres nombres, c.id cliente_id, c.condicion cond_cliente FROM ' . $tabla . ' f INNER JOIN cliente c ON f.cliente_id = c.id INNER JOIN cursos cur ON f.curso_id = cur.id  WHERE f.estado = "1" ORDER BY f.created DESC';
                                                $registros = $obj->query($query);
                                                foreach ($registros AS $row):
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><a href="ficha.php?id=<?php echo $row['ficha_id']; ?>" title="Ver" >Ver</a></td>
                                                        <td><?php echo $row['ficha_id']; ?></td>
                                                        <td><?php echo $row['fecha']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($row['modalidad'] == 'p') {
                                                                echo 'presencial';
                                                            } else {
                                                                echo 'virtual';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($row['cond_curso'] == 'pgen') {
                                                                echo 'Pub. General';
                                                            } elseif ($row['cond_curso'] == 'tuns') {
                                                                echo 'Trabajador UNS';
                                                            } elseif ($row['cond_curso'] == 'auns') {
                                                                echo 'Alumno UNS';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $row['curso_nombre']; ?></td>
                                                        <td><?php echo $row['apellidos']; ?></td>
                                                        <td><?php echo $row['nombres']; ?></td>
                                                        <td><?php echo $row['cliente_id']; ?></td>
                                                        <td><a href="editficha.php?id=<?php echo $row['ficha_id']; ?>" title="Editar" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                                        <td><a href="#FichaEliminarModal" data-toggle="modal" onclick="EliminarFicha('<?php echo $row['ficha_id']; ?>')" title="Eliminar" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
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

                        <!-- Eliminar Ficha Form  -->
                        <div class="modal fade" id="FichaEliminarModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalFichaEliminarLabel">
                        </div>
                        <!-- END Eliminar Ficha Form  -->

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
                                                                    },
                                                                    order: [[ 2, "desc" ]]
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

            <script type="text/javascript">
                function EliminarFicha(id) {
                    $.post("modulos/ficha/ficha-modal-eliminar.php", {id: id}, function (data) {
                        $('#FichaEliminarModal').html(data);
                    });
                }
            </script>
        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

