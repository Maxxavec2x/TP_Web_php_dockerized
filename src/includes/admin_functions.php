<?php
//--------
// Admin user variables
$admin_id = 0;
$isEditingUser = false;
$username = "";
$email = "";
// Topics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";
// general variables
$errors = [];
/* - - - - - - - - - -
- Admin users actions
- - - - - - - - - - -*/
// if user clicks the create admin button
if (isset($_POST['create_admin'])) {
    createAdmin($_POST); //TODO
}
//-----------------


function getAdminRoles() {
    global $conn;
    $sql = "SELECT * from roles WHERE name = 'Admin' OR name = 'Author';";
    $result = mysqli_query($conn, $sql);
    $AdminRole = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $AdminRole;
}

function getAdminUsers() {
    global $conn;
    $sql = "SELECT * from users WHERE role = 'Admin' OR role = 'Author';";
    $result = mysqli_query($conn, $sql);
    $AdminUsers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $AdminUsers;
}

/* * * * * * * * * * * * * * * * * * * * * * *
* - Receives new admin data from form
* - Create new admin user
* - Returns all admin users with their roles
* * * * * * * * * * * * * * * * * * * * * * */
function createAdmin($request_values){ 
    global $conn, $errors, $username, $email;
    $username = $request_values['username'];
    $email = $request_values['email'];
    $password = $request_values['password'];
    
    var_dump($username);
    if ($request_values['role_id'] == 1) {
        $role = 'Admin';
        var_dump("Le role id est " . $role);
    }
    else {
        $role = 'Author';
    }
    if (empty($errors)) { //test si il existe déjà
        $sql = "SELECT * FROM users WHERE username='$username' and email='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            // add user into database
            $password = md5($password); // encrypt password
            $sql = "INSERT INTO users (username, email, role, password) VALUES ('$username', '$email', '$role', '$password')";
            $result = mysqli_query($conn, $sql);
        } else {
            array_push($errors, 'User already exist');
        }
    }


    $_SESSION['message'] = "Admin user created successfully";
    header('location: users.php');
    exit(0);
    }

?>