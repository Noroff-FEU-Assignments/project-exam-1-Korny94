const menu = document.querySelector("#menu");
const dropMenu = document.querySelector("#dropMenu");
const body = document.querySelector("body");
let menuCount = 0;

menu.onclick = function () {
  menuCount++;
  if (menuCount % 2 == 1) {
    dropMenu.style.display = "flex";
  } else {
    dropMenu.style.display = "none";
  }
};

dropMenu.onmouseleave = function () {
  dropMenu.style.display = "none";
  menuCount = 0;
};
