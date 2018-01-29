<?php include "includes/db.php"; ?>

<?php session_start() ?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="index.php">POČETNA</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">

          <?php
          $query = "SELECT * FROM categories";
          $select_all_query = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($select_all_query)) {
              $cat_title = $row['cat_title'];
              $cat_id = $row['cat_id'];

              echo "<li class='nav-item'>
                      <a class='nav-link' href='category.php?category=$cat_id'>{$cat_title}</a>
                    </li>";
          }

           ?>


        <?php
        if (isset($_SESSION['user_role'])) {
            if ($_SESSION['user_role'] == 'admin') {


            echo "<li class='nav-item'>
                    <a class='nav-link' href='admin'>Admin</a>
                    </li>";
            if (isset($_GET['p_id'])) {
                $the_news_id = $_GET['p_id'];
                echo "<li class='nav-item'>
                        <a class='nav-link' href='admin/news.php?source=edit_news&p_id={$the_news_id}' style='color:red'>Ažuriraj</a>
                      </li>";
            }
            }
        }


         ?>
        <!-- <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="post.html">Sample Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>
