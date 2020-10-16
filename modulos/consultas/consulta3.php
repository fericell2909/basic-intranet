<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();
    $cliente_id = $_GET['idCliente'];
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <script>
                var handleDataTableButtons = function () {
                    "use strict";
                    0 !== $("#consulta3-table").length && $("#consulta3-table").DataTable({
                        destroy: true,
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
                        order: [[2, "desc"]]
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


                $(document).ready(function () {
                    TableManageButtons.init();
                });
            </script>
        </head>
        <body>
            <div id="modulo_tabla">
                <table id="consulta3-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Ver Detalle</th>
                            <th>Num. Ficha</th>
                            <th>Fecha</th>
                            <th>Modalidad</th>
                            <th>Condición</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT f.id num_ficha, f.created fecha, c.modalidad_id modalidad, c.condicion condicion, c.nombre curso
                                    FROM ficha f INNER JOIN cursos c ON c.id = f.curso_id
                                    WHERE f.cliente_id = " . $cliente_id . " AND f.estado = '1'";

                        $resultado = $obj->query($query);

                        foreach ($resultado AS $row):
                            ?>
                            <tr>
                                <td class="text-center"><a href="ficha.php?id=<?php echo $row['num_ficha']; ?>" title="Ver Ficha" target="_blank" >Ver Ficha</a></td>
                                <td><?php echo $row['num_ficha']; ?></td>
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
                                    if ($row['condicion'] == 'pgen') {
                                        echo 'Pub. General';
                                    } elseif ($row['condicion'] == 'tuns') {
                                        echo 'Trabajador UNS';
                                    } elseif ($row['condicion'] == 'auns') {
                                        echo 'Alumno UNS';
                                    }
                                    ?>
                                </td>

                                <td><?php echo $row['curso']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </body>
    </html>
    <?php
else:
    header('location:../../403.php');
endif;
