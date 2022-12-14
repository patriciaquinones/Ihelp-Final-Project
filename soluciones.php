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
    <h3>Antes de crear un ticket de reclamaci??n puedes verificar nuestras preguntas frecuentes para dar con la soluci??n.</h3>
    <div class="c">
      <input class="input" type="checkbox" id="faq-1">
      <h1><label for="faq-1">??C??mo reemplazo la l??mpara?</label></h1>
      <div class="p">
        <p>Antes de reemplazar la l??mpara, espere por lo menos una hora a que la l??mpara se enfr??e.
          Puede reemplazar la l??mpara mientras el proyector est?? instalado en el techo, si es necesario.

          <br>-Apague el proyector y desconecte el cable de alimentaci??n.
          <br>-Deje que la l??mpara del proyector se enfr??e por lo menos una hora.
          <br>-Use el destornillador que se incluye con la l??mpara de repuesto para aflojar el tornillo que fija la tapa de la l??mpara.
          <br>-Advertencia: Si la l??mpara se rompe, pueden quedar fragmentos de vidrio dentro de la c??mara de la l??mpara. Aseg??rese de extraer cuidadosamente todos los trozos de vidrio para evitar lesiones.
          <br>-Deslice la tapa de la l??mpara del proyector y ret??rela.
          <br>-Afloje los tornillos que fijan la l??mpara al proyector. Los tornillos no se podr??n extraer por completo.
        </p>

        <p>Realice una de las siguientes acciones:
          Introduzca la l??mpara nueva en el proyector con cuidado. Si no encaja f??cilmente, compruebe que est?? en la posici??n correcta. Presione la manija hacia abajo
          <br>Precauci??n:
          No toque el vidrio de la l??mpara para evitar una falla prematura de ??sta.
          Presione la l??mpara firmemente y apriete los tornillos para fijarla en su lugar.
          Vuelva a colocar la tapa de la l??mpara y apriete el tornillo para fijarla en su lugar. Reinicie el temporizador de la l??mpara a cero para mantener un registro de uso de la l??mpara nueva.
        </p>
      </div>
    </div>
    <div class="c">
      <input class="input" type="checkbox" id="faq-2">
      <h1><label for="faq-2">??Por qu?? desde mi PC yo no puedo bajar las fotos de mi c??mara?</label></h1>
      <div class="p">
        <p>Si el software no encuentra la Photo PC la puerta serial que usted est?? usando para conectar la Photo PC puede estar deshabilitada o no est?? trabajando correctamente. Trate conectando la Photo PC a otro puerto serial. Otra sugerencia es verificar el seteo de la CMOS de su PC para ver si el puerto est?? deshabilitado. Si est?? deshabitado cambie el seteo para habilitar este puerto. </p>
      </div>
    </div>
    <div class="c">
      <input class="input" type="checkbox" id="faq-3">
      <h1><label for="faq-3">??C??mo imprimo una p??gina web con Epson iPrint?</label></h1>
      <div class="p">
        <p>Puede imprimir una p??gina web desde su navegador web. Haga lo siguiente:
          <br>- Abra su navegador web y navegue a la p??gina web que desea imprimir.
          <br>- Seleccione la opci??n de compartir.
          <br> - Toque el icono de Epson iPrint.
          <br> - Toque el icono de impresora.
          <br> - Toque el icono de tuerca para cambiar el tama??o de papel, la calidad de impresi??n y otros ajustes, seg??n sea necesario.
          <br> - Toque Imprimir.
        </p>
      </div>
    </div>
    <div class="c">
      <input class="input" type="checkbox" id="faq-4">
      <h1><label for="faq-4">Problemas de alimentaci??n en el esc??ner</label></h1>
      <div class="p">
        <p>Si tiene problemas alimentando los originales en el esc??ner, pruebe estas soluciones:
          <br>- Si avanzan varias hojas a la vez, haga lo siguiente:
          <br>- Confirme que la palanca de separaci??n del papel est?? en la posici??n inferior.
          <br>- Retire los originales, airee los bordes para separar las hojas, si es necesario, luego vuelva a cargarlos.
          <br>- Solo cargue originales que cumplan con las especificaciones del esc??ner.
          <br>- Limpie el interior del esc??ner y sustituya el kit de montaje del rodillo, si es necesario.
        </p>
      </div>
    </div>



  </section>

  <script src="script.js"></script>

</body>

</html>