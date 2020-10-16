<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);

    if ($resultado_tusuario[0]['is_admin'] == '1'):
        ?>

        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
                <title>Nuevo Usuario | ADMIN </title>

                <!-- Stylesheets -->
                <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="fonts/css/font-awesome.min.css" rel="stylesheet" />
                <link href="css/animate.min.css" rel="stylesheet" type="text/css"/>
                <link href="css/custom.css" rel="stylesheet" type="text/css"/>
                <link href="css/icheck/flat/green.css" rel="stylesheet" type="text/css"/>

                <!-- END Stylesheets -->

                <!-- JS -->
                <script src="js/jquery.min.js" type="text/javascript"></script>
                <!-- JS -->

            </head>
            <body class="nav-md">

                <div class="container body">
                    <div class="main_container">

                        <!-- Sidebar -->
                        <?php include ('./elements/sidebar.php'); ?>
                        <!-- END Sidebar -->

                        <!-- top navigation -->
                        <?php include ('./elements/header.php'); ?>
                        <!-- END navigation -->

                        <!-- page content -->
                        <div id="contenedor" class="right_col" role="main">
                            <div class="row">
                                <div class="btn-group btn-breadcrumb">
                                    <a href="panel.php" class="btn btn-primary" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Inicio"><i class="glyphicon glyphicon-home"></i></a>
                                    <a href="usuarios.php" class="btn btn-primary">Lista de Usuarios</a>
                                    <a href="#" class="btn btn-primary disabled">Nuevo Usuario</a>
                                </div>
                            </div>
                            <div class="page-title">
                                <div class="title_left">
                                    <h3>Usuarios</h3>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Nuevo Usuario</h2>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <form id="nuevo_usuario" name="nuevo_usuario" action="modulos/usuario/acciones.php?accion=nuevo" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario <span class="required">*</span></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="usuario" name="usuario" type="text"  class="form-control" pattern="[A-Za-z0-9]{4,}"  title="El nombre de usuario debe contener solamente letras y números, y al menos 4 o más caracteres" placeholder="Nombre con el que ingresará al sistema" required autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña <span class="required">*</span></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="contra" name="contra" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="La contraseña debe contener al menos 6 caracteres, incluyendo un número, una mayúscula y una minúscula" placeholder="Contraseña"  required autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Reescriba contraseña <span class="required">*</span></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="contra2" name="contra2" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="La contraseña debe contener al menos 6 caracteres, incluyendo un número, una mayúscula y una minúscula" placeholder="Reescriba contraseña"   autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="nombre" name="nombre" type="text" class="form-control" pattern="[aábcdeéfghijklmnñoópqrstuúüvwxyzAÁBCDEÉFGHIJKLMNÑOÓPQRSTUÚÜVWXYZ ]{3,}" title="Ingrese 3 o más caracteres" placeholder="Nombres"  required autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Rol <span class="required">*</span></label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="rol" value="1" > Administrador
                                                        </label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="rol" value="0" checked> Personal
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                                                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Crear">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal SUCCESS -->
                            <div class="modal fade" id="UsuarioSuccessAddModal" data-backdrop="static" data-keyboard="false" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Usuario creado</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¡El usuario ha sido satisfactoriamente creado!. </p>
                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-success" href="addusuario.php">Crear otro usuario</a>
                                            <a type="button" class="btn btn-primary" href="usuarios.php">Volver a lista de usuarios</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal SUCCESS -->
                            <!-- footer content -->
                            <?php include ('./elements/footer.php'); ?>
                            <!-- END footer content -->
                        </div>
                        <!-- END content -->
                    </div>
                </div>

                <!-- JS -->
                <script src="js/bootstrap.min.js" type="text/javascript"></script>

                <script src="js/progressbar/bootstrap-progressbar.min.js" type="text/javascript"></script>
                <script src="js/nicescroll/jquery.nicescroll.min.js" type="text/javascript"></script>
                <script src="js/icheck/icheck.min.js" type="text/javascript"></script>
                <script src="js/custom.js" type="text/javascript"></script>
                <script src="js/pace/pace.min.js" type="text/javascript"></script>
                <!-- END JS -->


                                                                                <!--<script src="js/bootstrap-show-password.min.js" type="text/javascript"></script>-->
                <script>
                    var waitingDialog = waitingDialog || (function ($) {
                        'use strict';

                        // Creating modal dialog's DOM
                        var $dialog = $(
                                '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
                                '<div class="modal-dialog modal-m">' +
                                '<div class="modal-content">' +
                                '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
                                '<div class="modal-body">' +
                                '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
                                '</div>' +
                                '</div></div></div>');

                        return {
                            /**
                             * Opens our dialog
                             * @param message Custom message
                             * @param options Custom options:
                             * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
                             * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
                             */
                            show: function (message, options) {
                                // Assigning defaults
                                if (typeof options === 'undefined') {
                                    options = {};
                                }
                                if (typeof message === 'undefined') {
                                    message = 'Loading';
                                }
                                var settings = $.extend({
                                    dialogSize: 'm',
                                    progressType: '',
                                    onHide: null // This callback runs after the dialog was hidden
                                }, options);

                                // Configuring dialog
                                $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
                                $dialog.find('.progress-bar').attr('class', 'progress-bar');
                                if (settings.progressType) {
                                    $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
                                }
                                $dialog.find('h3').text(message);
                                // Adding callbacks
                                if (typeof settings.onHide === 'function') {
                                    $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                                        settings.onHide.call($dialog);
                                    });
                                }
                                // Opening dialog
                                $dialog.modal();
                            },
                            /**
                             * Closes dialog
                             */
                            hide: function () {
                                $dialog.modal('hide');
                            }
                        };

                    })(jQuery);

                    $(document).ready(function () {
                        // Muestra un modal cuando el submit es success
                        $('#nuevo_usuario').submit(function (e) {
                            e.preventDefault();

                            $.ajax({
                                url: this.action,
                                type: this.method,
                                data: $(this).serialize(),
                                beforeSend: function () {
                                    waitingDialog.show('Enviando');
                                }
                            })
                                    .done(function () {
                                        // Socilitud ajax finalizada, mostramos el modal de success
                                        $('#UsuarioSuccessAddModal').modal();
                                    })
                                    .always(function () {
                                        waitingDialog.hide();
                                    });
                            //return false;
                        });


                        /* Validación de misma contraseaña */
                        var password = document.getElementById("contra")
                                , confirm_password = document.getElementById("contra2");

                        function validatePassword() {
                            if (password.value != confirm_password.value) {
                                confirm_password.setCustomValidity("Contraseñas no coinciden");
                            } else {
                                confirm_password.setCustomValidity('');
                            }
                        }

                        password.onchange = validatePassword;
                        confirm_password.onkeyup = validatePassword;


                    });




                </script>
            </body>
        </html>

        <?php
    else:
        header('location: 403.php');
    endif;
else:
    header('location: 403.php');
endif;

