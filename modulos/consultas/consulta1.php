<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();
    $ficha_codigo = $_GET['codigoFicha'];
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <script>
                var handleDataTableButtons = function () {
                    "use strict";
                    0 !== $("#consulta1-table").length && $("#consulta1-table").DataTable({
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
                        }
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
                <table id="consulta1-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = 'SELECT f.id ficha_id, f.created fecha, cur.nombre curso_nombre, cur.condicion cond_curso,  cur.modalidad_id modalidad, c.apellidos apellidos, c.nombres nombres, c.id cliente_id, c.condicion cond_cliente FROM ficha f INNER JOIN cliente c ON f.cliente_id = c.id INNER JOIN cursos cur ON f.curso_id = cur.id  WHERE f.estado = "1" AND f.id ="'.$ficha_codigo.'"  ORDER BY f.created DESC';
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
