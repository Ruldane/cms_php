<?php

if (isset($_GET['edit_user'])) {
    $user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $select_edit_user = $database->query($query);

    while ($row = mysqli_fetch_assoc($select_edit_user)) {
        $user_id =  $row['user_id'];
        $user_username =  $row['user_username'];
        $user_firstname =  $row['user_firstname'];
        $user_lastname =  $row['user_lastname'];
        $user_email =  $row['user_email'];
        $user_role =  $row['user_role'];
        $user_image =  $row['user_image'];
        $user_password =  $row['user_password'];
    }
}

if (isset($_POST['edit_user'])) {

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

        // if (empty($user_image)) {
        //     $query = "SELECT * FROM  'user_id' = {$user_id};";
        //     $select_image = $database->query($query);
        //     while ($row = mysqli_fetch_assoc($select_image)) {
        //         $user_image = $row['user_image'];
        //     }
        // }

        move_uploaded_file($tmpName, '../images/' . $user_image);
    }

    $queryUpdate = "UPDATE users SET ";
    $queryUpdate .=  "user_username = '{$user_username}',";
    $queryUpdate .=  "user_firstname = '{$user_firstname}', ";
    $queryUpdate .=  "user_lastname = '{$user_lastname}', ";
    $queryUpdate .=  "user_email = '{$user_email}', ";
    $queryUpdate .=  "user_role = '{$user_role}', ";
    $queryUpdate .=  "user_password = '{$user_password}', ";
    $queryUpdate .=  "user_image = '{$user_image}' ";
    $queryUpdate .=  "WHERE user_id = {$user_id} ";

    $edit_post = $database->query($queryUpdate);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" class="form-control" name="user_username" value="<?php echo $user_username; ?>" />
    </div>
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>" />
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>" />
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $user_image; ?>" alt="post image" />
    </div>
    <div class="form-group">
        <label for="file">Image</label>
        <input type="file" name="user_image" value="<?php echo $user_image; ?>">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>" />
    </div>

    <div class=" form-group">
        <select name="user_role">
            <option value="subscriber"><?php echo $user_role; ?></option>
            <?php
            if ($user_role == 'admin') {
                "echo <option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>Admin</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>" />
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User" />
    </div>
</form>