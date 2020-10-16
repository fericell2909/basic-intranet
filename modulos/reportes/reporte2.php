<?php
session_start();
if (isset($_SESSION['id'])):
    require_once '../../config/db.php';
    $obj = new DB();
    $fdesde = $_GET['fdesde'];
    $fhasta = $_GET['fhasta'];

    /*
     *  Los 5 cursos más solicitados entre 2 fechas
     */
    $query_rc1 = "SELECT CONCAT(c.nombre, ' - ', CASE c.condicion WHEN 'pgen' THEN 'Pub. General' WHEN 'tuns' THEN 'Trabajador UNS' WHEN 'auns' THEN 'Alumno UNS' END , ' - ', CASE c.modalidad_id WHEN 'p' THEN 'Presencial' WHEN 'v' THEN 'Virtual' END) AS nombre , COUNT(*) AS cantidad
                    FROM ficha f , cursos c
                    WHERE  f.curso_id = c.id AND DATE(f.created ) BETWEEN '" . $fdesde . "' AND '" . $fhasta . "' AND f.estado = '1'
                    GROUP BY f.curso_id
                    ORDER BY COUNT(*) DESC
                    LIMIT 5";
    $resultado_rc1 = $obj->query($query_rc1);
    $data_rc1 = array();
    foreach ($resultado_rc1 as $row):
        $data_rc1[] = array(
            "label" => $row['nombre'],
            "value" => $row['cantidad']
        );

    endforeach;
    $data_rc1 = json_encode($data_rc1);
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
                if (count($resultado_rc1) == 0) :
                    ?>
                    <div id="CodigoError" class="alert alert-warning  alert-dismissible fade in" role="alert">¡No se han registrado fichas en las fechas solicitadas!</div>
                    <?php
                else:
                    ?>
                    <div id="rc1-container" style="width:100%;"></div>
                    <div id="legend_graph_rc1"></div>
                <?php
                endif;
                ?>
            </div>
            <div class="clear"></div>


            <script>
    <?php
    if (count($resultado_rc1) != 0) :
        ?>
                    var graph_rc1 = Morris.Donut({
                        element: 'rc1-container',
                        data: <?php echo $data_rc1; ?>,
                        resize: true,
                        colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB', '#683cce']
                    });

                    graph_rc1.options.data.forEach(function (label, i) {
                        var legendItem = $('<span></span>').text(label['label'] + " ( " + label['value'] + " fichas )").prepend('<br><span>&nbsp;</span>');
                        legendItem.find('span')
                                .css('backgroundColor', graph_rc1.options.colors[i])
                                .css('width', '20px')
                                .css('display', 'inline-block')
                                .css('margin', '5px');
                        $('#legend_graph_rc1').append(legendItem);
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
