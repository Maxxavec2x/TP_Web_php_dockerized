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

 /**
* This function returns the name and slug of a
* category  in an array <- quand il dit category je pense qu'il veut dire topic 🤓 ptdr
*/
function getPublishedPostsByTopic($topic_id) {
    global $conn;
    $sql = "SELECT * FROM posts WHERE published=1 and id=(SELECT id FROM post_topic WHERE topic_id=$topic_id);";
    $result = mysqli_query($conn, $sql);
    // fetch all posts as an associative array called $posts
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $final_posts = array();
    foreach ($posts as $post) {
    $post['topic'] = getPostTopic($post['id']);
    array_push($final_posts, $post);
    }
    return $final_posts;
    }

    function getMaxIDFromTable($tableName) { 
        global $conn;
        $query = "SELECT MAX(id) FROM $tableName";
        $result = mysqli_query($conn,  $query);
        $row = mysqli_fetch_row($result);
        return $row[0];
    }


?>