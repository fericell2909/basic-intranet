<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();

    $tabla = 'horario';
    $id = $_POST['id'];
    $id_curso = $_POST['id_curso'];
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
                        <h4 class="modal-title" id="modalHorarioEliminarLabel">Eliminar Horario</h4>
                    </div>
                    <form id="frmEliminarHorario" name="frmEliminarHorario" action="modulos/horario/acciones.php?accion=eliminar" method="POST" class="form-horizontal font-formulario">
                        <div class="modal-body">
                            ¿Está seguro de eliminar el horario <strong><?php echo $registro['horario']; ?></strong> ?
                        </div>
                        <input  type="hidden" id="horario_id" name="horario_id" value="<?php echo $id; ?>">
                        <input type="hidden" id="curso_id" name="curso_id" value="<?php echo $id_curso ?>">
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
