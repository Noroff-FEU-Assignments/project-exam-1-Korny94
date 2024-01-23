const metaDescription = document.querySelector("#metaDescription");

const blogDiv = document.querySelector("#blogDiv");

const loadingDiv = document.querySelector("#loading");

const blogTitle = document.querySelector("#blogTitle");

const queryString = document.location.search;

const params = new URLSearchParams(queryString);

const title = document.querySelector("title");

const id = params.get("id");

console.log(id);

const urlKeyId =
  "https://karlmagnusnokling.no/haley/wp-json/wp/v2/posts/" + id + "?_embed";

console.log(urlKeyId);

async function fetchBlog() {
  try {
    const response = await fetch(urlKeyId);
    const json = await response.json();

    console.log(json);
    if (json.categories[0] == 26) {
      loadingDiv.classList.remove("loading");

      blogTitle.innerHTML = json.title.rendered;
      title.innerHTML = "UniFacts | " + json.title.rendered;

      createBlogHtml(json);
      clickImg(json);
    }
  } catch (err) {
    console.log("WADUUUP");
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
  const images = blogDiv.querySelectorAll("img");
  const imgPopupBG = document.querySelector("#imgPopupBG");
  const imgPopup = document.querySelector("#imgPopup");

  images.forEach(function (img) {
    img.onclick = function () {
      imgPopupBG.style.display = "flex";
      imgPopup.src = `${img.src}`;
      imgPopup.alt = `${img.alt}`;
    };
  });
  imgPopupBG.onclick = function () {
    imgPopupBG.style.display = "none";
  };
}
