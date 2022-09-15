<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_all_users = $database->query($query);

        while ($row = mysqli_fetch_assoc($select_all_users)) {
            $user_id =  $row['user_id'];
            $user_username =  $row['user_username'];
            $user_firstname =  $row['user_firstname'];
            $user_lastname =  $row['user_lastname'];
            $user_email =  $row['user_email'];
            $user_role =  $row['user_role'];
            $user_image =  $row['user_image'];
            //$user_date =  $row['user_date'];

            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $find_post_id = $database->query($query);

            // while ($row = mysqli_fetch_assoc($find_post_id)) {
            //     $post_title =  $row['post_title'];
            //     $post_id =  $row['post_id'];
            // }

            echo "<tr>
                <td>{$user_id}</td>
                <td>{$user_username}</td>
                <td>{$user_firstname}</td>
                <td>{$user_lastname}</td>
                <td>{$user_email}</td>
                <td>{$user_role}</td>
                <td><img width='100' alt='avatar' src='../images/{$user_image}'/></td>
                <td><a href='users.php?change_to_admin={$user_id}'>Change to Admin</a></td>   
                <td><a href='users.php?change_to_sub={$user_id}'>Change to Subscriber</a></td>
                <td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>
                <td><a href='users.php?delete={$user_id}'>Delete</a></td>
                
                </tr>";
        }
        ?>
    </tbody>
</table>

<?php

if (isset($_GET['change_to_sub'])) {
    $user_id_to_sub = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id_to_sub}";
    $database->query($query);
    header("Location: users.php");
}

if (isset($_GET['change_to_admin'])) {
    $user_id_to_admin = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id_to_admin}";
    $database->query($query);
    header("Location: users.php");
}

if (isset($_GET['delete'])) {
    $user_id_to_delete = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$user_id_to_delete}";
    $database->query($query);
    header("Location: users.php");
}

?>