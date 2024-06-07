<?php
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

    function getPostTopic($post_id) {
        global $conn;
        $sql = "SELECT * FROM topics WHERE id=(SELECT topic_id from post_topic WHERE post_id=$post_id);";
        $topic = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($topic);;
    }

    function getPost($slug) {
        global $conn;
        $sql = "SELECT * FROM posts WHERE slug='$slug';";
        $result = mysqli_query($conn, $sql);
        $post = mysqli_fetch_assoc($result);
        $post['topic'] = getPostTopic($post['id'])['name'];
        return $post;
}

function getAllTopics() {
    global $conn;
    $sql="SELECT * FROM topics;";
    $result = mysqli_query($conn, $sql);
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC); // tableau associatif des posts publiés
    return $topics ;
}

?>