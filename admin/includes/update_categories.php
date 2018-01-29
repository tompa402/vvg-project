<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Izmjeni naziv kategorije</label>


        <?php
        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];

            $query = "SELECT * FROM categories where cat_id = $cat_id";
            $select_cat_id = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($select_cat_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>


          <input class="form-control" type="text" name="cat_title" value="<?php if(isset($cat_title)){echo $cat_title;} ?>" required>
      <?php }} ?>

      <?php
      if (isset($_POST['update'])) {
          $update_cat_title = $_POST['cat_title'];

          $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = {$cat_id} ";
          $update_query = mysqli_query($conn, $query);
          if (!$update_query) {
              die("QUERY FAILED" . mysqli_error($conn));
          }
          header("Location: categories.php");
      }

          ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Spremi promjene">
    </div>
</form>
