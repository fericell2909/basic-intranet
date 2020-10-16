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
                        <h4 class="modal-title" id="modalHorarioEditarLabel">Editar Horario <b> <?php echo $registro['horario']; ?> </b></h4>
                    </div>
                    <form id="frmModificarHorario" name="frmModificarHorario" action="modulos/horario/acciones.php?accion=editar" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" id="horario_id" name="horario_id" value="<?php echo $registro['id']; ?>">
                            <input type="hidden" id="curso_id" name="curso_id" value="<?php echo $id_curso ?>">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Horario<span class="required">*</span></label>
                                <div class="col-xs-9">
                                    <input id="horario" name="horario" type="text"  class="form-control"  placeholder="Especifique el horario" required autocomplete="off" value="<?php echo $registro['horario']; ?>">
                                </div>
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
