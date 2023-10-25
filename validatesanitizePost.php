<?php
    $host = 'localhost';
    $dbname = 'my_database';
    $username = 'my_username';
    $password = 'my_password';
      try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
      }
      // Get pagination and search parameters from query string
      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
      $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
      $search = isset($_GET['search']) ? $_GET['search'] : '';
      // Validate user input
      $title = $_POST['title'];
      $content = $_POST['content'];
    if (empty($title) || empty($content)) {
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Title and content are required.'));
      } else {
      // Sanitize user input
      $title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS);
      $content = filter_var($content, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        // Handle POST request to add new post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Insert post into database
          $stmt = $db->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)');
          $stmt->bindParam(':title', $title);
          $stmt->bindParam(':content', $content);
          $stmt->execute();
         // Return success message
          http_response_code(200); // OK
          echo json_encode(array('message' => 'Post added successfully.'));
        }
        // Handle GET request to fetch posts with pagination and search filter
        $offset = ($page - 1) * $limit;
        $stmt = $db->prepare('SELECT * FROM posts WHERE title LIKE :search OR content LIKE :search LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Return posts as JSON
        header('Content-Type: application/json');
        echo json_encode($posts);
      }
      // Handle PUT request to edit post
      if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        // Get post ID from URL parameter
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if (!$id) {
          http_response_code(400); // Bad Request
          echo json_encode(array('error' => 'Post ID is required.'));
        } else {
          // Update post in database
          $stmt = $db->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
          $stmt->bindParam(':title', $title);
          $stmt->bindParam(':content', $content);
          $stmt->bindParam(':id', $id);
          $stmt->execute();
          // Return success message
          http_response_code(200); // OK
          echo json_encode(array('message' => 'Post updated successfully.'));
        }
      }
      // Handle DELETE request to delete post
      if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Get post ID from URL parameter
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if (!$id) {
          http_response_code(400); // Bad Request
          echo json_encode(array('error' => 'Post ID is required.'));
        } else {
          // Delete post from database
          $stmt = $db->prepare('DELETE FROM posts WHERE id = :id');
          $stmt->bindParam(':id', $id);
          $stmt->execute();
          // Return success message
          http_response_code(200); // OK
          echo json_encode(array('message' => 'Post deleted successfully.'));
        }
      }
    ?>
    </script>
    </body>
    </html>


