const randomBlog = document.querySelector("#randomBlog");
const api1 =
  "https://karlmagnusnokling.no/haley/wp-json/wp/v2/posts?categories=26&per_page=12&_embed";

// const username = process.env.REACT_APP_USERNAME;
// const password = process.env.REACT_APP_PASSWORD;

const randomBlogsUsername = "haleyspappa";
const randomBlogsPassword = "unifacts";

// async function randomBlogs() {
//   try {
//     const response = await fetch(api1);
//     const json = await response.json();

//     console.log(json);

//     const randomIndex = Math.floor(Math.random() * json.length);
//     const random = json[randomIndex];
//     if (random.categories[0] == 26) {
//       randomBlog.onclick = function () {
//         window.location.href = "/html/blog.html?id=" + random.id;
//       };
//     } else {
//       randomBlogs();
//     }
//   } catch (err) {
//     console.log(err);
//   }
// }

async function randomBlogs() {
  const credentials = btoa(`${randomBlogsUsername}:${randomBlogsPassword}`);

  try {
    const response = await fetch(api1, {
      headers: {
        Authorization: `Basic ${credentials}`,
      },
    });

    const json = await response.json();

    console.log(json);

    const randomIndex = Math.floor(Math.random() * json.length);
    const random = json[randomIndex];

    if (random.categories[0] == 26) {
      randomBlog.onclick = function () {
        window.location.href = "/html/blog.html?id=" + random.id;
      };
    } else {
      randomBlogs(); // retry if it doesn't match the category
    }
  } catch (err) {
    console.log(err);
  }
}

randomBlogs();
