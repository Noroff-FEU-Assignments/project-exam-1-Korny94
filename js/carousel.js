const latestDivs = document.querySelector("#latestDivs");
const arrowLeft = document.querySelector("#arrowLeft");
const arrowRight = document.querySelector("#arrowRight");

arrowLeft.onclick = function () {
  latestDivs.scrollLeft -= 400;
};

arrowRight.onclick = function () {
  latestDivs.scrollLeft += 400;
};

const blogsDiv = document.querySelector("#blogsDiv");
const loading = document.querySelector("#loading");
const api = "https://unifacts.local/wp-json/wp/v2/posts?_embed";

async function fetchBlogs() {
  try {
    const response = await fetch(api);
    const json = await response.json();

    console.log(json);

    loading.classList.remove("loading");

    json.forEach(function (carousel) {
      latestDivs.innerHTML += `
            <a href="/html/blog.html?id=${carousel.id}" class="latestCard">
                <img class="latestImg" src="${carousel.featured_media_src_url}"/>
                <h3 class="latestTitle">${carousel.excerpt.rendered}</h3>
            </a>
        `;
    });
  } catch (err) {
    loading.classList.remove("loading");
    blogsDiv.classList.add("error");
    blogsDiv.innerHTML = "There was an error!";
    console.log(err);
  }
}

fetchBlogs();
