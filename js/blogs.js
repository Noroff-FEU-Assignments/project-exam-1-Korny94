const menuBlogs = document.querySelector("#menuBlogs");
const blogsDiv1 = document.querySelector("#blogsDiv");
const blogsH1 = document.querySelector("#blogsH1");

let menuCount = 0;
menuBlogs.onclick = function () {
  menuCount++;
  if (menuCount % 2 == 1) {
    blogsH1.style.marginLeft = "-250px";
    dropMenu.style.display = "flex";
    blogsDiv1.style.width = "50vw";
  } else {
    blogsH1.style.marginLeft = "0";
    dropMenu.style.display = "none";
    blogsDiv1.style.width = "90vw";
  }
};
