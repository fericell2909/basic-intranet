<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();

    $tabla = 'horario';
    $id_curso = $_POST['id_curso'];
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <!--
            <link href="css/select2/select2.min.css" rel="stylesheet" type="text/css"/>
            <script src="js/select2/select2.min.js" type="text/javascript"></script>
            <script src="js/select2/i18n/es.js" type="text/javascript"></script>
            <script src="js/curso.js" type="text/javascript"></script>
-->
            <script>
                $(".select-horario").select2({
                    language: "es",
                    placeholder: "Especifique el horario",
                    allowClear: true,
                    tags: true,
                    width: 'resolve'
                });
            </script>

        </head>
        <body>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalHorarioNuevoLabel">Nuevo Horario</h4>
                    </div>
                    <form id="frmNuevoHorario" name="frmNuevoHorario" action="modulos/horario/acciones.php?accion=nuevo" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" id="curso_id" name="curso_id" value="<?php echo $id_curso ?>">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Horario<span class="required">*</span></label>
                                <div class="col-xs-9">
                                    <select id="horario" name="horario" class="form-control select-horario" style="width: 100%">
                                        <option></option>
                                        <?php
                                        include ('../../elements/arrayHorarios.php');

                                        for ($i = 0; $i < sizeof($horarios_comunes); $i++) {
                                            ?>
                                            <option value="<?php echo $horarios_comunes[$i]; ?>"><?php echo $horarios_comunes[$i]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <p class="text-muted"><i>** Si el horario no esta en la lista, escriba el horario y presione la tecla <kbd>Enter</kbd></i></p>
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
