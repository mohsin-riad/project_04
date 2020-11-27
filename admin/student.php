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
              <h3 class="page-header"><i class="fa fa-laptop"></i> Student Creation</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Student</li>
              </ol>
            </div>
          </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Enter Student Information</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal" method="post" action="" >
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="name">Name</label>
                          <div class="col-lg-10">
                            <input type="text" name = "name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Email</label>
                        <div class="col-lg-10">
                            <input type="text" name = "email" class="form-control">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="tags">Password</label>
                          <div class="col-lg-10">
                            <input type="password" name = "password" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" name= "submit" class="btn btn-primary">Create</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </section>
    </section>
    <?php include '../include/script.php' ?>
    </body>
</html>
<?php 
    include '../include/connection.php';
    if(isset($_POST['submit']))
    {
      //recvd data from input/control
      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = md5($_POST['password']);
      $role = "student";
      //db query
      $query = "INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES ('$name','$email','$pass','$role')";
      if(mysqli_query($conn, $query))
      {
          echo "<script> alert('successfully created!!');</script>";
      }
    }
?>
