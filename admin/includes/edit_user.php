<?php

if (isset($_GET['edit_user'])) {

    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_users_query = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
}


if (isset($_POST['edit_user'])) {

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

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$the_user_id}";

    $edit_user_query = mysqli_query($conn, $query);

    confirmQuery($edit_user_query);

    header("Location: users.php");
}


 ?>

 <div class="container">
     <form class="" action="" method="post" enctype="multipart/form-data">



       <div class="form-group">
         <label for="user_firstname">Ime</label>
         <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" id="user_firstname" name="user_firstname" placeholder="Ime">
       </div>

       <div class="form-group">
         <label for="user_lastname">Prezime</label>
         <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" id="user_lastname" name="user_lastname" placeholder="Prezime">
       </div>

       <div class="form-group">
         <label for="user_role">Uloga (role)</label>
         <select class="form-control" id="user_role" name="user_role">
             <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

             <?php
             if ($user_role == 'admin') {
                 echo "<option value='subscriber'>Subscriber</option>";
             }else {
                 echo "<option value='admin'>Admin</option>";
             }
              ?>

       </select>
       </div>

       <div class="form-group">
         <label for="username">Korisničko ime</label>
         <input type="text" class="form-control" value="<?php echo $username; ?>" id="username" name="username" placeholder="Username">
       </div>

       <div class="form-group">
         <label for="user_email">Email</label>
         <input type="email" class="form-control" value="<?php echo $user_email; ?>" id="user_email" name="user_email" placeholder="mail@mail.mail">
       </div>


       <div class="form-group">
         <label for="user_password">Lozinka</label>
         <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Lozinka" required>
       </div>

       <div class="form-group">
           <input class="btn btn-primary" type="submit" name="edit_user" value="Spremi promjene">
       </div>
     </form>
 </div>
