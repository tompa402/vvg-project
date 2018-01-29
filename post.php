<?php include "includes/navigation.php"; ?>

<?php include "includes/header.php"; ?>


            <?php

            if (isset($_GET['p_id'])) {
                $the_news_id = $_GET['p_id'];

                $view_query = "UPDATE news SET news_views_count = news_views_count +1 WHERE news_id = $the_news_id";
                $send_query = mysqli_query($conn, $view_query);




            $query = "SELECT * FROM news WHERE news_id = $the_news_id ";
            $select_all_query = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($select_all_query)) {
                $news_id = $row['news_id'];
                $news_title = $row['news_title'];
                //$news_subtitle = $row['news_subtitle']; ne postoji jos u bazi
                $news_author = $row['news_author'];
                $news_date = $row['news_date'];
                $news_image = $row['news_image'];
                $news_content = $row['news_content'];

                ?>

                <div class="post-preview">
                  <a href="">
                    <h2 class="post-title">
                      <?php echo $news_title; ?>
                    </h2>
                    <h3 class="post-subtitle">
                      <?php echo $news_title; ?>
                    </h3>
                  </a>
                  <p class="post-meta">Posted by
                    <a href="author_posts.php?author=<?php echo $news_author; ?>&p_id=<?php echo $news_id; ?>"><?php echo $news_author; ?></a>
                    on <?php echo $news_date; ?></p>
                </div>
                <hr>
                  <img class="img-fluid" src="images/<?php echo $news_image; ?>" alt="">
                <hr>
                  <p><?php echo $news_content; ?></p>
                  <hr>

            <?php }
        }else {
            header("Location: index.php");
        }


             ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST['comment_create'])) {
                $the_news_id = escape($_GET['p_id']);
                $comment_author = escape($_POST['comment_author']);
                $comment_email = escape($_POST['comment_email']);
                $comment_content = escape($_POST['comment_content']);

                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                    $query = "INSERT INTO comments (comment_news_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ($the_news_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now()) ";

                    $create_comment_query = mysqli_query($conn, $query);

                    if (!$create_comment_query) {
                        die("QUERY FAILED" . mysqli_error($conn));
                    }

                    $query = "UPDATE news SET news_comment_count = news_comment_count + 1 ";
                    $query .= "WHERE news_id = $the_news_id";

                    $update_comment_counter = mysqli_query($conn, $query);
                }else {
                    echo "<script>alert('Polja za objavu komentara ne mogu biti prazna')</script>";
                }

            }

            ?>

            <!-- Comments Form -->
            <?php
            if (!isset($_SESSION['user_role'])) { ?>

            <div class="well">
                <h4>Pošalji komentar:</h4>
                <form action="" role="form" method="post">
                    <div class="form-group">
                        <label for="Author">Ime</label>
                        <input type="text" class="form-control" name="comment_author" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="comment_email" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Tvoj komentar</label>
                        <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="comment_create">Pošalji</button>
                </form>
            </div>
        <?php
    }else{ ?>
        <div class="well">
            <h4>Pošalji komentar:</h4>
            <form action="" role="form" method="post">
                <div class="form-group">
                    <label for="Author">Ime</label>
                    <input type="text" class="form-control" name="comment_author" value="<?php echo $_SESSION['firstname']; ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="comment_email" value="<?php echo $_SESSION['user_email']; ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="comment">Tvoj komentar</label>
                    <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="comment_create">Pošalji</button>
            </form>
        </div>

    <?php } ?>

            <hr>

            <!-- Posted Comments -->

            <?php
            $query = "SELECT * FROM comments WHERE comment_news_id = {$the_news_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($conn, $query);

            if (!$select_comment_query) {
                die("QUERY FAILED" . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];



            ?>

            <!-- Comment -->
            <div class="media">
                <a class="mr-3" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>
            <br>
            <?php } ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

      </div>
    </div>

    <hr>
<?php include "includes/footer.php"; ?>
