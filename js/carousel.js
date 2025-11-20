const latestDivs = document.querySelector("#latestDivs");
const arrowLeft = document.querySelector("#arrowLeft");
const arrowRight = document.querySelector("#arrowRight");

arrowLeft.onclick = function () {
  latestDivs.scrollLeft -= 250;
};

arrowRight.onclick = function () {
  latestDivs.scrollLeft += 250;
};

const blogsDiv = document.querySelector("#blogsDiv");
const loading = document.querySelector("#loading");
const api =
  "https://karlmagnusnokling.no/haley/wp-json/wp/v2/posts?categories=26&per_page=100&_embed";

// const username = process.env.REACT_APP_USERNAME;
// const password = process.env.REACT_APP_PASSWORD;

const carouselUsername = "haleyspappa";
const carouselPassword = "unifacts";

// async function fetchBlogs() {
//   try {
//     const response = await fetch(api);
//     const json = await response.json();

//     console.dir(json);

//     loading.classList.remove("loading");

//     json.forEach(function (carousel) {
//       if (carousel.categories[0] == 26) {
//         latestDivs.innerHTML += `
//             <a href="/html/blog.html?id=${carousel.id}" class="latestCard">
//                 <img class="latestImg" src="${carousel._embedded["wp:featuredmedia"][0].source_url} "alt="${carousel._embedded["wp:featuredmedia"][0].alt_text}/>
//                 <h3 class="latestTitle">${carousel.excerpt.rendered}</h3>
//             </a>
//         `;
//       }
//     });
//   } catch (err) {
//     loading.classList.remove("loading");
//     blogsDiv.classList.add("error");
//     blogsDiv.innerHTML = "There was an error!";
//     console.log(err);
//   }
// }

async function fetchBlogs() {
  const credentials = btoa(`${carouselUsername}:${carouselPassword}`);

  try {
    const response = await fetch(api, {
      headers: {
        Authorization: `Basic ${credentials}`,
      },
    });

    const json = await response.json();

    console.dir(json);

    loading.classList.remove("loading");

    json.forEach(function (carousel) {
      if (carousel.categories[0] == 26) {
        latestDivs.innerHTML += `
          <a href="/html/blog.html?id=${carousel.id}" class="latestCard">
            <img class="latestImg" src="${carousel._embedded["wp:featuredmedia"][0].source_url}" alt="${carousel._embedded["wp:featuredmedia"][0].alt_text}"/>
            <h3 class="latestTitle">${carousel.excerpt.rendered}</h3>
          </a>
        `;
      }
    });
  } catch (err) {
    loading.classList.remove("loading");
    blogsDiv.classList.add("error");
    blogsDiv.innerHTML = "There was an error!";
    console.log(err);
  }
}

fetchBlogs();
