/*menu */
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function () {
  sidebar.classList.toggle("active");
  if (sidebar.classList.contains("active")) {
    sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
  } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
};

/*dashboard*/

//Script de soluciones

function openForm() {
  document.getElementById("myForm").style.display = "inline-block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function close () {
  document.getElementById("close").style.display = "none";
}
