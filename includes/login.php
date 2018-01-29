<?php include "db.php"; ?>
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($conn, $query);

    if (!$select_user_query) {
        die("QUERY FAILED! " . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_email = $row['user_email'];
    }

    if ($username === $db_username && password_verify($password, $db_password)) {

        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_email'] = $db_email;

        if ($_SESSION['user_role'] == 'admin') {
            header("Location: ../admin");
        }else {
            header("Location: ../index.php");
        }

    }else {
        header("Location: ../index.php");
    }
}


 ?>
