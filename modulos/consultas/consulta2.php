<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();
    $curso_id = $_GET['idCurso'];
    $fdesde = $_GET['fdesde'];
    $fhasta = $_GET['fhasta'];

    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <script>
                var handleDataTableButtons = function () {
                    "use strict";
                    0 !== $("#consulta2-table").length && $("#consulta2-table").DataTable({
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
                <table id="consulta2-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Num. Ficha</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Código Cliente</th>
                            <th class="text-center">Apellidos</th>
                            <th class="text-center">Nombres</th>
                            <th class="text-center">Telf. Celular</th>
                            <th class="text-center">Ver Ficha</th>
                            <th class="text-center">Ver Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT f.curso_id curso_id , f.id num_ficha, f.created fecha,c.id cliente_id, c.apellidos apellidos, c.nombres nombres, c.email email, c.tfijo tfijo, c.tcelular tcelular
                                    FROM ficha f INNER JOIN cliente c ON c.id = f.cliente_id
                                    WHERE f.curso_id = ".$curso_id." AND f.estado = '1' AND  DATE(f.created ) BETWEEN '".$fdesde."' AND '".$fhasta."'";
                        $resultado = $obj->query($query);

                        foreach ($resultado AS $row):
                            ?>
                            <tr>
                                <td><?php echo $row['num_ficha']; ?></td>
                                <td><?php echo $row['fecha']; ?></td>
                                <td><?php echo $row['cliente_id']; ?></td>
                                <td><?php echo $row['apellidos']; ?></td>
                                <td><?php echo $row['nombres']; ?></td>
                                <td><?php echo $row['tcelular']; ?></td>
                                <td class="text-center"><a href="ficha.php?id=<?php echo $row['num_ficha']; ?>" title="Ver Ficha" target="_blank" >Ver Ficha</a></td>
                                <td class="text-center"><a href="cliente.php?id=<?php echo $row['cliente_id']; ?>" title="Ver Cliente" target="_blank" >Ver Cliente</a></td>
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
