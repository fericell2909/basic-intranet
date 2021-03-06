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
                        <h4 class="modal-title" id="modalVoucherEditarLabel">Editar Voucher <b> <?php echo $registro['codigo'].' - '.$registro['fecha']; ?> </b></h4>
                    </div>
                    <form id="frmModificarVoucher" name="frmModificarVoucher" action="modulos/voucher/acciones.php?accion=editar" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" id="voucher_id" name="voucher_id" value="<?php echo $registro['id']; ?>">
                            <input type="hidden" id="ficha_id" name="ficha_id" value="<?php echo $id_ficha ?>">
                        
                            <div class="form-group">
                                <label class="control-label col-xs-3">Código de Voucher </label>
                                <div class="col-xs-9 " >
                                    <input id="cod_voucher" name="cod_voucher" type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="7" pattern=".{7,7}" title="El código de voucher debe contener 7 caracteres" placeholder="Código de voucher" required autocomplete="off" value="<?php echo $registro['codigo']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Fecha </label>
                                <div class="col-xs-9" >
                                    <input id="fecha_voucher" name="fecha_voucher" type="text" class="form-control"  maxlength="9"  pattern="([0-9]{2,2})+([A-Z]{3,3})+([0-9]{4,4})$" title="La fecha debe tener el formato establecido" placeholder="Fecha de voucher" required autocomplete="off" value="<?php echo $registro['fecha']; ?>" >
                                </div>
                                <p class="text-muted"><i>** La fecha tiene que tener el sgte. formato día-mes-año(Ejm: 12SET2016)</i></p>
                            </div>
                        </div>
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
