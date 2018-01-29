<?php include "includes/navigation.php"; ?>

<?php include "includes/header.php"; ?>


            <?php
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];

                $query = "SELECT * from news WHERE news_tag LIKE '%$search%' ";
                $search_query = mysqli_query($conn, $query);

                if (!$search_query) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }

                $count = mysqli_num_rows($search_query);

                if (!$count) {
                    echo "<h1>Nema rezultata pretrage</h1>";
                }else {

                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $news_id = $row['news_id'];
                        $news_title = $row['news_title'];
                        //$news_subtitle = $row['news_subtitle']; ne postoji jos u bazi
                        $news_author = $row['news_author'];
                        $news_date = $row['news_date'];
                        $news_image = $row['news_image'];
                        $news_content = substr(strip_tags(htmlspecialchars_decode(stripslashes($row['news_content']))),0, 200) . "...";

                    ?>


                        <div class="post-preview">
                          <a href="post.php?p_id=<?php echo $news_id; ?>">
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
                          <a class="btn btn-primary" href="post.php?p_id=<?php echo $news_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                          <hr>
            <?php
            }
            }
             } ?>


        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

      </div>
    </div>

    <hr>
<?php include "includes/footer.php"; ?>
