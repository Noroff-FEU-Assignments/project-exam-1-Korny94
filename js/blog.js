const blogDiv = document.querySelector("#blogDiv");

const loadingDiv = document.querySelector("#loading");

const blogTitle = document.querySelector("#blogTitle");

const queryString = document.location.search;

const params = new URLSearchParams(queryString);

const id = params.get("id");

console.log(id);

const urlKeyId = "http://unifacts.local/wp-json/wp/v2/posts/" + id;

console.log(urlKeyId);

async function fetchBlog() {
  try {
    const response = await fetch(urlKeyId);
    const json = await response.json();

    console.log(json);

    loadingDiv.classList.remove("loading");

    blogTitle.innerHTML = json.title.rendered;

    createBlogHtml(json);
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
