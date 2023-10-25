    This is document will be the Html, Php, CSS, and Javascript breakdown that I plan on
    working on:

"Working on what?" asked the void.

    Well I am glad you asked! It will be a home base, fortress, or tomb if unlucky.
Its to be a blog really, but "blog" sounds so.. predictable. As It should im sure, and
yet still feels pretentious calling it as such. Still, in spite of this, here we are.
Its a challenge I pose to myself for myself and if not then, possibly even more selfish,
so I can display my interests, along with the occasional analysis or research paper or
miscellaneous findings. The final and most important reason is to learn to code properly,
and to put what I know already and attempt to become a bilingual in the previously listed
computer languages.

I plan on adding to this file as I go through the creation process. Documenting
the building process to not only make it convenient to understand. Prevention,
should find my self in the predicament of not remembering why did something. Witch
Im positive will happen, I also am going to be using this do document mistakes made
along the way for the simple reason being somethings need to be adressed when creating
anything and if I cannot confront my own mistakes it will absolutely be my undoing.
With all this said Html is a good start.

-------------------------------------------------------[HTML Blog Code Breakdown]--------------------------------------

    So standard html we have the "<!DOCTYPE: HTML>" witch really just declares the file for the
computer (basically, for read ability) as "<Document type: HTML>". In short Html begins with
<html> and ends </html> everything visual is between <body> and </body>. for any one reader
who happens to read this other than me, that html statement will make sense later on.

[The first version of the code that is even worth talking about looked like this.]

<!DOCTYPE html><html>
  <head>
    <title>The Giraffe Memo</title>
  </head>
  <body>
    <h1>The Woes Stolen Christmas Blog</h1>
    <div id="blog-posts">  <!-- Posts will be added here -->
    </div>
    <form action="addPost.php" method="post">
      <input type="text" name="title" placeholder="Title">
      <textarea name="content" placeholder="Content"></textarea>
      <input type="submit" value="Add Post">
    </form>
    <script>
      // Fetch posts from server and add them to the page
      fetch('getPosts.php')
        .then(response => response.json())
        .then(posts => {
          let blogPosts = document.querySelector('#blog-posts');
          for (let post of posts) {
            let postElement = document.createElement('div');
            postElement.innerHTML = `
              <h2>${post.title}</h2>
              <p>${post.content}</p>
            `;
            blogPosts.appendChild(postElement);
          }
        });
    </script>
  </body>
</html>

[The next is the Html code with light but notable changes.]

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TheGiraffeMemoBlog.com</title>
</head>

<body>
  <h1>TheGiraffeMemoBlog.com</h1>
  <h2>I stuck my neck out.</h2>
  <div id="blog-posts">
    <!-- Posts will be added here -->
  </div>
  <form action="addPost.php" method="post">
    <input type="text" name="title" placeholder="Title">
    <textarea name="content" placeholder="Content"></textarea>
    <input type="submit" value="Add Post">
  </form>

  <script>
    // Fetch posts from server and add them to the page
    fetch('getPosts.php')
      .then(response => response.json())
      .then(posts => {
        let blogPosts = document.querySelector('#blog-posts');
        for (let post of posts) {
          let postElement = document.createElement('div');
          postElement.innerHTML = `
            <h2>${post.title}</h2>
            <p>${post.content}</p>
          `;
          blogPosts.appendChild(postElement);
        }
      });
  </script>
</body>

</html>

  To start we can look at the "<head>" declaration(s) element(s) made in this deceivingly important tag. In the
old copy we have the the "<title>" placed here as to indicate the head of my code is "TheGiraffeMemoblog.com"
while this isn't necessarily wrong, but there is always a multitude of and more efficeint way of doing some one-thing.
The inferiorities of the old, replaced with the updates of the new. Well, for one as opposed to the predecessor
the only thing held with in it being the "<title>". Later on I realized that there is a recommended minimum
of elements essential for the proper development of any website as well as an application. As I previously said
this isn't necessarily wrong, but it is missing something(s), that something(s) being "meta-charset" and 'meta name
="viewpoint"'. Meta charset defines the encoding of a website, and utf-8 is the current standard. Meta name ="veiwport",
veiwport being the settings related to the mobile responsiveness, typically followed by "width=device-width" and
followed by "initial-scale=1, these control the use of width of a device as well as the initial zoom, 1 means no zoom.
I recommend visiting https://htmlhead.dev/ , A project by Josh Buchea - https://hachyderm.io/@joshbuchea , a repository.
it houses a plethora of knowledge on the subject of the "<head>"and the expansive elements to compliment any html
related subject of your future works.



