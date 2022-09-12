<?php

function insert_categories()
{
    global $database;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo "<h1>This field should not be empty!</h1>";
        } else {
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUE('{$cat_title}')";
            $create_category_query = $database->query($query);
            if (!$create_category_query) {
                die("Error to insert category");
            }
        }
    };
}

function findAllcategories()
{
    // find all categories query
    global $database;
    $query = "SELECT * FROM categories";
    $select_all_categories = $database->query($query);

    while ($row = mysqli_fetch_assoc($select_all_categories)) {
        $cat_title =  $row['cat_title'];
        $cat_id =  $row['id'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
        echo "<td><a href='categories.php?update={$cat_id}'>UPDATE</a></td>";
        echo "<tr/>";
    }
}

function deleteCategory()
{
    global $database;
    if (isset($_GET['delete'])) {
        $cat_id_to_delete = $_GET['delete'];
        $query = "DELETE FROM categories WHERE id = {$cat_id_to_delete}";
        $delete_category = $database->query($query);
        header("Location: categories.php");
    }
}