<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
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

</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <img class="logo-img" src="img/logo2.png">
      <span class="logo_name">IHelp</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="dashboard.php">
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
        <a href="soluciones.php" class="active">
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

    </div>
  </section>

  <section class="seccion-accordion">
    <h1>FAQ</h1>
    <h3>Antes de crear un ticket de reclamación puedes verificar nuestras preguntas frecuentes para dar con la solución.</h3>
    <div class="c">
      <input class="input" type="checkbox" id="faq-1">
      <h1><label for="faq-1">¿Cómo reemplazo la lámpara?</label></h1>
      <div class="p">
        <p>Antes de reemplazar la lámpara, espere por lo menos una hora a que la lámpara se enfríe.
          Puede reemplazar la lámpara mientras el proyector está instalado en el techo, si es necesario.

          <br>-Apague el proyector y desconecte el cable de alimentación.
          <br>-Deje que la lámpara del proyector se enfríe por lo menos una hora.
          <br>-Use el destornillador que se incluye con la lámpara de repuesto para aflojar el tornillo que fija la tapa de la lámpara.
          <br>-Advertencia: Si la lámpara se rompe, pueden quedar fragmentos de vidrio dentro de la cámara de la lámpara. Asegúrese de extraer cuidadosamente todos los trozos de vidrio para evitar lesiones.
          <br>-Deslice la tapa de la lámpara del proyector y retírela.
          <br>-Afloje los tornillos que fijan la lámpara al proyector. Los tornillos no se podrán extraer por completo.
        </p>

        <p>Realice una de las siguientes acciones:
          Introduzca la lámpara nueva en el proyector con cuidado. Si no encaja fácilmente, compruebe que esté en la posición correcta. Presione la manija hacia abajo
          <br>Precaución:
          No toque el vidrio de la lámpara para evitar una falla prematura de ésta.
          Presione la lámpara firmemente y apriete los tornillos para fijarla en su lugar.
          Vuelva a colocar la tapa de la lámpara y apriete el tornillo para fijarla en su lugar. Reinicie el temporizador de la lámpara a cero para mantener un registro de uso de la lámpara nueva.
        </p>
      </div>
    </div>
    <div class="c">
      <input class="input" type="checkbox" id="faq-2">
      <h1><label for="faq-2">¿Por qué desde mi PC yo no puedo bajar las fotos de mi cámara?</label></h1>
      <div class="p">
        <p>Si el software no encuentra la Photo PC la puerta serial que usted está usando para conectar la Photo PC puede estar deshabilitada o no está trabajando correctamente. Trate conectando la Photo PC a otro puerto serial. Otra sugerencia es verificar el seteo de la CMOS de su PC para ver si el puerto está deshabilitado. Si está deshabitado cambie el seteo para habilitar este puerto. </p>
      </div>
    </div>
    <div class="c">
      <input class="input" type="checkbox" id="faq-3">
      <h1><label for="faq-3">¿Cómo imprimo una página web con Epson iPrint?</label></h1>
      <div class="p">
        <p>Puede imprimir una página web desde su navegador web. Haga lo siguiente:
          <br>- Abra su navegador web y navegue a la página web que desea imprimir.
          <br>- Seleccione la opción de compartir.
          <br> - Toque el icono de Epson iPrint.
          <br> - Toque el icono de impresora.
          <br> - Toque el icono de tuerca para cambiar el tamaño de papel, la calidad de impresión y otros ajustes, según sea necesario.
          <br> - Toque Imprimir.
        </p>
      </div>
    </div>
    <div class="c">
      <input class="input" type="checkbox" id="faq-4">
      <h1><label for="faq-4">Problemas de alimentación en el escáner</label></h1>
      <div class="p">
        <p>Si tiene problemas alimentando los originales en el escáner, pruebe estas soluciones:
          <br>- Si avanzan varias hojas a la vez, haga lo siguiente:
          <br>- Confirme que la palanca de separación del papel esté en la posición inferior.
          <br>- Retire los originales, airee los bordes para separar las hojas, si es necesario, luego vuelva a cargarlos.
          <br>- Solo cargue originales que cumplan con las especificaciones del escáner.
          <br>- Limpie el interior del escáner y sustituya el kit de montaje del rodillo, si es necesario.
        </p>
      </div>
    </div>



  </section>

  <script src="script.js"></script>

</body>

</html>