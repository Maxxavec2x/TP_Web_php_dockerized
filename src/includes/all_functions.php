<?php
    function getPublishedPosts(){
        global $conn;
        $sql = "SELECT * FROM posts WHERE published=1";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // tableau associatif des posts publiés
    }

    function getPostTopic($post_id) {
        global $conn;
        $sql = "SELECT * FROM topics WHERE id=(SELECT topic_id from post_topic WHERE post_id=$post_id;)";
        $topic = mysqli_query($conn, $sql);
        return $topic;
    }






?>