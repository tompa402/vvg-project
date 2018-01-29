<?php
if (isset($_POST['create_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    // $news_image = $_FILES['image']['name'];
    // $news_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $news_date = date('d-m-y');

    $query = "SELECT user_randSalt from users";
    $select_randSalt = mysqli_query($conn, $query);

    if (!$select_randSalt) {
        die ("QUERY FAILED! ". mysqli_error($conn));
    }

    $row = mysqli_fetch_array($select_randSalt);
    $salt = $row['user_randSalt'];

    $user_password = crypt($user_password, $salt);


    // move_uploaded_file($news_image_temp, "../images/$news_image");

    $query = "INSERT INTO users(username, user_password, user_firstname,
        user_lastname, user_email, user_role) ";
    $query .= "VALUES('{$username}', '{$user_password}', '{$user_firstname}',
    '{$user_lastname}', '{$user_email}', '{$user_role}'  ) ";

    $create_user_query = mysqli_query($conn, $query);

    confirmQuery($create_user_query);

    header("Location: users.php");
}


 ?>


<div class="container">
    <form class="" action="" method="post" enctype="multipart/form-data">



      <div class="form-group">
        <label for="user_firstname">Ime</label>
        <input type="text" class="form-control" id="user_firstname" name="user_firstname" placeholder="Ime">
      </div>

      <div class="form-group">
        <label for="user_lastname">Prezime</label>
        <input type="text" class="form-control" id="user_lastname" name="user_lastname" placeholder="Prezime">
      </div>

      <div class="form-group">
        <label for="user_role">Uloga (role)</label>
        <select class="form-control" id="user_role" name="user_role">
            <option value="Subscriber">Odaberi ulogu</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
      </select>
      </div>

      <div class="form-group">
        <label for="username">Korisničko ime</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
      </div>

      <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="mail@mail.mail">
      </div>


      <div class="form-group">
        <label for="user_password">Lozinka</label>
        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Lozinka">
      </div>

      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Dodaj korisnika">
      </div>
    </form>
</div>
