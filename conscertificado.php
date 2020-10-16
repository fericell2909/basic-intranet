<?php
require_once 'config/db.php';
$obj = new DB();
?>

<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Consulta de Certificado</title>

        <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
        <!-- Stylesheets -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="fonts/css/font-awesome.min.css" rel="stylesheet" />
        <link href="css/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/formficha.css" rel="stylesheet" type="text/css"/>

        <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- END Stylesheets -->

        <!-- JS -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- END JS -->

        <script>
            function cargarCertificado() {
                var codigo = $('#codigo').val();
                if (codigo == "") {
                    $('#consulta5-container').html('<div id="CodigoError" class="alert alert-danger alert-dismissible fade in" role="alert">Ingrese su DNI</div>');

                } else {
                    var parametros = {codigoCliente: codigo};
                    $.ajax({
                        data: parametros,
                        url: 'modulos/cliente/acciones.php?accion=buscarCodigo',
                        type: 'post',
                        success: function (msg) {
                            if (msg == 0) {
                                $('#consulta5-container').html('<div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">No ha llevado ningún curso en CECOMP</div>');

                            } else {
                                $('#consulta5-container').load('modulos/consultas/consulta5.php?idCliente=' + codigo);
                            }
                        }
                    });
                }
            }
        </script>
    </head>
    <body>
        <!-- MENU -->
        <header>
            <div class="container">
                <nav class="navbar navbar-inverse navbar-fixed-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
                                <span class="sr-only">menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="#" class="navbar-brand">CECOMP</a>
                        </div>

                        <div class="collapse navbar-collapse navbar-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="http://centrocomputouns.edu.pe/"><span class="glyphicon glyphicon-home"></span> INICIO</a></li>

                                <li class="active"><a href="conscertificado.php" ><span class="glyphicon glyphicon-search"></span> Consulta Certificados</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- END MENU-->

        <!-- Form Block-->
        <div class="container fondo-blanco">
            <div class="page-header text-center">
                <h1>Consulta de Certificado</h1>

            </div>
            <div class="font-formulario">

                <div class="input-group col-lg-4 col-lg-offset-4">
                    <input id="codigo" name="codigo" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8" pattern=".{8,8}" title="El DNI debe contener 8 caracteres" class="form-control"  placeholder="Ingrese su DNI" required autocomplete="off">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="button" onclick="cargarCertificado()">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>

                <br><br>
                <div id="consulta5-container"></div>
            </div>




        </div>
        <!--END Form Block-->

        <!-- Footer -->
        <footer style="position:relative;margin-top:30rem">
            <div class="container">
                <p class="pfooter">
                    <span class="glyphicon glyphicon-earphone"></span> Telefono : (043) 31-0445 Anexo: 1018<br>
                    <span class="glyphicon glyphicon-envelope"></span> Correo : cecomp@uns.edu.pe<br>
                    <span class="glyphicon glyphicon-envelope"></span> Correo : centro_computo_uns@hotmail.com<br>
                    <span class="glyphicon glyphicon-map-marker"></span> Urb. Bellamar, Av. Universitaria S/N- Pabellón de la E.A.P.I.S.I.<br>
                </p>
            </div>
        </footer>
        <!-- END Footer -->

        <!-- JS -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/select2/select2.min.js" type="text/javascript"></script>
        <script src="js/select2/i18n/es.js" type="text/javascript"></script>
        <script src="js/progressbar/bootstrap-progressbar.min.js" type="text/javascript"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js" type="text/javascript"></script>



        <!-- Datatables-->
        <script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables/dataTables.bootstrap.js"></script>
        <script src="js/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datatables/buttons.bootstrap.min.js"></script>
        <script src="js/datatables/jszip.min.js"></script>
        <script src="js/datatables/pdfmake.min.js"></script>
        <script src="js/datatables/vfs_fonts.js"></script>
        <script src="js/datatables/buttons.html5.min.js"></script>
        <script src="js/datatables/buttons.print.min.js"></script>
        <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="js/datatables/dataTables.keyTable.min.js"></script>
        <script src="js/datatables/dataTables.responsive.min.js"></script>
        <script src="js/datatables/responsive.bootstrap.min.js"></script>
        <script src="js/datatables/dataTables.scroller.min.js"></script>
        <!-- End Datatables -->

        <script src="js/pace/pace.min.js" type="text/javascript"></script>
        <script src="js/conscertificado.js" type="text/javascript"></script>
        <!-- END JS -->



    </body>
</html>


