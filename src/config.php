<?php
//Create session per user:
session_start();

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');


define('DB_NAME', 'weblog');
define('DB_USER', 'root');
define('DB_PASS', 'root');

// connect to database
//print(DB_HOST);
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// var_dump($conn);


// $result = mysqli_query($conn, "SHOW TABLES");
// if ($result) {
//     while ($row = mysqli_fetch_array($result)) {
//         echo $row[0] . "<br>";
//     }
// } else {
//     echo "Erreur lors de la récupération des tables : " . mysqli_error($conn);
// }

//define some constants:
define('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost:2024/');

