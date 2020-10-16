<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();

    $tabla = 'certificado';
    $id = $_POST['id'];
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
                        <h4 class="modal-title" id="modalCertificadoEliminarLabel">Eliminar Certificado</h4>
                    </div>
                    <form id="frmEliminarCertificado" name="frmEliminarCertificado" action="modulos/certificado/acciones.php?accion=eliminar" method="POST" class="form-horizontal font-formulario">
                        <div class="modal-body">
                            ¿Está seguro de eliminar el Certificado <strong><?php echo $registro['id']; ?></strong> <?php if($registro['coddec']):echo ', con código de decanatura '.$registro['coddec'];endif;?>  ?
                        </div>
                        <input  type="hidden" id="certificado_id" name="certificado_id" value="<?php echo $id; ?>">
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
