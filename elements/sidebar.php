<?php
if (isset($_SESSION['id'])):
    ?>
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <img src="images/logocecomp.png" class="site_title">
            </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
                <div class="profile_pic">
                    <img src="images/user.png" alt="" class="img-circle profile_img"/>
                </div>
                <div class="profile_info">
                    <span>Bienvenido,</span>
                    <h2><?php echo $_SESSION['nombre']; ?></h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->
            <br>

            <!-- ADMIN sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">
                        <li><a href="panel.php"><i class="fa fa-home"></i> Inicio </a>
                        </li>

                        <li><a><i class="fa fa-edit"></i> Gestionar <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="fichas.php">Fichas</a></li>
                                <li><a href="cursos.php">Cursos</a></li>
                                <li><a href="clientes.php">Clientes</a></li>
                                <li><a href="certificados.php">Certificados</a></li>
                                <?php
                                if ($resultado_tusuario[0]['is_admin'] == '1'):
                                    ?>
                                    <li><a href="usuarios.php">Usuarios</a></li>
                                <?php endif; ?>
                                <li><a href="docentes.php">Docentes</a></li>
                            </ul>
                        </li>


                        <li><a><i class="fa fa-search"></i><span class="fa fa-chevron-down"></span> Consultas</a>
                            <ul class="nav child_menu">
                                <li><a href="cstficha.php">Ficha</a></li>
                                <li><a href="cstcurso.php">Curso</a></li>
                                <li><a href="cstcliente.php">Cliente</a></li>
                                <li><a href="cstcertificado.php">Certificado</a></li>
                            </ul>
                        </li>


                        <li><a><i class="fa fa-bar-chart-o"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="rfichas.php">Fichas</a></li>
                                <li><a href="rcursos.php">Cursos</a></li>
                                <li><a href="rclientes.php">Clientes</a></li>
                            </ul>
                        </li>

                        <?php if ($resultado_tusuario[0]['is_admin'] == '1'): ?>
                            <li><a href="bitacora.php"><i class="fa fa-tasks"></i> Bitácora </a>
                            </li>
                        <?php endif; ?>
                        <li><a href="papelera.php"><i class="fa fa-trash-o"></i> Papelera de Reciclaje </a>
                        </li>
                        <?php if ($resultado_tusuario[0]['is_admin'] == '1'): ?>
                            <li><a href="respaldo.php"><i class="fa fa-database"></i> Respaldo </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>

                <div class="menu_section">
                    <h3>Configuración</h3>
                    <ul class="nav side-menu">
                        <li><a href="#UsuarioConfigModal" data-toggle="modal" onclick="ConfigUsuario('<?php echo $_SESSION['id']; ?>')" ><i class="fa fa-user"></i> Cuenta </a></li>
                    </ul>
                </div>

            </div>
            <!-- END ADMIN sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
                <a href="#UsuarioConfigModal" data-toggle="modal" onclick="ConfigUsuario('<?php echo $_SESSION['id']; ?>')" >
                    <span class="glyphicon glyphicon-cog" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Configuración"></span>
                </a>

                <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="modulos/usuario/acciones.php?accion=cerrar">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
            </div>
            <!-- /menu footer buttons -->
        </div>
    </div>

    <!-- Config Usuario Modal -->
    <div class="modal fade" id="UsuarioConfigModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalUsuarioConfigLabel">
    </div>
    <!-- END Config Usuario Modal -->

    <script src="js/crypto-js/md5.js" type="text/javascript"></script>

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