<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();
    $fdesde = $_GET['fdesde'];
    $fhasta = $_GET['fhasta'];

    /*
     * Los 5 clientes más concurrentes entre 2 fechas
     */
    $query_rcl1 = "SELECT f.cliente_id codigo, c.apellidos AS apellidos, CONCAT(c.apellidos, ' ', c.nombres) AS fullnombre, COUNT(*) AS cantidad
                    FROM ficha f, cliente c
                    WHERE f.cliente_id = c.id AND DATE(f.created ) BETWEEN '" . $fdesde . "' AND '" . $fhasta . "' AND f.estado = '1'
                    GROUP BY f.cliente_id
                    ORDER BY COUNT(*) DESC
                    LIMIT 5";

    $resultado_rcl1 = $obj->query($query_rcl1);


    $data_rcl1 = array();
    foreach ($resultado_rcl1 as $row):
        $data_rcl1[] = array(
            "label" => $row['fullnombre'],
            "value" => $row['cantidad'],
            "codigo" => $row['codigo'],
        );

    endforeach;
    $data_rcl1 = json_encode($data_rcl1);
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width">
        </head>
        <body>
            <div>
                <?php
                if (count($resultado_rcl1) == 0) :
                    ?>
                    <div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">¡Ningún cliente ha llenado una ficha entre esas fechas!</div>
                    <?php
                else:
                    ?>
                    <div id="rcl1-container" style="width:100%;"></div>
                    <div id="legend_graph_rcl1"></div>
                <?php
                endif;
                ?>
            </div>
            <div class="clear"></div>


            <script>
    <?php
    if (count($resultado_rcl1) != 0) :
        ?>
                    var graph_rcl1 = Morris.Donut({
                        element: 'rcl1-container',
                        data: <?php echo $data_rcl1; ?>,
                        resize: true,
                        colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB', '#683cce']
                    });

                    graph_rcl1.options.data.forEach(function (label, i) {
                        var legendItem = $('<span></span>').text(label['codigo'] + " - "+ label['label'] + " ( " + label['value'] + " fichas )").prepend('<br><span>&nbsp;</span>');
                        legendItem.find('span')
                                .css('backgroundColor', graph_rcl1.options.colors[i])
                                .css('width', '20px')
                                .css('display', 'inline-block')
                                .css('margin', '5px');
                        $('#legend_graph_rcl1').append(legendItem);
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
