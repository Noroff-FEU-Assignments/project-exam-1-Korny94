const randomBlog = document.querySelector("#randomBlog");
const api1 =
  "https://karlmagnusnokling.no/unifacts/wp-json/wp/v2/posts?per_page=12&_embed";

async function randomBlogs() {
  try {
    const response = await fetch(api1);
    const json = await response.json();

    console.log(json);

    const randomIndex = Math.floor(Math.random() * json.length);
    const random = json[randomIndex];

    randomBlog.onclick = function () {
      window.location.href = "/html/blog.html?id=" + random.id;
    };
  } catch (err) {
    console.log(err);
  }
}

randomBlogs();
