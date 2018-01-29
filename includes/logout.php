<?php session_start(); ?>

<?php

// $_SESSION['username'] = null;
// $_SESSION['firstname'] = null;
// $_SESSION['lastname'] = null;
// $_SESSION['user_role'] = null;

if (session_status() == PHP_SESSION_ACTIVE) {
     session_destroy();
 }

 header("Location: ../index.php");

 ?>

<?php
