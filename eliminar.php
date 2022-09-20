<?php 
    if(!isset($_GET['id'])){
        header('Location: tickets.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';
    $codigo = $_GET['id'];

    $sentencia = $bd->prepare("DELETE FROM datos where id = ?;");
    $resultado = $sentencia->execute([$id]);

    if ($resultado === TRUE) {
        header('Location: tickets.php?mensaje=eliminado');
    } else {
        header('Location: tickets.php?mensaje=error');
    }
