<?php

/*--------------------
post_functions.php
------------------------*/

$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";
$post_topic = "";

/* - - - - - - - - - -
- Post functions
- - - - - - - - - - -*/

// get all posts from WEBLOG DATABASE
function getAllPosts() {
    global $conn;
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC); // tableau associatif des posts publiés
    foreach ($posts as &$post) {
        $post['author'] = getPostAuthorById($post['id']);
    }
   // var_dump($posts);
    return $posts;
}

function createPost($request_values) {
    global $conn, $errors, $title, $featured_image, $topic_id, $body, $published;
}

// get the author/username of a post
function getPostAuthorById($user_id) {
    global $conn;
    $sql = "SELECT username FROM users WHERE id=$user_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // return username
        return mysqli_fetch_assoc($result)['username'];
    } else {
        return null;
    }
}

function editPost($role_id) {
    global $conn, $title, $post_slug, $body, $isEditingPost, $post_id;
}

function updatePost($request_values) {
    global $conn, $errors, $post_id, $title, $featured_image, $topic_id, $body, $published;
}

// delete blog post
function deletePost($post_id) {
    global $conn;
    $sql = "DELETE FROM posts WHERE id=$post_id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Post successfully deleted";
        header("location: posts.php");
        exit(0);
    }
}

// toggle blog post: published↔unpublished
function togglePublishPost($post_id, $message) {
    global $conn;
    $sql = "UPDATE posts SET published=!published WHERE id=$post_id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = $message;
        header("location: posts.php");
        exit(0);
    }
}
?>