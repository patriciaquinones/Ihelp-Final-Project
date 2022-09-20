<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
if (!isset($_GET['id'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$id = $_GET['id'];

$sentencia = $bd->prepare("select * from datos where id = ?;");
$sentencia->execute([$id]);
$info = $sentencia->fetch(PDO::FETCH_OBJ);
//print_r($info);
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IHelp</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/51b4f279c6.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- cdn icnonos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="sidebar" style="position:absolute; top: 0%;">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">IHelp</span>
        </div>
        <ul class="nav-links"  style="margin-left: 0px; padding: 0px;">
            <li>
                <a href="index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="tickets.php" class="active">
                    <i class='bx bx-box'></i>
                    <span class="links_name">Tickets</span>
                </a>
            </li>
            <li>
                <a href="soluciones.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">FAQ</span>
                </a>
            </li>
            <li class="log_out">
                <a href="#">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section" style="position:fixed;">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Buscar...">
                <i class='bx bx-search'></i>
            </div>
            <div class="profile-details">
                <!--<img src="images/profile.jpg" alt="">-->
                <span class="admin_name"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            </div>
        </nav>

        <main>
            <div class="container mt-5 editar-contenedor">
                <div class="row justify-content-center">
                    <div class="col-md-4" style="margin:50px;">
                        <div class="card editar-contenedor" style="margin-top:20%;">
                            <div class="card-header">
                                Editar datos:
                            </div>
                            <form class="p-4" method="POST" action="editarProceso.php">
                                <div class="mb-3">
                                    <label class="form-label">Asunto: </label>
                                    <input type="text" class="form-control" name="txtasunto" required value="<?php echo $info->asunto; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Prioridad: </label>
                                    <input type="text" class="form-control" name="txtprioridad" autofocus required value="<?php echo $info->prioridad; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Estado: </label>
                                    <input type="text" class="form-control" name="txtestado" autofocus required value="<?php echo $info->estado; ?>">
                                </div>
                                <div class="d-grid">
                                    <input type="hidden" name="id" value="<?php echo $info->id; ?>">
                                    <input type="submit" class="btn btn-primary" value="Editar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</body>

</html>