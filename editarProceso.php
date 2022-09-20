<?php
    print_r($_POST);
    if(!isset($_POST['id'])){
        header('Location: tickets.php?mensaje=error');
    }

    include 'model/conexion.php';
    $id = $_POST['id'];
    $asunto = $_POST['txtasunto'];
    $prioridad = $_POST['txtprioridad'];
    $estado = $_POST['txtestado'];

    $sentencia = $bd->prepare("UPDATE datos SET asunto = ?, prioridad = ?, estado = ? where id = ?;");
    $resultado = $sentencia->execute([$asunto, $prioridad, $estado, $id]);

    if ($resultado === TRUE) {
        header('Location: tickets.php?mensaje=editado');
    } else {
        header('Location: tickets.php?mensaje=error');
        exit();
    }
