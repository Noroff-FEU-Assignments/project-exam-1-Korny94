const blogsDiv = document.querySelector("#blogsDiv");

const loading = document.querySelector("#loading");
const viewMore = document.querySelector("#viewMore");
const recentBlogs = document.querySelector("#recentBlogs");
const alsoLike = document.querySelector("#alsoLike");
const api =
  "https://karlmagnusnokling.no/unifacts/wp-json/wp/v2/posts?per_page=";
let per_page = "10";
let viewMoreCount = 0;

async function fetchBlogs() {
  try {
    const response = await fetch(api + per_page + "&_embed");
    const json = await response.json();

    console.log(json);

    loading.classList.remove("loading");

    json.sort(function (a, b) {
      const dateA = new Date(a.date);
      const dateB = new Date(b.date);
      return dateB - dateA;
    });

    json.forEach(function (blogs) {
      blogsDiv.innerHTML += `
                    <a href="/html/blog.html?id=${blogs.id}" class="blogDivs">
                        <h2>${blogs.title.rendered}</h2>
                        <div class="blogsImgsContainer"><img class="blogsImgs" src="${blogs._embedded["wp:featuredmedia"][0].source_url}" alt="${blogs._embedded["wp:featuredmedia"][0].alt_text}"/></div>
                        
                    <hr class="hr">
                    </a>
                `;
    });

    if (!alsoLike) {
      if ((recentBlogs.innerHTML = "<h1>Recent Posts</h1>")) {
        for (let i = 0; i < 5; i++) {
          recentBlogs.innerHTML += `
        <a href="/html/blog.html?id=${json[i].id}" class="blogDivs">
            <h2>${json[i].title.rendered}</h2>
        <hr>
        </a>
    `;
        }
      }
    }

    if (!recentBlogs) {
      for (let i = 0; i < 5; i++) {
        alsoLike.innerHTML += `
        <a href="/html/blog.html?id=${json[i].id}" class="blogDivs">
            <h2>${json[i].title.rendered}</h2>
        <hr>
        </a>
    `;
      }
    }

    if (scrollToBottom) {
      window.scrollTo({
        top: document.body.scrollHeight,
        behavior: "smooth",
      });
      scrollToBottom = false;
    }
  } catch (err) {
    loading.classList.remove("loading");
    blogsDiv.classList.add("error");
    blogsDiv.innerHTML = "There was an error!";
    blogDiv.classList.add("error");
    blogDiv.innerHTML = "There was an error!";
    console.dir(err);
  }
}

let scrollToBottom = false;

fetchBlogs();

viewMore.onclick = function () {
  viewMoreCount++;

  if (viewMoreCount % 2 == 1) {
    blogsDiv.innerHTML = "";
    per_page = "12";
    viewMore.innerHTML = "View less..";
    scrollToBottom = true;
    fetchBlogs();
  } else {
    scrollToBottom = true;
    blogsDiv.innerHTML = "";
    per_page = "10";
    viewMore.innerHTML = "View more..";
    fetchBlogs();
  }
};
