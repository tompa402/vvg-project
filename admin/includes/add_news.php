<?php
if (isset($_POST['create_news'])) {
    $news_title = escape($_POST['title']);
    $cat_id = escape($_POST['news_category']);
    $news_author = escape($_POST['author']);
    $news_status = escape($_POST['news_status']);
    $news_image = escape($_FILES['image']['name']);
    $news_image_temp = escape($_FILES['image']['tmp_name']);
    $news_content = escape($_POST['news_content']);
    $news_tag = escape($_POST['news_tag']);
    $news_status = escape($_POST['news_status']);
    $news_cat_id = escape($_POST['news_category']);
    $news_date = date('d-m-y');
    $news_comment_count = 0;

    move_uploaded_file($news_image_temp, "../images/$news_image");

    $query = "INSERT INTO news(news_cat_id, news_title, news_author, news_date,
        news_image, news_content, news_tag, news_comment_count, news_status) ";
    $query .= "VALUES({$news_cat_id}, '{$news_title}', '{$news_author}', now(),
    '{$news_image}', '{$news_content}', '{$news_tag}', $news_comment_count, '{$news_status}' ) ";

    $create_news_query = mysqli_query($conn, $query);

    confirmQuery($create_news_query);

    $the_news_id = mysqli_insert_id($conn);

    echo "<p class='bg-success'>Vijest kreirana. <a href='../post.php?p_id={$the_news_id}'> Prikaži vijest</a> ili <a href='news.php'>Pregledaj sve vijesti</a></p>";

    // header("Location: news.php");
}


 ?>


<div class="container">
    <form class="" action="" method="post" enctype="multipart/form-data">

      <div class="form-group">
        <label for="title">News naslov</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Naslov">
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
        <input type="text" class="form-control" id="author" name="author" placeholder="Autor">
      </div>

      <div class="form-group">
        <label for="news_status">Status</label>
        <select class="form-control" id="news_status" name="news_status">
            <option value="Draft">Draft</option>
            <option value="Objavi">Objavi</option>
            <option value="Onemogući">Onemoguci</option>
      </select>
      </div>

      <div class="form-group">
        <label for="image">Slika</label>
        <br>
        <input type="file" name="image" placeholder="Slika">
      </div>

      <div class="form-group">
        <label for="news_tag">Tag</label>
        <input type="text" class="form-control" id="news_tag" name="news_tag" placeholder="Oznake">
      </div>

      <div class="form-group">
        <label for="news_content">Sadržaj</label>
        <textarea class="form-control" name="news_content" id="news_content" cols="30" rows="10"></textarea>
      </div>

      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_news" value="Objavi">
      </div>
    </form>
</div>
