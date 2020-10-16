<?php

require_once '../../config/db.php';

$tabla = 'docente';
$obj = new DB();
switch ($_GET['accion']) {
    case 'nuevo':

        $cliente_id         = $_POST['codigo'];
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


        $query      = "SELECT * FROM docente WHERE id='" . $cliente_id . "'";
        $resultado  = $obj->query($query);

        if (empty($resultado)) {
            $query      = "INSERT INTO docente (id, apellidos, nombres, fnacimiento, lndistrito, sexo, domicilio, email, facebook, tfijo, tcelular, ocupacion , active) VALUES ('$cliente_id', '$apellidos', '$nombres', '$fnacimiento', '$cbx_distrito', '$sexo', '$domicilio', '$email', IF('$facebook'='',NULL,'$facebook'), IF('$tfijo'='',NULL,'$tfijo'), '$tcelular', '$ocupacion' , '1')";
            $resultado  = $obj->InsertUpdateQuery($query);
            echo $resultado;
        } else {
            $query      = "UPDATE docente SET apellidos='$apellidos', nombres='$nombres', fnacimiento='$fnacimiento', lndistrito='$cbx_distrito', sexo='$sexo', domicilio='$domicilio', email='$email', facebook=IF('$facebook'='',NULL,'$facebook'), tfijo=IF('$tfijo'='',NULL,'$tfijo'), tcelular='$tcelular', ocupacion='$ocupacion' , active = '1' WHERE id = '$cliente_id'";
            $resultado  = $obj->InsertUpdateQuery($query);
            echo $resultado;
        }

        break;
    case 'editar':
        $id                 = $_POST['docente_id'];
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

        $query      = "UPDATE docente SET apellidos='$apellidos', nombres='$nombres', fnacimiento='$fnacimiento', lndistrito='$cbx_distrito', sexo='$sexo', domicilio='$domicilio', email='$email', facebook=IF('$facebook'='',NULL,'$facebook'), tfijo=IF('$tfijo'='',NULL,'$tfijo'), tcelular='$tcelular', ocupacion='$ocupacion' WHERE id = '$id'";
        $resultado  = $obj->InsertUpdateQuery($query);
        echo $resultado;

        break;

    case 'buscarCodigo':
        $query = 'SELECT id FROM docente WHERE id = "' . $_POST['codigoCliente'].'"';
        echo count($obj->query($query));
        break;

    case 'eliminar':
        $id = $_POST['docente_id'];
        $obj->eliminarID($tabla, $id);
        header('location:../../docentes.php');
        break;
}
