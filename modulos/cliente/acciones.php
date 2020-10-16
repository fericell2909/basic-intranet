<?php

require_once '../../config/db.php';

$tabla = 'cliente';
$obj = new DB();
switch ($_GET['accion']) {
    case 'nuevo':

        $cliente_id         = $_POST['codigo'];
        $condicion          = $_POST['cbx_condicion'];
        $apellidos          = $_POST['apellidos'];
        $nombres            = $_POST['nombres'];
        $fnacimiento        = $_POST['fnacimiento'];
        $cbx_distrito       = $_POST['cbx_distrito'];
        $sexo               = $_POST['sexo'];
        $domicilio          = $_POST['domicilio'];
        $email              = $_POST['email'];
        $facebook           = $_POST['facebook'];
        $tfijo              = $_POST['tfijo'];
        $tcelular           = $_POST['tcelular'];
        $ocupacion          = $_POST['ocupacion'];


        $query      = "SELECT * FROM cliente WHERE id='" . $cliente_id . "'";
        $resultado  = $obj->query($query);

        if (empty($resultado)) {
            $query      = "INSERT INTO cliente (id, condicion, apellidos, nombres, fnacimiento, lndistrito, sexo, domicilio, email, facebook, tfijo, tcelular, ocupacion) VALUES ('$cliente_id', '$condicion', '$apellidos', '$nombres', '$fnacimiento', '$cbx_distrito', '$sexo', '$domicilio', '$email', IF('$facebook'='',NULL,'$facebook'), IF('$tfijo'='',NULL,'$tfijo'), '$tcelular', '$ocupacion')";
            $resultado  = $obj->InsertUpdateQuery($query);
            echo $resultado;
        } else {
            $query      = "UPDATE cliente SET condicion='$condicion', apellidos='$apellidos', nombres='$nombres', fnacimiento='$fnacimiento', lndistrito='$cbx_distrito', sexo='$sexo', domicilio='$domicilio', email='$email', facebook=IF('$facebook'='',NULL,'$facebook'), tfijo=IF('$tfijo'='',NULL,'$tfijo'), tcelular='$tcelular', ocupacion='$ocupacion' WHERE id = '$cliente_id'";
            $resultado  = $obj->InsertUpdateQuery($query);
            echo $resultado;
        }

        break;
    case 'editar':
        $id                 = $_POST['cliente_id'];
        $condicion          = $_POST['cbx_condicion'];
        $apellidos          = $_POST['apellidos'];
        $nombres            = $_POST['nombres'];
        $fnacimiento        = $_POST['fnacimiento'];
        $domicilio          = $_POST['domicilio'];
        $sexo               = $_POST['sexo'];
        $cbx_distrito       = $_POST['cbx_distrito'];
        $ocupacion          = $_POST['ocupacion'];
        $email              = $_POST['email'];
        $facebook           = $_POST['facebook'];
        $tfijo              = $_POST['tfijo'];
        $tcelular           = $_POST['tcelular'];

        $query      = "UPDATE cliente SET condicion='$condicion', apellidos='$apellidos', nombres='$nombres', fnacimiento='$fnacimiento', lndistrito='$cbx_distrito', sexo='$sexo', domicilio='$domicilio', email='$email', facebook=IF('$facebook'='',NULL,'$facebook'), tfijo=IF('$tfijo'='',NULL,'$tfijo'), tcelular='$tcelular', ocupacion='$ocupacion' WHERE id = '$id'";
        $resultado  = $obj->InsertUpdateQuery($query);
        echo $resultado;

        break;

    case 'buscarCodigo':
        $query = 'SELECT id FROM cliente WHERE id = "' . $_POST['codigoCliente'].'"';
        echo count($obj->query($query));
        break;

    case 'eliminar':
        $id = $_POST['cliente_id'];
        $obj->eliminarID($tabla, $id);
        header('location:../../clientes.php');
        break;
}
