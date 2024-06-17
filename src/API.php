<?php
header('Content-Type: application/json');

// Inclure le fichier de configuration de la base de données
include('config.php');

// Fonction pour obtenir les sujets des posts
function getPostTopic($post_id) {
    global $conn;
    $sql = "SELECT * FROM topics WHERE id=(SELECT topic_id from post_topic WHERE post_id=$post_id);";
    $topic = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($topic);
}

// Fonction pour obtenir les posts publiés
function getPublishedPosts(){
    global $conn;
    $sql = "SELECT * FROM posts WHERE published=1";
    $result = mysqli_query($conn, $sql);
    $publishedPosts = mysqli_fetch_all($result, MYSQLI_ASSOC); // tableau associatif des posts publiés
    foreach ($publishedPosts as &$post) {
        $post['topic'] = getPostTopic($post['id'])['name'];
    }
    return $publishedPosts;
}

// Vérifier le type de requête
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $posts = getPublishedPosts();
    echo json_encode($posts);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
