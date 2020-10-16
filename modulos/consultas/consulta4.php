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
                    0 !== $("#consulta4-table").length && $("#consulta4-table").DataTable({
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
                        order: [[3, "desc"]]
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
                <table id="consulta4-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Ver Detalle</th>
                            <th>Num. Certificado</th>
                            <th>Reg. Decanatura</th>
                            <th>Fecha Emisión</th>
                            <th>Modalidad</th>
                            <th>Condición</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = 'SELECT ce.id certificado_id, ce.coddec coddec, ce.femision cefemision, cur.nombre curso_nombre, cur.condicion cond_curso,  cur.modalidad_id modalidad FROM certificado ce INNER JOIN cliente c ON ce.cliente_id = c.id INNER JOIN cursos cur ON ce.curso_id = cur.id WHERE c.id ="' . $cliente_id . '" ORDER BY ce.femision DESC';

                        $resultado = $obj->query($query);

                        foreach ($resultado AS $row):
                            ?>
                            <tr>
                                <td class="text-center"><a href="certificado.php?id=<?php echo $row['certificado_id']; ?>" title="Ver" >Ver</a></td>
                                <td><?php echo $row['certificado_id']; ?></td>
                                <td>
                                    <?php
                                    if ($row['coddec']): echo $row['coddec'];
                                    else: echo '<i>En trámite</i>';
                                    endif;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row['cefemision']): echo $row['cefemision'];
                                    else: echo '<i>En trámite</i>';
                                    endif;
                                    ?>
                                </td>
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
