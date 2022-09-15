<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
        $select_all_posts = $database->query($query);

        while ($row = mysqli_fetch_assoc($select_all_posts)) {
            $post_title =  $row['post_title'];
            $post_id =  $row['post_id'];
            $post_category_id =  $row['post_category_id'];
            $post_author =  $row['post_author'];
            $post_date =  $row['post_date'];
            $post_image =  $row['post_image'];
            $post_content =  $row['post_content'];
            $post_tags =  $row['post_tags'];
            $post_comment_count =  $row['post_comment_count'];
            $post_status =  $row['post_status'];

            $query = "SELECT * FROM categories WHERE id = $post_category_id";
            $find_category_id = $database->query($query);

            while ($row = mysqli_fetch_assoc($find_category_id)) {
                $cat_title =  $row['cat_title'];
                $cat_id =  $row['id'];
            }

            echo "<tr>
                <td>{$post_id}</td>
                <td>{$post_author}</td>
                <td>{$post_title}</td>
                <td>{$cat_title}</td>
                <td>{$post_status}</td>
                <td><img width='100' src='../images/{$post_image}' alt='post_image'/></td>
                <td>{$post_tags}</td>
                <td>{$post_comment_count}</td>
                <td>{$post_date}</td>
                <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>
                <td><a href='posts.php?delete={$post_id}'>Delete</a></td>
                </tr>";
        }
        ?>
    </tbody>
</table>

<?php

if (isset($_GET['delete'])) {
    $post_id_to_delete = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete}";
    $database->query($query);
}

?>