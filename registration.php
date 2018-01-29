<?php include ("includes/db.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>TN NEWS - registracija</title>
  <!-- Bootstrap core CSS-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<?php
if (isset($_POST['submit'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_password_control = $_POST['user_password_control'];

    $user_firstname = mysqli_real_escape_string($conn, $user_firstname);
    $user_lastname = mysqli_real_escape_string($conn, $user_lastname);
    $user_email = mysqli_real_escape_string($conn, $user_email);
    $username = mysqli_real_escape_string($conn, $username);
    $user_password = mysqli_real_escape_string($conn, $user_password);
    $user_password_control = mysqli_real_escape_string($conn, $user_password_control);

    if ($user_password !== $user_password_control) {
        echo "<script>alert('lozinka nije potvrđena')</script>";
    }elseif (empty($user_firstname) || empty($user_lastname) || empty($user_email) || empty($username) || empty($user_password)) {
        echo "<script>alert('Potrebno je popuniti obavezna polja')</script>";
    }else {
        $query = "SELECT user_randSalt from users";
        $select_randSalt = mysqli_query($conn, $query);

        if (!$select_randSalt) {
            die ("QUERY FAILED! ". mysqli_error($conn));
        }

        $row = mysqli_fetch_array($select_randSalt);
        $salt = $row['user_randSalt'];

    	$user_password = crypt($user_password, $salt);

        $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) ";
        $query .= "VALUES ('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', 'subscriber') ";
        $register_user_query = mysqli_query($conn, $query);
        if (!$register_user_query) {
            die ("QUERY FAILED! ". mysqli_error($conn));
        }
        $message = "Registracija je bila uspiješna!";
        }
    }else {
        $message = "";
    }


 ?>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registracija novog korinsika</div>
      <div class="card-body">
        <form class="" action="registration.php" method="post">
          <div class="form-group">
              <h6 class="text-center"><?php echo $message; ?></h6>
            <div class="form-row">
              <div class="col-md-6">
                <label for="user_firstname">Ime</label>
                <input class="form-control" id="user_firstname" name="user_firstname" type="text" aria-describedby="nameHelp" placeholder="Unesi ime" required>
              </div>
              <div class="col-md-6">
                <label for="user_lastname">Prezime</label>
                <input class="form-control" id="user_lastname" name="user_lastname" type="text" aria-describedby="nameHelp" placeholder="Unesi prezime" required>
              </div>
            </div>
          </div>
          <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                    <label for="user_email">Email adreas</label>
                    <input class="form-control" id="user_email" name="user_email" type="email" aria-describedby="emailHelp" placeholder="Unesi email" required>
                </div>
                <div class="col-md-6">
                    <label for="username">Korisničko ime</label>
                    <input class="form-control" id="username" name="username" type="text" aria-describedby="emailHelp" placeholder="Unesi korisničko ime" required>
                </div>

              </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="user_password">Lozinka</label>
                <input class="form-control" id="user_password" name="user_password" type="password" placeholder="Unesi lozinku" required>
              </div>
              <div class="col-md-6">
                <label for="user_password_control">Potvrda lozinke</label>
                <input class="form-control" id="user_password_control" name="user_password_control" type="password" placeholder="Ponovi lozinku" required>
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" href="" type="submit" name="submit">Registracija</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Povratak na početnu stranicu</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
