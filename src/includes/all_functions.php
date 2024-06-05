<?php
    function getPublishedPosts(){
        global $conn;
        $sql = "SELECT * FROM posts WHERE published=1";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // tableau associatif des posts publiés
    }
?>