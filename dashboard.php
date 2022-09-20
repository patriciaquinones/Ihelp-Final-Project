<?php
// initialize errors variable
$errors = "";

// connect to database
$db = mysqli_connect("localhost", "root", "", "crud");

// insert a quote if submit button is clicked
if (isset($_POST['submit'])) {
  if (empty($_POST['task'])) {
    $errors = "Debe de llenar el espacio en blanco";
  } else {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
    mysqli_query($db, $sql);
    header('location: dashboard.php');
  }
}

// delete task
if (isset($_GET['del_task'])) {
  $id = $_GET['del_task'];

  mysqli_query($db, "DELETE FROM tasks WHERE id=" . $id);
  header('location: dashboard.php');
}
?>


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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    google.load("visualization", "1", {
      packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([

        ['count(estado)', 'Cant '],
        <?php
        $query = "SELECT count(estado), prioridad FROM datos GROUP by prioridad;";

        $exec = mysqli_query($db, $query);
        while ($row = mysqli_fetch_array($exec)) {

          echo "['" . $row['prioridad'] . "'," . $row['count(estado)'] . "],";
        }
        ?>

      ]);

      var options = {
        title: 'Prioridades',
        pieHole: 0.5,
        pieSliceTextStyle: {
          color: 'black',
        },
        legend: 'none'
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart12"));
      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <img class="logo-img" src="img/logo2.png">
      <span class="logo_name">IHelp</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="dashboard.php" class="active">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="tickets.php">
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
      </li>
      <li class="log_out">
        <a href="logout.php">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
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

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Abiertos</div>
            <div id="abiertos" class="number">
              <?php
              $con = mysqli_connect("localhost", "root", "", "crud");
              $query1 = "select estado from datos where estado like '%bierto%' order by id";

              $query_run1 = mysqli_query($con, $query1);
              $row1 = mysqli_num_rows($query_run1);

              echo '<div> ' . $row1 . ' </div>';
              ?>
            </div>
          </div>
          <img src="https://img.icons8.com/color/48/000000/alarm.png" />
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">En Espera</div>
            <div id="espera" class="number">
              <?php
              $con = mysqli_connect("localhost", "root", "", "crud");
              $query2 = "select estado from datos where estado like '%espera%' order by id";

              $query_run2 = mysqli_query($con, $query2);
              $row2 = mysqli_num_rows($query_run2);

              echo '<div> ' . $row2 . ' </div>';
              ?>
            </div>
          </div>
          <img src="https://img.icons8.com/color/48/000000/every-three-hours.png" />
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Vencidos</div>
            <div id="vencidos" class="number">
              <?php
              $con = mysqli_connect("localhost", "root", "", "crud");
              $query3 = "select estado from datos where estado like '%vencido%' order by id";

              $query_run3 = mysqli_query($con, $query3);
              $row3 = mysqli_num_rows($query_run3);

              echo '<div> ' . $row3 . ' </div>';
              ?>
            </div>
          </div>
          <img src="https://img.icons8.com/color/48/000000/property-time.png" />
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Cerrados</div>
            <div id="cerrados" class="number">
              <?php
              $con = mysqli_connect("localhost", "root", "", "crud");
              $query4 = "select estado from datos where estado = 'cerrado' order by id";

              $query_run4 = mysqli_query($con, $query4);
              $row4 = mysqli_num_rows($query_run4);

              echo '<div> ' . $row4 . ' </div>';
              ?>
            </div>
          </div>
          <img src="https://img.icons8.com/color/48/000000/check-all--v1.png" />
        </div>
      </div>




      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Estado</div>
          <div class="sales-details">

            <div class="container-fluid">
              <div id="columnchart12"></div>
            </div>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Lista de Tareas</div>
          <form method="post" action="dashboard.php" class="input_form">
            <?php if (isset($errors)) { ?>
              <p><?php echo $errors; ?></p>
            <?php } ?>
            <input type="text" name="task" class="task_input">
            <button type="submit" name="submit" id="add_btn" class="add_btn">Agregar</button>
          </form>
          <table class="table-lista">
            <thead>
              <tr>
                <th>#</th>
                <th>Tarea</th>
                <th style="width: 60px;">Accion</th>
              </tr>
            </thead>

            <tbody>
              <?php
              // select all tasks if page is visited or refreshed
              $tasks = mysqli_query($db, "SELECT * FROM tasks");

              $i = 1;
              while ($row = mysqli_fetch_array($tasks)) { ?>
                <tr>
                  <td> <?php echo $i; ?> </td>
                  <td class="task"> <?php echo $row['task']; ?> </td>
                  <td class="delete">
                    <a href="dashboard.php?del_task=<?php echo $row['id'] ?>">x</a>
                  </td>
                </tr>
              <?php $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
  </section>

  <script src="script.js"></script>

</body>

</html>