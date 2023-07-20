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
    TopNavbar.style.display = "block";
  } else {
    sidebar.classList.remove("offcanvas", "offcanvas-end", "w-50");
    sidebar.classList.add("collapse", "collapse-horizontal", "show");
    TopNavbar.style.display = "none";
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

const displayTodo = document.getElementById("displayTodo");
const todoSidebar = document.getElementById("todoSidebar");

displayTodo.addEventListener("click", function () {
  if (todoSidebar.style.display === "none") {
    todoSidebar.style.display = "block";
    displayTodo.innerHTML =
      '<i class="bi bi-caret-up-fill fs-3"></i> To-Do List';
  } else {
    todoSidebar.style.display = "none";
    displayTodo.innerHTML =
      '<i class="bi bi-caret-down-fill fs-3"></i> To-Do List';
  }
});

const newTaskBtn = document.getElementById("newTaskBtn");
const taskForm = document.getElementById("taskForm");

newTaskBtn.addEventListener("click", function () {
  if (taskForm.style.display === "none") {
    taskForm.style.display = "block";
    newTaskBtn.innerHTML = '<i class="bi bi-eye-slash fs-3"></i>';
  } else {
    taskForm.style.display = "none";
    newTaskBtn.innerHTML = "New Task";
  }
});
