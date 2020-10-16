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

            <script>


                $(document).ready(function () {
                    $('#password-container').hide();

                    $('input:radio[name=rbpassword]').change(function () {
                        if (this.value == 'no') {
                            $('#password-container').hide();
                            $("#pw_nueva").removeAttr('required');
                            $("#pw_nueva2").removeAttr('required');


                        } else if (this.value == 'si') {
                            $('#password-container').show();
                            $("#pw_nueva").attr('required', true);
                            $("#pw_nueva2").attr('required', true);


                            /* Validación de misma contraseaña */
                            var password = document.getElementById("pw_nueva")
                                    , confirm_password = document.getElementById("pw_nueva2");

                            function validatePassword() {
                                if (password.value != confirm_password.value) {
                                    confirm_password.setCustomValidity("Contraseñas no coinciden");
                                } else {
                                    confirm_password.setCustomValidity('');
                                }
                            }

                            password.onchange = validatePassword;
                            confirm_password.onkeyup = validatePassword;
                        }
                    });
                });

            </script>
        </head>
        <body>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalUsuarioEditarLabel">Editar Usuario <b> <?php echo $registro['user']; ?> </b></h4>
                    </div>
                    <form id="frmModificarUsuario" name="frmModificarUsuario" action="modulos/usuario/acciones.php?accion=editar" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $registro['id']; ?>">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12-3">Usuario</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="usuario" name="usuario" type="text" disabled class="form-control" value="<?php echo $registro['user']; ?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="nombre" name="nombre" type="text" class="form-control" pattern="[aábcdeéfghijklmnñoópqrstuúüvwxyzAÁBCDEÉFGHIJKLMNÑOÓPQRSTUÚÜVWXYZ ]{3,}" title="Ingrese 3 o más caracteres" placeholder="Nombres" value="<?php echo $registro['name']; ?>" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Rol<span class="required">*</span></label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" name="rol" value="1" <?php
                                        if ($registro['is_admin'] == '1'): echo 'checked';
                                        endif;
                                        if ($_SESSION['id'] == $registro['id']): echo ' disabled';
                                        endif;
                                        ?>> Administrador
                                    </label>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" name="rol" value="0" <?php
                                        if ($registro['is_admin'] == '0'): echo 'checked';
                                        endif;
                                        if ($_SESSION['id'] == $registro['id']): echo ' disabled';
                                        endif;
                                        ?>> Trabajador
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3">Cambiar contraseña</label>
                                <div class="col-xs-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="rbpassword" id="password_si" value="no" checked required> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="rbpassword" id="password_no"  value="si"> Si
                                    </label>
                                </div>
                            </div>

                            <div id="password-container" class="row col-xs-12" >
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nueva contraseña<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="pw_nueva" name="pw_nueva" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="La contraseña debe contener al menos 6 caracteres, incluyendo un número, una mayúscula y una minúscula" placeholder="Nueva contraseña"   >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Reescriba nueva contraseña<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="pw_nueva2" name="pw_nueva2" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="La contraseña debe contener al menos 6 caracteres, incluyendo un número, una mayúscula y una minúscula" placeholder="Reescriba nueva contraseña"   >
                                    </div>
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
