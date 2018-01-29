<?php ob_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>
<?php session_start(); ?>

<?php
if (!isset($_SESSION['user_role'])) {
    header("Location: ../index.php");
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>TN NEWS - Admin</title>
  <!-- Bootstrap core CSS-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- google charts -->
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <div class="content-wrapper">
      <div class="container-fluid">
          <h1 class="page-header">Dobro došli u administriranje
            <small><?php echo $_SESSION['username']; ?></small>
          </h1>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="index.php">Početna stranica </a>
            </li>
