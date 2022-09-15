<?php require_once("includes/admin_header.php") ?>

<div id="wrapper">
    <?php require_once("includes/admin_navigation.php") ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h1 class="page-header">
                    Welcome to admin!
                    <small>All posts</small>
                </h1>
                <?php
                if (isset($_GET['source'])) {
                    $source = $_GET['source'];
                } else {
                    $source = "";
                }
                switch ($source) {
                    case 'add_user':
                        require_once("includes/add_user.php");
                        break;
                    case 'edit_user':
                        require_once("includes/edit_user.php");
                        break;
                    default:
                        require_once('includes/view_all_users.php');
                        break;
                }
                ?>
            </div>
        </div>
    </div>

    <?php require_once("includes/admin_footer.php"); ?>