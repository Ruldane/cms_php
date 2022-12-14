<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to </th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM comments";
        $select_all_comments = $database->query($query);

        while ($row = mysqli_fetch_assoc($select_all_comments)) {
            $comment_post_id =  $row['comment_post_id'];
            $comment_id =  $row['comment_id'];
            $comment_content =  $row['comment_content'];
            $comment_email =  $row['comment_email'];
            $comment_author =  $row['comment_author'];
            $comment_status =  $row['comment_status'];
            $comment_date =  $row['comment_date'];

            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $find_post_id = $database->query($query);

            while ($row = mysqli_fetch_assoc($find_post_id)) {
                $post_title =  $row['post_title'];
                $post_id =  $row['post_id'];
            }

            echo "<tr>
                <td>{$comment_post_id}</td>
                <td>{$comment_author}</td>
                <td>{$comment_content}</td>
                <td>{$comment_email}</td>
                <td>{$comment_status}</td>
                <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>
                <td>{$comment_date}</td>
                <td><a href='comments.php?approve={$comment_id}'>Approve</a></td>
                <td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>
                <td><a href='comments.php?delete={$comment_id}'>Delete</a></td>
                </tr>";
        }
        ?>
    </tbody>
</table>

<?php

if (isset($_GET['approve'])) {
    $comment_id_to_unapprove = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id_to_unapprove}";
    $database->query($query);
    header("Location: comments.php");
}

if (isset($_GET['unapprove'])) {
    $comment_id_to_unapprove = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$comment_id_to_unapprove}";
    $database->query($query);
    header("Location: comments.php");
}

if (isset($_GET['delete'])) {
    $comment_id_to_delete = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$comment_id_to_delete}";
    $database->query($query);
    header("Location: comments.php");
}

?>