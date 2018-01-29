<?php include "includes/navigation.php"; ?>

<?php include "includes/header.php"; ?>


            <?php

            $per_page = 5;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];

            }else {
                $page = "";
            }
            if ($page == "" || $page==1) {
                $page_1 = 0;
            }else {
                $page_1 = ($page*$per_page) - $per_page;
            }

            $news_query_count = "SELECT * FROM news";
            $find_count = mysqli_query($conn, $news_query_count);
            $count = mysqli_num_rows($find_count);

            $count = ceil($count / $per_page);


            $query = "SELECT * FROM news WHERE news_status = 'objavi' ORDER BY news_id DESC LIMIT $page_1, $per_page ";
            $select_all_query = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($select_all_query)) {
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
                <a href="post.php?p_id=<?php echo $news_id; ?>">
                  <img class="img-fluid" src="images/<?php echo $news_image; ?>" alt=""></a>
                <hr>
                  <p><?php echo $news_content; ?></p>
                  <a class="btn btn-primary" href="post.php?p_id=<?php echo $news_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                  <hr>

            <?php } ?>


        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

      </div>
      <nav aria-label="Page navigation example">

      <ul class="pagination">
          <?php
          for ($i=1; $i <= $count; $i++) {

              if ($i == $page) {
                  echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
              }else {
                  echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
              }

          }


           ?>
      </ul>
      </nav>
    </div>


    <hr>
<?php include "includes/footer.php"; ?>
