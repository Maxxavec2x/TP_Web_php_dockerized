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
        $query = "SELECT * FROM topics WHERE id=(SELECT topic_id from post_topic WHERE post_id=?);";
        if ($stmt = mysqli_prepare($conn, $query)){
            mysqli_stmt_bind_param($stmt, 's', $post_id);
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                return mysqli_fetch_assoc($result);
            }
        }
    }

    function getPost($slug) {
        global $conn;
        $query = "SELECT * FROM posts WHERE slug=?;";
        if ($stmt = mysqli_prepare($conn, $query)){
            mysqli_stmt_bind_param($stmt, 's', $slug);
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                $post = mysqli_fetch_assoc($result);
                $post['topic'] = getPostTopic($post['id']);
                //var_dump($post);
                return $post;
            }
        }        
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
        $query = "SELECT posts.id, posts.title, posts.slug, posts.image, posts.body, posts.updated_at
         FROM posts JOIN post_topic ON posts.id = post_topic.post_id 
         WHERE published=1 and post_topic.topic_id=?;";
        if ($stmt = mysqli_prepare($conn, $query)){
            mysqli_stmt_bind_param($stmt, 'i', $topic_id);
            if (mysqli_stmt_execute($stmt)){
                $final_posts = array();
                $result = mysqli_stmt_get_result($stmt);
                while ($post = mysqli_fetch_assoc($result)){
                    $post['topic'] = getPostTopic($post['id']);
                    array_push($final_posts, $post);
                }
                return $final_posts;
            }
        }
        
    }

    function getMaxIDFromTable($tableName) { 
        global $conn;
        $query = "SELECT MAX(id) FROM $tableName";
        $result = mysqli_query($conn,  $query);
        $row = mysqli_fetch_row($result);
        return $row[0];
    }


?>