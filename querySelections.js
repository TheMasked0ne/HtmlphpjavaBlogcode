const addPostEndpoint = '/addPost';
const getPostsEndpoint = '/getPosts';

// Function to fetch posts and add them to the page
function fetchAndDisplayPosts() {
    // Assuming you have a function to fetch posts, replace this with your actual implementation
    const posts = fetchPostsFromServer();

    let blogPosts = document.querySelector('#blog-posts');
    
    // Clear existing posts
    blogPosts.innerHTML = '';

    for (let post of posts) {
        let postElement = document.createElement('div');
        postElement.innerHTML = `
            <h2>${post.title}</h2>
            <p>${post.content}</p>
        `;
        blogPosts.appendChild(postElement);
    }
}

// Call the fetchAndDisplayPosts function when the page loads
document.addEventListener('DOMContentLoaded', fetchAndDisplayPosts);

document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault();

    // Get input values
    const title = document.querySelector('input[name="title"]').value;
    const content = document.querySelector('textarea[name="content"]').value;

    // Validate inputs
    if (!title || !content) {
        alert('Please enter both title and content.');
        return;
    }

    // Send a POST request to add the new post
    fetch(addPostEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ title, content }),
    })
    .then(response => {
        if (response.ok) {
            // If the request was successful, fetch and display posts again
            return fetchAndDisplayPosts();
        } else {
            alert('Failed to add the post. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error adding post:', error);
        alert('Failed to add the post. Please try again.');
    });

    // Clear the form
    document.querySelector('form').reset();
});

// Example function to fetch posts from the server
function fetchPostsFromServer() {
    // Replace this with your actual implementation
    return [
        { title: 'Post 1', content: 'Content 1' },
        { title: 'Post 2', content: 'Content 2' },
        // Add more posts as needed
    ];
}
