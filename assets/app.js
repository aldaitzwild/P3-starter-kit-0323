import "./styles/app.scss";

import "./bootstrap";
require("bootstrap");

// Message Flash

const sidebar = document.getElementById("sidebar");
const TopNavbar = document.getElementById("topNavbar");

function updateSidebarClasses() {
  if (window.innerWidth < 768) {
    sidebar.classList.remove("collapse", "collapse-horizontal", "show");
    sidebar.classList.add("offcanvas", "offcanvas-end", "w-50");
    topNavbar.style.display = "block";
  } else {
    sidebar.classList.remove("offcanvas", "offcanvas-end", "w-50");
    sidebar.classList.add("collapse", "collapse-horizontal", "show");
    topNavbar.style.display = "none";
  }
}

updateSidebarClasses();

window.addEventListener("resize", updateSidebarClasses);

setTimeout(function () {
  var flashMessage = document.querySelector("div.alert");
  if (flashMessage) {
    flashMessage.remove();
  }
}, 5000);

const newTaskBtn = document.getElementById("newTaskBtn");
const taskForm = document.getElementById("taskForm");

newTaskBtn.addEventListener("click", function () {
  if (taskForm.style.display === "none") {
    taskForm.style.display = "block";
  } else {
    taskForm.style.display = "none";
  }
});
