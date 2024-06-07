<?php
//include('../../config.php');
// variable declaration
$username = "";
$email = "";
$errors = array();
// LOG USER IN
if (isset($_POST['login_btn'])) {
    $username = esc($_POST['username']); // esc sinon matthieu ' OR '1' = '1
    $password = esc($_POST['password']); // esc
    if (empty($username)) {
        array_push($errors, "Username required");
    }
    if (empty($password)) {
        array_push($errors, "Password required");
    }
    if (empty($errors)) {
        $password = md5($password); // encrypt password
        //var_dump($password);
        $sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // get id of created user
            $reg_user_id = mysqli_fetch_assoc($result)['id'];
            //var_dump(getUserById($reg_user_id)); die();
            // put logged in user into session array
            $_SESSION['user'] = getUserById($reg_user_id);
            //var_dump($_SESSION['user'] );
            // if user is admin, redirect to admin area
            if (in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
                $_SESSION['message'] = "You are now logged in";
                //print("C BON TU EST CONNECTE EN ADMIN \n");
                // redirect to admin area
                header('location: ' . BASE_URL . '/admin/dashboard.php');
                exit(0);
            } else {
                $_SESSION['message'] = "You are now logged in";
               // print("C BON TU EST CONNECTE EN USER \n");
                // redirect to public area
                header('location: index.php');
                exit(0);
            }
        } else {
            array_push($errors, 'Wrong credentials');
        }
    }
}

// REGISTER
// TODO
if (isset($_POST['register_btn'])) {
    $username = ($_POST['username']); // esc
    $mail = ($_POST['mail']);
    $password = ($_POST['password']); // esc
    $password2 = ($_POST['password2']);
    if (empty($username)) {
        array_push($errors, "Username required");
    }
    if (empty($mail)) {
        array_push($errors, "Mail required");
    }
    if (empty($password) || empty($password2)) {
        array_push($errors, "Two password entry required");
    }
    if ($password != $password2){
        array_push($errors, "Passwords doesn't matched");
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE username='$username' and email='$mail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            // add user into database
            $password = md5($password); // encrypt password
            $sql = "INSERT INTO users (username, email, role, password) VALUES ('$username', '$mail', 'Author', '$password')";
            $result = mysqli_query($conn, $sql);
            $reg_id = mysqli_insert_id($conn);
            $_SESSION['user'] = getUserById($reg_id);
            // if user is admin, redirect to admin area
            if ($_SESSION['user']['role'] == "Admin") {
                $_SESSION['message'] = "You are now logged in";
                //print("C BON TU EST CONNECTE EN ADMIN \n");
                // redirect to admin area
                header('location: ' . BASE_URL . '/admin/dashboard.php');
                exit(0);
            } if ($_SESSION['user']['role'] == "Author"){
                $_SESSION['message'] = "You are now logged in";
               // print("C BON TU EST CONNECTE EN USER \n");
                // redirect to public area
                header('location: index.php');
                exit(0);
            }
        } else {
            array_push($errors, 'User already exist');
        }
    }
}


// Get user info from user id
function getUserById($id)
{
    global $conn; // rendre disponible, à cette fonction, la variable de connexion $conn
    $sql ="SELECT username, role FROM users WHERE id = " . $id . " LIMIT 1;"; // requête qui récupère le user et son rôle
    $result = mysqli_query($conn, $sql); // la fonction php-mysql
    $user = mysqli_fetch_assoc($result); // mettre $result au format associatif pour un seul résultat
    return $user;
}
// escape value from form
function esc(String $value)
{
    // bring the global db connect object into function
    global $conn;
    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);
    return $val;
}

