const blogsDiv = document.querySelector("#blogsDiv");
const loading = document.querySelector("#loading");
const viewMore = document.querySelector("#viewMore");
const api = "http://unifacts.local/wp-json/wp/v2/posts?per_page=";
let per_page = "10";
let viewMoreCount = 0;

async function fetchBlogs() {
  try {
    const response = await fetch(api + per_page);
    const json = await response.json();

    console.log(json);

    loading.classList.remove("loading");
    json.forEach(function (blogs) {
      blogsDiv.innerHTML += `
                  <a href="/html/blog.html?id=${blogs.id}" class="blogDivs">
                      <h2>${blogs.title.rendered}</h2>
                      <div>${blogs.excerpt.rendered}</div>
                  <hr>
                  </a>
              `;
    });

    if (scrollToBottom) {
      window.scrollTo({
        top: document.body.scrollHeight,
        behavior: "smooth",
      });
      scrollToBottom = false;
    }
  } catch (err) {
    blogsDiv.classList.remove("loading");
    blogsDiv.classList.add("error");
    blogsDiv.innerHTML = "There was an error!";
    console.log(err);
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
