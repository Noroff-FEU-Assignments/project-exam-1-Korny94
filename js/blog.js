const blogDiv = document.querySelector("#blogDiv");

const loadingDiv = document.querySelector("#loading");

const blogTitle = document.querySelector("#blogTitle");

const queryString = document.location.search;

const params = new URLSearchParams(queryString);

const title = document.querySelector("title");

const id = params.get("id");

console.log(id);

const urlKeyId = "https://unifacts.local/wp-json/wp/v2/posts/" + id;

console.log(urlKeyId);

async function fetchBlog() {
  try {
    const response = await fetch(urlKeyId);
    const json = await response.json();

    console.log(json);

    loadingDiv.classList.remove("loading");

    blogTitle.innerHTML = json.title.rendered;
    title.innerHTML = "UniFacts | " + json.title.rendered;

    createBlogHtml(json);
    clickImg(json);
  } catch (err) {
    console.log(err);
    loadingDiv.classList.remove("loading");
    blogDiv.classList.add("error");
    blogDiv.innerHTML = "There was an error!";
  }
}

fetchBlog();

function createBlogHtml(json) {
  blogDiv.innerHTML = `
        ${json.content.rendered}
`;
}

function clickImg(json) {
  //   const htmlString = json.content.rendered;
  //   const parser = new DOMParser();
  //   const domElement = parser.parseFromString(htmlString, "text/html");
  //   console.log(domElement.getElementsByTagName("img"));
  //   const imgTags = domElement.getElementsByTagName("img");
  //   const images = json.content.rendered;
  //   const tempDiv = document.createElement("div");
  //   tempDiv.innerHTML = images;
  //   const imgTags = tempDiv.getElementsByTagName("img");
  //   for (let i = 0; i < imgTags.length; i++) {
  //     imgTags[i].addEventListener("click", function () {
  //       console.log("clicked");
  //     });
  //   }
  const images = blogDiv.querySelectorAll("img");
  const imgPopupBG = document.querySelector("#imgPopupBG");
  const imgPopup = document.querySelector("#imgPopup");

  images.forEach(function (img) {
    img.onclick = function () {
      imgPopupBG.style.display = "flex";
      imgPopup.style.backgroundImage = `url(${img.src})`;
    };
  });
  imgPopupBG.onclick = function () {
    imgPopupBG.style.display = "none";
  };
}

// function createImgPopup() {
//   blogDiv.innerHTML = `
//     <div class="imgPopupBG">
//     <div class="imgPopup" style="background-image: url(${img.src})"></div>
//   </div>
//   `;
// }
