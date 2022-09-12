<?php require_once("includes/header.php") ?>

<div id="wrapper">
    <?php require_once("includes/navigation.php") ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin!
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">
                        <form action="">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("includes/footer.php"); ?>