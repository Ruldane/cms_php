<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update a Category</label>

        <?php
        // update a category
        if (isset($_GET['update'])) {
            $cat_id_to_update = $_GET['update'];

            $query = "SELECT * FROM categories WHERE id = $cat_id_to_update";
            $find_category_id = $database->query($query);

            while ($row = mysqli_fetch_assoc($find_category_id)) {
                $cat_title =  $row['cat_title'];
                $cat_id =  $row['id'];
        ?>
        <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" type="text" name="cat_title_to_update" class="form-control" />
        <?php
            }
        }
        ?>
    </div>
    <?php
    if (isset($_POST['update_category'])) {
        $cat_title_to_update = $_POST['cat_title_to_update'];
        $query = "UPDATE categories  SET cat_title = '{$cat_title_to_update}' WHERE id = {$cat_id}";
        $update_category = $database->query($query);
        if (!$update_category) {
            die("Query failed");
        }
    }
    ?>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category" />
    </div>

</form>