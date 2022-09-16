<?php
require_once("db.php");
session_start();

if (isset($_POST['login_user'])) {
    $user_username_form = $database->escape_string($_POST['user_username']);
    $user_password_form =  $database->escape_string($_POST['user_password']);

    $query = "SELECT * FROM users WHERE `user_username`= '{$user_username_form}' ";
    $select_user = $database->query($query);

    while ($row = mysqli_fetch_assoc($select_user)) {
        $user_username = $row['user_username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
        $user_id = $row['user_id'];
    }

    if ($user_username_form !== $user_username && $user_password_form !== $user_password) {
        header("Location: ../index.php");
    } else if ($user_username_form == $user_username && $user_password_form == $user_password) {
        $_SESSION['user_username'] = $user_username;
        $_SESSION['user_firstname'] = $user_firstname;
        $_SESSION['user_lastname'] = $user_lastname;
        $_SESSION['user_role'] = $user_role;
        $_SESSION['user_id'] = $user_id;
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}