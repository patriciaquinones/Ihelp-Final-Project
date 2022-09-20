<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtasunto"]) || empty($_POST["txtprioridad"]) || empty($_POST["txtestado"])){
        header('Location: tickets.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    $asunto = $_POST["txtasunto"];
    $prioridad = $_POST["txtprioridad"];
    $estado = $_POST["txtestado"];
    
    $sentencia = $bd->prepare("INSERT INTO datos(asunto,prioridad,estado) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$asunto,$prioridad,$estado]);

    if ($resultado === TRUE) {
        header('Location: tickets.php?mensaje=registrado');
    } else {
        header('Location: tickets.php?mensaje=error');
        exit();
    }
