<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- cdn icnonos-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script type="text/javascript">
    function exportToExcel(tableID, filename = 'Datos') {
      var downloadurl;
      var dataFileType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

      // Specify file name
      filename = filename ? filename + '.xls' : 'export_excel_data.xls';

      // Create download link element
      downloadurl = document.createElement("a");

      document.body.appendChild(downloadurl);

      if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTMLData], {
          type: dataFileType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
      } else {
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;

        // Setting the file name
        downloadurl.download = filename;

        //triggering the function
        downloadurl.click();
      }
    }
  </script>
</head>

<body>

  <?php
  include_once "model/conexion.php";
  $sentencia = $bd->query("select * from datos");
  $info = $sentencia->fetchAll(PDO::FETCH_OBJ);
  //print_r($persona);
  ?>

  <div class="sidebar" style="position:absolute; top: 0%;">
    <div class="logo-details">
      <img class="logo-img" src="img/logo2.png">
      <span class="logo_name">IHelp</span>
    </div>
    <ul class="nav-links" style="margin-left: 0px; padding: 0px;">
      <li>
        <a href="dashboard.php">
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
          <span class="links_name">Soluciones</span>
        </a>
      </li>
      <li class="log_out">
        <a href="logout.php">
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
      <div class="container mt-5 ">
        <div class="row justify-content-center">
          <div class="col-md-7">
            <!-- inicio alerta -->
            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta') {
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php
            }
            ?>


            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado') {
            ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Registrado!</strong> Se agregaron los datos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php
            }
            ?>



            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Vuelve a intentar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php
            }
            ?>



            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado') {
            ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Cambiado!</strong> Los datos fueron actualizados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php
            }
            ?>


            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado') {
            ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Eliminado!</strong> Los datos fueron borrados.
                <button type="button" id="close" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="close()"></button>
              </div>
            <?php
            }
            ?>

            <!-- fin alerta -->
            <div class="card card-left">
              <div class="card-header">
                Lista de Tickets
              </div>
              <div class="p-4">
                <table id="tblexportData" class="table table-export align-middle">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Asunto</th>
                      <th scope="col">Prioridad</th>
                      <th scope="col">Estado</th>
                      <th scope="col" colspan="2">Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="box">

                    <?php
                    foreach ($info as $dato) {
                    ?>

                      <tr>
                        <td scope="row"><?php echo $dato->id; ?></td>
                        <td><?php echo $dato->asunto; ?></td>
                        <td><?php echo $dato->prioridad; ?></td>
                        <td><?php echo $dato->estado; ?></td>
                        <td><a class="text-success" href="editar.php?id=<?php echo $dato->id; ?>"><i class="bi bi-pencil-square"></i></a></td>
                        <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?id=<?php echo $dato->id; ?>"><i class="bi bi-trash"></i></a></td>
                      </tr>

                    <?php
                    }
                    ?>

                  </tbody>
                </table>

              </div>
              <button onclick="exportToExcel('tblexportData', 'user-data')" class="btn btn-success">Exportar a EXCEL</button>

            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-right">
              <div class="card-header">
                Ingresar datos:
              </div>
              <form class="p-4" method="POST" action="registrar.php">
                <div class="mb-3">
                  <label class="form-label">Asunto: </label>
                  <input type="text" class="form-control" name="txtasunto" autofocus required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Prioridad: </label>
                  <input type="text" class="form-control" name="txtprioridad" autofocus required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Estado: </label>
                  <input type="text" class="form-control" name="txtestado" autofocus required>
                </div>
                <div class="d-grid">
                  <input type="hidden" name="oculto" value="1">
                  <input type="submit" class="btn btn-primary" value="Registrar">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="script.js"></script>

</body>

</html>