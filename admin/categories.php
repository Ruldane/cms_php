<?php require_once("includes/admin_header.php") ?>

<div id="wrapper">
    <?php require_once("includes/admin_navigation.php") ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin!
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php if (isset($_POST['submit'])) {
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
                        }; ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category" />
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        $query = "SELECT * FROM categories";
                        $select_all_categories = $database->query($query);
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($select_all_categories)) {
                                    $cat_title =  $row['cat_title'];
                                    $cat_id =  $row['id'];
                                    echo "<tr>";
                                    echo "<td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";
                                    echo "<tr/>";
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("includes/admin_footer.php"); ?>