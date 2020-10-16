<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();

    $tabla = 'voucher';
    $id = $_POST['id'];
    $id_ficha = $_POST['id_ficha'];
    $registro = $obj->registroID($tabla, $id);
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
        </head>
        <body>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalVoucherEliminarLabel">Eliminar Voucher</h4>
                    </div>
                    <form id="frmEliminarVoucher" name="frmEliminarVoucher" action="modulos/voucher/acciones.php?accion=eliminar" method="POST" class="form-horizontal font-formulario">
                        <div class="modal-body">
                            ¿Está seguro de eliminar el voucher <strong><?php echo $registro['codigo'] . ' - ' . $registro['fecha']; ?></strong> ?
                        </div>
                        <input type="hidden" id="voucher_id" name="voucher_id" value="<?php echo $registro['id']; ?>">
                        <input type="hidden" id="ficha_id" name="ficha_id" value="<?php echo $id_ficha ?>">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Aceptar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </body>
    </html>
    <?php
else:
    header('location: 403.php');
endif;
