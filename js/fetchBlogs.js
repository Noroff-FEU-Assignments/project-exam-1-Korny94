const blogsDiv = document.querySelector("#blogsDiv");
const loading = document.querySelector("#loading");

async function fetchBlogs() {
  try {
    const response = await fetch(
      "http://unifacts.local/wp-json/wp/v2/posts?per_page=12"
    );
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
  } catch (err) {
    blogsDiv.classList.remove("loading");
    blogsDiv.classList.add("error");
    blogsDiv.innerHTML = "There was an error!";
    console.log(err);
  }
}

fetchBlogs();
