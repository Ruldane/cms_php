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
                        <?php insert_categories(); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category" />
                            </div>
                        </form>
                        <?php
                        // update and include query category
                        if (isset($_GET['update'])) {
                            // $cat_id = $_GET['update'];
                            require_once('includes/update_category.php');
                        }
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                findAllcategories();
                                ?>

                                <?php
                                // delete categorie select
                                deleteCategory();
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("includes/admin_footer.php"); ?>