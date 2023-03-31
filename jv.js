

function openWindow() {
    var myWindow = window.open("", "myWindow", "width=200,height=100");
    myWindow.document.write("<p>This is my window!</p>");
  }

  function loadPosts() {
    fetch(`https://kyo.ddns.net/posts?page=${pageNumber}&limit=5`)
        .then(response => response.json())
        .then(data => {
            data.forEach(post => {
                let postElement = document.createElement('div');
                postElement.innerText = post.title;
                postElement.setAttribute('id', `post-${post.id}`);
                postsContainer.appendChild(postElement);
            });
            pageNumber++;
        });
}