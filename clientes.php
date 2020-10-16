<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);
    $tabla = 'cliente';
    ?>
    <!-- ADMIN Menu -->
    <!DOCTYPE html>
    <html lang="es">
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Clientes | <?php
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
                                <a href="" class="btn btn-primary disabled">Lista de Clientes</a>

                            </div>
                        </div>
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Cliente</h3>
                            </div>
                            <!-- Se puso como comentario por pedido del profesor 
                            <div class="title_right">
                                <div class="pull-right ">
                                    <div class="input-group">
                                        <a href="addcliente.php" class="btn btn-success"><i class="fa fa-plus m-right-xs"></i> Nuevo Cliente</a>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Lista de Clientes</h2>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Ver Detalle</th>
                                                    <th>Num. Identificación</th>
                                                    <th>Condición</th>
                                                    <th>Apellidos</th>
                                                    <th>Nombres</th>
                                                    <th>Email</th>
                                                    <th>Telf. Fijo</th>
                                                    <th>Telf. Celular</th>
                                                    <th>Editar</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = 'SELECT * FROM ' . $tabla . ' ORDER BY apellidos ASC';
                                                $registros = $obj->query($query);
                                                foreach ($registros AS $row):
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><a href="cliente.php?id=<?php echo $row['id']; ?>" title="Ver" >Ver</a></td>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($row['condicion'] == 'pgen') {
                                                                echo 'Pub. General';
                                                            } elseif ($row['condicion'] == 'tuns') {
                                                                echo 'Trabajador UNS';
                                                            } elseif ($row['condicion'] == 'auns') {
                                                                echo 'Alumno UNS';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $row['apellidos']; ?></td>
                                                        <td><?php echo $row['nombres']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['tfijo']; ?></td>
                                                        <td><?php echo $row['tcelular']; ?></td>
                                                        <td><a href="editcliente.php?id=<?php echo $row['id']; ?>" title="Editar" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                                        <td><a href="#ClienteEliminarModal" data-toggle="modal" onclick="EliminarCliente('<?php echo $row['id']; ?>')" title="Eliminar" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
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

                        <!-- Eliminar Cliente Modal  -->
                        <div class="modal fade" id="ClienteEliminarModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalClienteEliminarLabel">
                        </div>
                        <!-- END Eliminar Cliente Modal -->

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
                                                                    order: [[ 3, "asc" ]]
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
                function EliminarCliente(id) {
                    $.post("modulos/cliente/cliente-modal-eliminar.php", {id: id}, function (data) {
                        $('#ClienteEliminarModal').html(data);
                    });
                }
            </script>
        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

