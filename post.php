<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <?php
                require_once('includes/db.php');
                require_once("includes/header.php");
                require_once("includes/navigation.php")

                ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8">

                            <?php

                            if (isset($_GET['p_id'])) {
                                $post_id = $_GET['p_id'];


                                $query = "SELECT * FROM posts WHERE post_id = $post_id ";
                                $select_all_posts = $database->query($query);
                                while ($row = mysqli_fetch_assoc($select_all_posts)) {
                                    $post_title =  $row['post_title'];
                                    $post_author =  $row['post_author'];
                                    $post_date =  $row['post_date'];
                                    $post_image =  $row['post_image'];
                                    $post_content =  $row['post_content'];
                            ?>

                            <h1 class="page-header">
                                Page Heading
                                <small>Secondary Text</small>
                            </h1>

                            <h2>
                                <a href="#"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="image_1.jpg">
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="#">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            if (isset($_POST['create_comment'])) {
                                $post_id = $_GET['p_id'];

                                $comment_author = $_POST['comment_author'];
                                $comment_email = $_POST['comment_email'];
                                $comment_content = $_POST['comment_content'];

                                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                                $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                                $create_comment = $database->query($query);

                                $queryIncrement = "UPDATE posts SET post_comment_count = post_comment_count +1 WHERE post_id = '{$post_id}'";
                                $increment_count_comment = $database->query($queryIncrement);
                            }
                            ?>

                            <div class="well">
                                <form role="form" action="" method="post">
                                    <div class="form-group">
                                        <label for="comment_author">Author</label>
                                        <input type="text" name="comment_author" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment_email">Email</label>
                                        <input type="email" name="comment_email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Your comment</label>
                                        <textarea class="form-control" rows="3" name="comment_content"> </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                                </form>
                            </div>

                            <hr>
                            <?php
                            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                            $query .= "AND comment_status = 'Approved' ";
                            $query .= "ORDER BY comment_id DESC ";
                            $select_all_comments_by_post = $database->query($query);

                            while ($row = mysqli_fetch_assoc($select_all_comments_by_post)) {
                                $comment_date = $row['comment_date'];
                                $comment_content = $row['comment_content'];
                                $comment_author = $row['comment_author'];

                            ?>

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"> <?php echo $comment_author; ?>
                                        <small><?php echo $comment_date; ?></small>
                                    </h4>
                                    <?php echo $comment_content; ?>
                                </div>
                            </div>

                            <?php
                            }
                            ?>

                            <!-- Comment -->

                        </div>
                        <?php require_once("includes/sidebar.php"); ?>
                    </div>
                    <hr>
                    <?php require_once("includes/footer.php"); ?>
                    <!-- Blog Comments -->

                    <!-- Comments Form -->
                </div>

                <!-- Blog Sidebar Widgets Column -->
                <div class="col-md-4">

                    <!-- Blog Search Well -->
                    <div class="well">
                        <h4>Blog Search</h4>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                        <!-- /.input-group -->
                    </div>

                    <!-- Blog Categories Well -->
                    <div class="well">
                        <h4>Blog Categories</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>

                    <!-- Side Widget Well -->
                    <div class="well">
                        <h4>Side Widget Well</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci
                            accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                    </div>

                </div>

            </div>
            <!-- /.row -->

            <hr>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

</body>

</html>