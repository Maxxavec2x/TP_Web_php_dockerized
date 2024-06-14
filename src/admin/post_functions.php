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
$topic_id = "";

// if user clicks the create admin button
if (isset($_POST['create_post'])) {
    createPost($_POST);
}

if (isset($_POST['update_post'])) {
    updatePost($_POST);
}

if (isset($_GET['unpublish'])) {
    togglePublishPost($_GET['unpublish'], "Toggle published state on post");
}

if (isset($_GET['delete-post'])) {
    deletePost($_GET['delete-post']);
}

if (isset($_GET['edit-post'])){
    editPost(($_GET['edit-post']));
}

if (isset($_POST['update_post'])){
    updatePost($_POST['update_post']);
}
//-----------------

/* - - - - - - - - - -
- Post functions
- - - - - - - - - - -*/

function uploadImage() {
    $uploads_dir = ROOT_PATH . '/static/images';
    $error = $_FILES["featured_image"]['error'];
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["featured_image"]["tmp_name"];
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = basename($_FILES["featured_image"]["name"]);
            if (move_uploaded_file($tmp_name, "$uploads_dir/$name"));
            echo "IMAGE UPLOADE";
        }
}

// get all posts from WEBLOG DATABASE
function getAllPosts() {
    global $conn;
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC); // tableau associatif des posts publiés
    foreach ($posts as &$post) {
        $post['author'] = getPostAuthorById($post['user_id']);
    }
    return $posts;
}

function getCurrentuserID() {
    global $conn;
    $username = $_SESSION['user']['username'];
    $sql = "SELECT id from users where username='$username';";
    $result = mysqli_query($conn, $sql);
    $id = mysqli_fetch_assoc($result);
    return $id;
}



function updateTablePostTopic($post_id, $topic_id) { //TODO ajouter l'auto incrémentation de user_topic
    global $conn;
    $newId = getMaxIDFromTable('post_topic') + 1;
    $sql =  "INSERT INTO `post_topic` (`id`, `post_id`, `topic_id`) 
    VALUES ($newId, $post_id, '$topic_id');";
    if ($result = mysqli_query($conn, $sql)) {
        echo "table post_topic updated";
        return 1;
    }
    return 0;
}

function getPostID($title) {
    global $conn;
    $sql = "SELECT id from posts where title='$title';";
    $result = mysqli_query($conn, $sql);
    $id = mysqli_fetch_assoc($result);
    return $id;
}

function createPost($request_values) {
    global $conn, $errors, $title, $featured_image, $topic_id, $body, $published;

    $title = $request_values['title'];
    $image = $_FILES;
    $featured_image = $image['featured_image']['name'];
    if (isset($request_values['topic_id'])) {
        $topic_id = $request_values['topic_id'];
    }

    $body = $request_values['body'];
    $published = 1; //1 for test
    $slug = createSlug($title);
    $currentDate = date("Y-m-d H:i:s");
    $user_id = getCurrentuserID()['id'];

    if (empty($title) ) {
        array_push($errors, 'No title entered');
    }
    if (empty($body) ) {
        array_push($errors, 'No body entered');
    }
    if (empty($topic_id) ) {
        array_push($errors, 'No topic entered');
    }
    if (empty($featured_image) ) {
        array_push($errors, 'No image entered');
    }

    if (empty($errors)) {

    // ^ Je sais que c'est dégueulasse, mais t'avais qu'a le faire 😎
    $sql = "INSERT INTO `posts` (`user_id`, `title`, `slug`, `image`, `body`, `published`, `views`, `created_at`, `updated_at`) 
    VALUES ($user_id, '$title', '$slug', '$featured_image', '$body', $published, 0, '$currentDate', '$currentDate');";
    //todo recup user id avec requete sql
    if ($result = mysqli_query($conn, $sql)) {
        $post_id = getPostID($title)['id'];
        if (updateTablePostTopic($post_id, $topic_id)) {
            uploadImage();
            $_SESSION['message'] = "Post created successfully";
            header('location: posts.php');
            exit(0);
        }
    }
    }
    $_SESSION['message'] = "Erreur : Post not created";
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
    $sql = "SELECT title, slug, body FROM posts WHERE id='$role_id'";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $result = $result[0];
    $title = $result['title'];
    $post_slug = $result['slug'];
    $body = $result['body'];
    $isEditingPost = true;
    $post_id = $role_id;
}

function updatePost($request_values) {
    global $conn, $errors, $post_id, $title, $featured_image, $topic_id, $body, $published, $isEditingPost;
    $title = $request_values['title'];
    $image = $_FILES;
    $featured_image = $image['featured_image']['name'];
    $topic_id = $request_values['topic_id'];
    $body = $request_values['body'];
    $post_id = $request_values['post_id'];

    if (empty($title) ) {
        array_push($errors, 'No title entered');
    }
    if (empty($body) ) {
        array_push($errors, 'No body entered');
    }
    if (empty($topic_id) ) {
        array_push($errors, 'No topic entered');
    }
    if (empty($featured_image) ) {
        array_push($errors, 'No image entered');
    }
    // Upadate SQL
    if (empty($errors)) {
        $sql = "UPDATE posts SET title='$title', image='$featured_image', body='$body' WHERE id='$post_id'";
        if (mysqli_query($conn, $sql) and updateTablePostTopic($post_id, $topic_id)) {
            $_SESSION['message'] = "Post updated successfully";
            $isEditingPost = false;
            header('location: posts.php');
        } else {
            array_push($errors, 'SQL error');
        }
    }
    exit(0);

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