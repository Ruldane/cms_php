<div class="col-md-4">
    <div class="well">
        <h4>Blog Search</h4>
        <!-- form search engine -->
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>

    <div class="well">

        <!-- Login -->
        <?php
        if (isset($_SESSION['user_username'])) {
            echo "
        <p>Already connected {$_SESSION['user_username']}!</p>
        <button class='btn btn-primary'><a href='./includes/logout.php'>Logout</a></button>
        ";
        } else {
            require_once("login_form.php");
        }
        ?>

        </form>
    </div>

    <div class="well">
        <?php
        $query = "SELECT * FROM categories";
        $select_all_categories = $database->query($query);
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($select_all_categories)) {
                        $cat_title =  $row['cat_title'];
                        $cat_id =  $row['id'];
                        echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php require_once("widget.php") ?>
</div>