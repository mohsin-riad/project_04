<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'admin'){
      session_destroy();
      header('Location: ../unauthorised_user.php');
    }
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Admin control panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/link.php' ?>
  </head>
  <body>
    <section id="container" class="">
      <?php include '../include/navbar.php' ?>
      <?php include '../include/sidebar.php' ?>
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Dashboard</li>
              </ol>
            </div>
          </div>
        </section>
      </section>
    </section>
    <?php include '../include/script.php' ?>
  </body>
</html>