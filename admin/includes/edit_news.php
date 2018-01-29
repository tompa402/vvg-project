<?php

if (isset($_GET['p_id'])) {

    $the_news_id = $_GET['p_id'];

    $query = "SELECT * FROM news WHERE news_id = $the_news_id";
    $select_news = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($select_news)) {
        $news_id = $row['news_id'];
        $news_title = $row['news_title'];
        $news_author = $row['news_author'];
        $news_date = $row['news_date'];
        $news_image = $row['news_image'];
        $news_content = $row['news_content'];
        $news_tag = $row['news_tag'];
        $news_comment_count = $row['news_comment_count'];
        $news_status = $row['news_status'];
        $news_cat_id = $row['news_cat_id'];
    }
}

if (isset($_POST['update_news'])) {
    $news_title = escape($_POST['title']);
    $cat_id = escape($_POST['news_category']);
    $news_author = escape($_POST['author']);
    $news_status = escape($_POST['news_status']);
    $news_image = escape($_FILES['image']['name']);
    $news_image_temp = escape($_FILES['image']['tmp_name']);
    $news_content = escape($_POST['news_content']);
    $news_tag = escape($_POST['news_tag']);
    $news_status = escape($_POST['news_status']);

    move_uploaded_file($news_image_temp, "../images/$news_image");

    if(empty($news_image)){
        $query = "SELECT * from news WHERE news_id = $the_news_id ";
        $select_image = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($select_image)) {
            $news_image = $row['news_image'];
        }
    }

    $query = "UPDATE news SET ";
    $query .= "news_title = '{$news_title}', ";
    $query .= "news_cat_id = '{$cat_id}', ";
    $query .= "news_author = '{$news_author}', ";
    $query .= "news_date = now(), ";
    $query .= "news_image = '{$news_image}', ";
    $query .= "news_content = '{$news_content}', ";
    $query .= "news_tag = '{$news_tag}', ";
    $query .= "news_status = '{$news_status}' ";
    $query .= "WHERE news_id = {$the_news_id}";

    $update_news = mysqli_query($conn, $query);

    confirmQuery($update_news);

    echo "<p class='bg-success'>Vijest Ažurirana. <a href='../post.php?p_id={$the_news_id}'> Prikaži vijest</a> ili <a href='news.php'>Pregledaj sve vijesti</a></p>";

    // header("Location: news.php");


}


 ?>

<div class="container">
    <form class="" action="" method="post" enctype="multipart/form-data">

      <div class="form-group">
        <label for="title">News naslov</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $news_title; ?>">
      </div>

      <div class="form-group">
        <label for="news_category">Kategorija</label>
        <select class="form-control" name="news_category">

            <?php
            $query = "SELECT * FROM categories";
            $select_cat = mysqli_query($conn, $query);

            confirmQuery($select_cat);

            while ($row = mysqli_fetch_assoc($select_cat)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='$cat_id'>{$cat_title}</option>";

            }
            ?>

        </select>

      </div>

      <div class="form-group">
        <label for="author">Autor</label>
        <input type="text" class="form-control" id="author" name="author" value="<?php echo $news_author; ?>">
      </div>

      <div class="form-group">
        <label for="news_status">Status</label>
        <select class="form-control" id="news_status" name="news_status">
          <option><?php echo $news_status; ?></option>

          <?php
          if ($news_status == 'Objavi'){
              echo "<option value='Draft'>Draft</option>";
              echo "<option value='Onemoguci'>Onemoguci</option>";
          }elseif ($news_status == 'Draft') {
              echo "<option value='Objavi'>Objavi</option>";
              echo "<option value='Onemoguci'>Onemoguci</option>";
          }else{
              echo "<option value='Draft'>Draft</option>";
              echo "<option value='Objavi'>Objavi</option>";
          }

          ?>
      </select>
      </div>

      <div class="form-group">
          <label for="image">Slika</label>
          <br>
        <img width="200" src="../images/<?php echo $news_image; ?>" alt="">
        <br>
        <input type="file" name="image" placeholder="Slika">
      </div>

      <div class="form-group">
        <label for="news_tag">Tag</label>
        <input type="text" class="form-control" id="news_tag" name="news_tag" value="<?php echo $news_tag; ?>">
      </div>

      <div class="form-group">
        <label for="news_content">Sadržaj</label>
        <textarea class="form-control" name="news_content" id="news_content" cols="30" rows="10"><?php echo $news_content; ?></textarea>
      </div>

      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_news" value="Objavi">
      </div>
    </form>
</div>
