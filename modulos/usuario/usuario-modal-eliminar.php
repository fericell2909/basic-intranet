<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();

    $tabla = 'usuario';
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
                        <h4 class="modal-title" id="modalUsuarioEliminarLabel">Eliminar Usuario</h4>
                    </div>
                    <form id="frmEliminarUsuario" name="frmEliminarUsuario" action="modulos/usuario/acciones.php?accion=eliminar" method="POST" class="form-horizontal font-formulario">
                        <div class="modal-body">							
                            ¿Está seguro de eliminar al usuario <strong><?php echo $registro['user']; ?></strong> ?
                        </div>
                        <input  type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $id; ?>">
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
