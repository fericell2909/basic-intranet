<?php
require_once '../../config/db.php';
$obj = new DB();
$cliente_id = $_GET['idCliente'];

$registro = $obj->registroID('cliente', $cliente_id);

$query = 'SELECT ce.id certificado_id, ce.coddec coddec, ce.femision cefemision, ce.nota_final nota_final, ce.cemes cemes, ce.ceanio ceanio, cur.nombre curso_nombre FROM certificado ce INNER JOIN cliente c ON ce.cliente_id = c.id INNER JOIN cursos cur ON ce.curso_id = cur.id WHERE c.id ="' . $cliente_id . '"';
$resultado = $obj->query($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <script>
            var handleDataTableButtons = function () {
                "use strict";
                0 !== $("#consulta5-table").length && $("#consulta5-table").DataTable({
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
                    order: [[0, "desc"]]
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

            <h3 style="text-decoration: underline;"> Certificados de <strong><?php echo $registro['apellidos'] . ' ' . $registro['nombres']; ?></strong></h3>
            <?php
            if (count($obj->query($query)) == 0):
                ?>
                <div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">No hay certificados a su nombre.</div>
                <?php
            else:
                ?>
                <p> Usted ha <span style="font-weight: bold;">APROBADO</span> los siguientes cursos:  </p>
                <ul>
                    <?php
                    foreach ($resultado AS $row):
                        ?>
                        <li><?php echo $row['curso_nombre']; ?></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
                <br>
                <div class="ln_solid"></div>
                <h4 style="text-decoration: underline;"> Detalle de certificados:</h4>
                <br>
                <table id="consulta5-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Num. Certificado</th>
                            <th>Reg. Decanatura</th>
                            <th>Fecha Emisión</th>
                            <th>Mes</th>
                            <th>Año</th>
                            <th>Curso</th>
                            <th>Nota Final</th>
                            <th>Ver QR</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado AS $row):
                            ?>
                            <tr>
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
                                <td><?php echo $row['cemes']; ?></td>
                                <td><?php echo $row['ceanio']; ?></td>
                                <td><?php echo $row['curso_nombre']; ?></td>
                                <td><?php echo $row['nota_final']; ?></td>
                                <td><a  type="button" href="#QRModal" data-toggle="modal" onclick="VerQR('<?php echo $row['certificado_id']; ?>')" title="Ver" class="btn btn-xs btn-info"><i class="fa fa-qrcode"></i></a></td>

                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>

                <!-- Modal QR -->
                <div class="modal fade" id="QRModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="qr-title" class="modal-title"></h4>
                            </div>
                            <div class="modal-body" id="contenidoQRModal">
                                <h4 style='text-align:center'>Codigo QR Generado: </h4>
                                <center>
                                    <div id='qr-div' class='qrframe' style='border:2px solid black; width:210px; height:210px;'>
                                    </div>
                                </center>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Modal QR -->
            <?php
            endif;
            ?>
        </div>
        <div class="clear"></div>
        <script type="text/javascript">
            function VerQR(id) {
                $('#qr-title').html("Codigo QR <span style='font-weight: bold;'>"+id+"</span>");
                $('#qr-div').html("<img src='media/crt/"+id+".png' style = 'width:200px; height:200px;' >");
            }
        </script>
    </body>
</html>

