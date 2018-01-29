<?php include "includes/admin_header.php" ?>

<?php if (isset($_SESSION['username'])) {
    $username =  $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}'";

    $select_usr_profire_query = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($select_usr_profire_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
}

?>

<?php
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


    // move_uploaded_file($news_image_temp, "../images/$news_image");

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE username = '{$username}'";

    $edit_user_query = mysqli_query($conn, $query);

    confirmQuery($edit_user_query);

    header("Location: profile.php");
}


 ?>
  <!-- Navigation-->
  <?php include "includes/admin_navigation.php" ?>



        <li class="breadcrumb-item active"> / Moj prfil</li>
      </ol>
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
              <option value="Subscriber"><?php echo $user_role; ?></option>

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
          <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Lozinka">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_user" value="Spremi promjene">
        </div>
      </form>
      </div>





      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © TN NEWS BAR 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>


<?php include "includes/admin_footer.php" ?>
