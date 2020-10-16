<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();

    $tabla = 'usuario';
    $id = $_POST['id'];
    $tipo_resp = $_POST['tipo'];

    $registro = $obj->registroID($tabla, $id);
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">

            <script>
                //$("#pw_password").password();

                $(document).ready(function () {
                    /* Validación de misma contraseaña */
                    var password = document.getElementById("pw_password");
                    var passbd = "<?php echo $registro['pass']; ?>";

                    function validatePassword() {
                        if (CryptoJS.MD5(password.value) != passbd) {
                            password.setCustomValidity("Contraseña actual errónea");
                        } else {
                            password.setCustomValidity('');
                        }
                    }
                    password.onkeyup = validatePassword;
                });

            </script>
        </head>
        <body>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalRespaldoLabel">Validación </h4>
                    </div>
                    <form id="frmRespaldo" name="frmRespaldo" action="modulos/usuario/acciones.php?accion=respaldo" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <h5>Para hacer un respaldo de la BD deberá proporcionar su contraseña de usuario </h5>
                            <br>
                            <input type="hidden" id="tipo_resp" name="tipo_resp" value="<?php echo $tipo_resp; ?>">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Contraseña<span class="required">*</span></label>
                                <div class="col-xs-9">
                                    <input id="pw_password" name="pw_password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="La contraseña debe contener al menos 6 caracteres, incluyendo un número, una mayúscula y una minúscula" placeholder="Contraseña" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Validar y descargar</button>
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
