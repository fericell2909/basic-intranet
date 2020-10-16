<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ingreso al Sistema</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />

        <!-- Stylesheets -->

        <link href="css/login/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/login/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="css/login/main.css" rel="stylesheet" type="text/css"/>
        <!-- END Stylesheets -->
    </head>
    <body>
        <!-- Login Full Background -->
        <img src="images/fondo-login.jpg" alt="Sistema de fichas" class="full-bg animation-pulseSlow">
        <!-- END Login Full Background -->

        <!-- Login Container -->
        <div id="login-container" class="animation-fadeIn">
            <!-- Login Title -->
            <div class="login-title text-center">
                <h1><strong>CECOMP</strong><br><small>Sistema de Fichas</small></h1>
            </div>
            <!-- END Login Title -->

            <!-- Login Block -->
            <div class="block push-bit">
                <!-- Login Form -->
                <form action="modulos/usuario/acciones.php?accion=verificar" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">

                    <div class="alert alert-danger alert-dismissable" style="display: <?php
                    if (isset($_GET['error'])): echo 'block';
                    else: echo 'none';
                    endif;
                    ?>">

                        <h4><i class="fa fa-times-circle"></i> Error</h4> USUARIO Y/O CANTRASEÑA INCORRECTO(S)
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" id="login-user" name="user" class="form-control input-lg" placeholder="Usuario" required autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                <input type="password" id="login-password" name="pass" class="form-control input-lg" placeholder="Contraseña" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-8 text-right">
                            <button type="submit" class="btn btn-primary btn-lg active"> ACCEDER</button>
                        </div>
                    </div>
                </form>
                <!-- END Login Form -->
            </div>
            <!-- END Login Block -->
        </div>
        <!-- END Login Container -->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/login/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <script src="js/login/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/login/plugins.js" type="text/javascript"></script>
        <script src="js/login/app.js" type="text/javascript"></script>

        <!-- END Bootstrap.js, Jquery plugins and Custom JS code -->
    </body>
</html>