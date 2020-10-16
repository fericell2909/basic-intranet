<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();

    $tabla = 'cursos';
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
                        <h4 class="modal-title" id="modalCursoEliminarLabel">Eliminar Curso</h4>
                    </div>
                    <form id="frmEliminarCurso" name="frmEliminarCurso" action="modulos/curso/acciones.php?accion=eliminar" method="POST" class="form-horizontal font-formulario">
                        <div class="modal-body">
                            ¿Está seguro de eliminar el Curso <strong><?php echo $registro['nombre']; ?></strong>, <?php
                            if ($registro['modalidad_id'] == 'p') {
                                echo 'presencial';
                            } else {
                                echo 'virtual';
                            }
                            ?> -
                            <?php
                            if ($registro['condicion'] == 'pgen') {
                                echo 'Pub. General';
                            } elseif ($registro['condicion'] == 'tuns') {
                                echo 'Trabajador UNS';
                            } elseif ($registro['condicion'] == 'auns') {
                                echo 'Alumno UNS';
                            }
                            ?> ?
                        </div>
                        <input  type="hidden" id="curso_id" name="curso_id" value="<?php echo $id; ?>">
                        <div class="modal-footer">
                            <button type="submit" id="eliminar-curso" class="btn btn-primary" >Aceptar</button>
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
