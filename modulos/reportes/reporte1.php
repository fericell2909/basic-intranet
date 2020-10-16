<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();
    $fanio = $_GET['fanio'];

    /*
     * Numero de fichas creadas en un determinado año, agrupadas por mes
     */
    $query_rf1 = "SELECT MONTHNAME(created) AS mes, COUNT( * ) fichas
                    FROM ficha
                    WHERE YEAR(created) = " . $fanio . " AND estado = '1'
                    GROUP BY MONTH(created)";
    $resultado_rf1 = $obj->query($query_rf1);


    /*
     * Numero de fichas creadas en un determinado año, agrupadas por condicion del curso
     */
    $query_rf2 = "SELECT c.condicion AS condicion, COUNT(*) AS cantidad
                    FROM ficha f, cursos c
                    WHERE f.curso_id = c.id AND YEAR(created) = " . $fanio . " AND estado = '1'
                    GROUP BY c.condicion";
    $resultado_rf2 = $obj->query($query_rf2);

    $data_rf2 = array();
    foreach ($resultado_rf2 as $row):
        if ($row['condicion'] == 'tuns') {
            $data_rf2[] = array(
                "condicion" => "Trabajador",
                "cantidad" => $row['cantidad']
            );
        } elseif ($row['condicion'] == 'auns') {
            $data_rf2[] = array(
                "condicion" => "Alum./Ex-Alum.",
                "cantidad" => $row['cantidad']
            );
        } elseif ($row['condicion'] == 'pgen') {
            $data_rf2[] = array(
                "condicion" => "Pub. general",
                "cantidad" => $row['cantidad']
            );
        }
    endforeach;
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
            <script>

            </script>
        </head>
        <body>
            <div>
                <div class="x_title">
                    <h2>Fichas registradas en el <b><?php echo $fanio; ?></b></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    if (count($resultado_rf1) == 0) :
                        ?>
                        <div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">¡No se han registrado fichas en el año solicitado!</div>
                        <?php
                    else:
                        ?>
                        <div id="rf1-container" style="width:100%; height:300px;">
                        </div>
                    <?php
                    endif;
                    ?>

                </div>
                <div class="ln_solid"></div>
                <div class="x_title">
                    <h2>Fichas por condicion en el <b><?php echo $fanio; ?></b></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    if (count($resultado_rf1) == 0) :
                        ?>
                        <div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">¡No se han registrado fichas en el año solicitado!</div>
                        <?php
                    else:
                        ?>
                        <div id="rf2-container" style="width:100%; height:300px;">
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="clear"></div>


            <script>
    <?php
    if (count($resultado_rf1) != 0) :
        ?>
                    Morris.Line({
                        element: 'rf1-container',
                        data: <?php echo json_encode($resultado_rf1); ?>,
                        xkey: 'mes',
                        ykeys: ['fichas'],
                        labels: ['Fichas'],
                        hideHover: 'auto',
                        parseTime: false,
                        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                        gridIntegers: true,
                        ymin: 0,
                        resize: true
                    });


                    Morris.Bar({
                        element: 'rf2-container',
                        data: <?php echo json_encode($data_rf2); ?>,
                        xkey: 'condicion',
                        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                        ykeys: ['cantidad'],
                        labels: ['Fichas'],
                        hideHover: 'auto',
                        gridIntegers: true,
                        ymin: 0,
                        resize: true
                    });
        <?php
    endif;
    ?>
            </script>
        </body>


    </html>
    <?php
else:
    header('location:../../403.php');
endif;
