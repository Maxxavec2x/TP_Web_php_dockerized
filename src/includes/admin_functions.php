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
//createAdmin($_POST); //TODO
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

?>