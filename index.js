const menu = document.querySelector("#menu");
const dropMenu = document.querySelector("#dropMenu");
const main = document.querySelector("main");
let menuCount = 0;

const menuBlogs = document.querySelector("#menuBlogs");
const blogsDiv1 = document.querySelector("#blogsDiv");
const blogsH1 = document.querySelector("#blogsH1");

menu.onclick = function () {
  menuCount++;
  if (menuCount % 2 == 1) {
    dropMenu.style.display = "flex";
  } else {
    dropMenu.style.display = "none";
  }
};

// menu.onclick = function () {
//   console.dir(dropMenu);
//   menuCount++;
//   if (menuCount % 2 == 1) {
//     dropMenu.style.display = "flex";
//   } else {
//     dropMenu.style.display = "none";
//   }
// };

main.onmouseup = function () {
  dropMenu.style.display = "none";
  if ((dropMenu.style.display = "none")) {
    menuCount = 0;
  }
};
