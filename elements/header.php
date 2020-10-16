<?php
if (isset($_SESSION['id'])):
    ?>
    <div class="top_nav">
        <div class="nav_menu">
            <nav class="" role="navigation">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>




                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="images/user.png" alt=""><?php echo $_SESSION['nombre']; ?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                            <li>
                                <a href="#UsuarioConfigModal" data-toggle="modal" onclick="ConfigUsuario('<?php echo $_SESSION['id']; ?>')">
                                    <span>Configuración</span>
                                </a>
                            </li>

                            <li>
                                <a href="modulos/usuario/acciones.php?accion=cerrar">
                                    <i class="fa fa-sign-out pull-right"></i> Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="formulario.php" class="btn btn-default" role="button" target="_blank">
                            <span>Abrir formulario público </span>
                        </a>
                    </li>


                </ul>
            </nav>
        </div>
    </div>


    <!-- Config Usuario Modal -->
    <div class="modal fade" id="UsuarioConfigModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalUsuarioConfigLabel">
    </div>
    <!-- END Config Usuario Modal -->
    

    <script type="text/javascript">
        function ConfigUsuario(id) {
                $.post("modulos/usuario/usuario-modal-config.php", {id: id}, function (data) {
                    $('#UsuarioConfigModal').html(data);
                });
            }
    </script>
    <?php
else:
    header('location: ../403.php');
endif;