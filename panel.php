<?php
session_start();
if (isset($_SESSION['id'])):
    require_once 'config/db.php';
    $obj = new DB();
    $id_usuario = $_SESSION['id'];
    $query_tusuario = "SELECT is_admin FROM usuario WHERE id='$id_usuario'";
    $resultado_tusuario = $obj->query($query_tusuario);
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="images/logocecomp64.png" type="image/x-icon" rel="shortcut icon" />
            <title>Panel | <?php
                if ($resultado_tusuario[0]['is_admin'] == '1'): echo 'ADMIN';
                else: echo 'TRABAJADOR';
                endif;
                ?> </title>

            <!-- Stylesheets -->
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="fonts/css/font-awesome.min.css" rel="stylesheet" />
            <link href="css/animate.min.css" rel="stylesheet" type="text/css"/>
            <link href="css/custom.css" rel="stylesheet" type="text/css"/>
            <link href="css/icheck/flat/green.css" rel="stylesheet" type="text/css"/>
            <link href="css/widget.css" rel="stylesheet" type="text/css"/>

            <!-- END Stylesheets -->

            <!-- JS -->
            <script src="js/jquery.min.js" type="text/javascript"></script>
            <!-- END JS -->

        </head>
        <body class="nav-md">

            <div class="container body">
                <div class="main_container">

                    <!-- Sidebar -->
                    <?php include ('./elements/sidebar.php'); ?>
                    <!-- END Sidebar -->

                    <!-- Top navigation -->
                    <?php include ('./elements/header.php'); ?>
                    <!-- END Top navigation -->

                    <!-- Page content -->
                    <div id="contenedor" class="right_col" role="main">
                        <!-- Indicadores TOP -->
                        <div class="row top_tiles">
                            <div class="animated flipInY col-md-4 col-sm-4 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-eye"></i>
                                    </div>
                                    <?php
                                    $query = "SELECT count(*) cur_visibles from cursos WHERE visible = '1'";
                                    $resultado = $obj->query($query);
                                    foreach ($resultado as $row):
                                        ?>
                                        <div class="count"><?php echo $row['cur_visibles']; ?></div>

                                        <?php
                                        if ($row['cur_visibles'] == 1):
                                            echo '<h3>Curso Visible</h3>';
                                        else:
                                            echo '<h3>Cursos Visibles</h3>';
                                        endif;
                                    endforeach;
                                    ?>
                                    <p>Para el llenado de Fichas</p>
                                </div>
                            </div>


                            <div class="animated flipInY col-md-4 col-sm-4 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-list-alt"></i>
                                    </div>
                                    <?php
                                    $query = "select count(*) fichas_hoy from ficha f where f.created >= curdate() AND  f.estado = '1'";
                                    $resultado = $obj->query($query);
                                    foreach ($resultado as $row):
                                        ?>
                                        <div class="count"><?php echo $row['fichas_hoy']; ?></div>
                                        <?php
                                        if ($row['fichas_hoy'] == 1):
                                            echo '<h3>Ficha Hoy</h3>';
                                        else:
                                            echo '<h3>Fichas Hoy</h3>';
                                        endif;
                                        ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <p>&nbsp;</p>
                                </div>
                            </div>

                            <div class="animated flipInY col-md-4 col-sm-4 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-list-alt"></i>
                                    </div>
                                    <?php
                                    $query = "SELECT COUNT(*) fichas_mes FROM ficha f WHERE  YEAR(f.created) = YEAR(CURDATE()) AND MONTH(f.created) = MONTH(CURDATE())  AND  f.estado = '1'";
                                    $resultado = $obj->query($query);
                                    foreach ($resultado as $row):
                                        ?>
                                        <div class="count"><?php echo $row['fichas_mes']; ?></div>
                                        <?php
                                        if ($row['fichas_mes'] == 1):
                                            echo '<h3>Ficha este mes</h3>';
                                        else:
                                            echo '<h3>Fichas este mes</h3>';
                                        endif;
                                        ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <!-- END Indicadores TOP -->


                        <div class="page-title">
                            <div class="title_left">
                                <h3>Gestionar</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row top_tiles">
                            <div class="animated bounce col-md-4 col-sm-6 col-xs-12">
                                <a href="fichas.php" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Gestionar <strong>Fichas</strong><br>
                                        </h3>
                                    </div>
                                </a>
                            </div>

                            <div class="animated bounce col-md-4 col-sm-6 col-xs-12">
                                <a href="cursos.php" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-modern animation-fadeIn">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Gestionar <strong>Cursos</strong><br>
                                        </h3>
                                    </div>
                                </a>
                            </div>

                            <div class="animated bounce col-md-4 col-sm-6 col-xs-12">
                                <a href="clientes.php" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Gestionar <strong>Clientes</strong><br>
                                        </h3>
                                    </div>
                                </a>
                            </div>

                            <div class="animated bounce col-md-4 col-sm-6 col-xs-12">
                                <a href="certificados.php" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-fancy animation-fadeIn">
                                            <i class="fa fa-file-text-o"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Gestionar <strong>Certificados</strong><br>
                                        </h3>
                                    </div>
                                </a>
                            </div>


                            <?php
                            if ($resultado_tusuario[0]['is_admin'] == '1'):
                                ?>
                                <div class="animated bounce col-md-6 col-sm-6 col-xs-12">
                                    <a href="usuarios.php" class="widget widget-hover-effect1">
                                        <div class="widget-simple">
                                            <div class="widget-icon pull-left themed-background-dark-modern animation-fadeIn">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <h3 class="widget-content text-right animation-pullDown">
                                                Gestionar <strong>Usuarios</strong><br>
                                            </h3>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            endif;
                            ?>

                        </div>

                        <div class="page-title">
                            <div class="title_left">
                                <h3>Consultar</h3>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row top_tiles">
                            <div class="animated bounce col-md-4 col-sm-6 col-xs-12">
                                <a href="cstficha.php" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Consultar <strong>Fichas</strong><br>
                                        </h3>
                                    </div>
                                </a>
                            </div>

                            <div class="animated bounce col-md-4 col-sm-6 col-xs-12">
                                <a href="cstcurso.php" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-modern animation-fadeIn">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Consultar <strong>Cursos</strong><br>
                                        </h3>
                                    </div>
                                </a>
                            </div>

                            <div class="animated bounce col-md-4 col-sm-6 col-xs-12">
                                <a href="cstcliente.php" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Consultar <strong>Clientes</strong><br>
                                        </h3>
                                    </div>
                                </a>
                            </div>

                            <div class="animated bounce col-md-4 col-sm-6 col-xs-12">
                                <a href="cstcertificado.php" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-fancy animation-fadeIn">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Consultar <strong>Certificados</strong><br>
                                        </h3>
                                    </div>
                                </a>
                            </div>

                        </div>



                        <!-- Footer content -->
                        <?php include ('./elements/footer.php'); ?>
                        <!-- END Footer content -->
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


        </body>
    </html>

    <?php
else:
    header('location: 403.php');
endif;

