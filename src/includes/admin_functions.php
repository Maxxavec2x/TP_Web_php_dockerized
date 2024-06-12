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
    createAdmin($_POST);
}
if (isset($_GET['edit-admin'])) {
    editAdmin($_GET['edit-admin']);
}
if (isset($_POST['update_admin'])) {
    updateAdmin($_POST);
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
    $passwordConfirmation = $request_values['passwordConfirmation'];
    if ($request_values['role_id'] == 1) {
        $role = 'Admin';
    }
    else if ($request_values['role_id'] == 2){
        $role = 'Author';
    }
    else{
        array_push($errors, 'No role entered');
    }

    if ($password != $passwordConfirmation){
        array_push($errors, 'User already exist');
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
            exit(0);
        }
    }
    $_SESSION['message'] = "Admin user created successfully";
    header('location: users.php');
    exit(0);
    }

/* * * * * * * * * * * * * * * * * * * * *
* - Takes admin id as parameter
* - Fetches the admin from database
* - sets admin fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editAdmin($admin_Id){
    global $conn, $username, $isEditingUser, $email, $admin_id;
    $admin_id = $admin_Id;
    $sql = "SELECT username, email from users WHERE id='$admin_id';";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $username = $user[0]['username'];
    $email = $user[0]['email'];
    $isEditingUser = true;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* - Receives admin request from form and updates in database
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updateAdmin($request_values){
    global $conn, $errors, $username, $isEditingUser, $admin_id, $email;
    // Get all informations
    $username = $request_values['username'];
    $email = $request_values['email'];
    $password = $request_values['password'];
    $passwordConfirmation = $request_values['passwordConfirmation'];
    $admin_id = $request_values['admin_id'];
    if ($request_values['role_id'] == 1) {
        $role = 'Admin';
    }
    else if ($request_values['role_id'] == 2){
        $role = 'Author';
    }
    else{
        array_push($errors, 'No role entered');
    }

    if ($password != $passwordConfirmation){
        array_push($errors, 'User already exist');
    }

    // Upadate SQL
    if (empty($errors)) {
        $password = md5($password);
        $sql = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id='$admin_id'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Admin user updated successfully";
            $isEditingUser = false;
            header('location: users.php');
        } else {
            array_push($errors, 'SQL error');
        }
    }
    exit(0);
}

?>