<?php
if (isset($_POST['create_user'])) {

    $user_username =  $_POST['user_username'];
    $user_firstname =  $_POST['user_firstname'];
    $user_lastname =  $_POST['user_lastname'];
    $user_email =  $_POST['user_email'];
    $user_role =  $_POST['user_role'];
    $user_password =  $_POST['user_password'];
    $randSalt = 0;

    if (isset($_FILES['user_image'])) {
        $tmpName = $_FILES['user_image']['tmp_name'];
        $user_image = $_FILES['user_image']['name'];

        move_uploaded_file($tmpName, '../images/' . $user_image);
    }

    $query = "INSERT INTO users(user_username, user_firstname, user_lastname, user_email,user_role,user_image,user_password,randSalt) ";

    $query .= "VALUES('{$user_username}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}','{$user_image}','{$user_password}', '{$randSalt}') ";

    $create_category_query = $database->query($query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" class="form-control" name="user_username" />
    </div>
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" />
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" />
    </div>
    <div class="form-group">
        <label for="file">Image</label>
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email" />
    </div>

    <div class="form-group">
        <select name="user_role">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" />
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create User" />
    </div>
</form>