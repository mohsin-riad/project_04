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
    include '../include/connection.php'; 
    $id=$_REQUEST['id'];
    
    $qry="SELECT * FROM users WHERE id=$id";
    $r=mysqli_query($conn,$qry);
    $user=mysqli_fetch_array($r);
    //echo $courses['id'];
    //echo $courses['name'];
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Admin (Teacher Edition)</title>
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
              <h3 class="page-header"><i class="fa fa-laptop"></i>Edit Teacher</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Teacher</li>
              </ol>
            </div>
          </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Edit Teacher information</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal" method="post">

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="name">Name</label>
                          <div class="col-lg-10">
                            <input type="text" value="<?php echo $user['name'];?>" name = "name" id="" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="email">Code</label>
                          <div class="col-lg-10">
                              <input type="text" value="<?php echo $user['email'];?>" name = "email" id="" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="pass">Password</label>
                          <div class="col-lg-10">
                              <input type="text"  name = "pass" id="" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <input type="submit" class="btn btn-primary" name="submit" value="Edit Teacher">
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
    if((isset($_POST['submit']))){
        //recvd data from input/control
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        //if pass not changed
        if($pass == ""){
            $qry="UPDATE users SET name='$name', email='$email' WHERE id = $id";
            if(mysqli_query($conn,$qry)){
                echo "<script type='text/javascript'>
                     window.location.href='teacher-table.php';
                     </script>";
            }
        }
        
        else{
            $pass = MD5($pass);
            $qry="UPDATE users SET name='$name', email='$email', password = '$pass'  WHERE id = $id";
            if(mysqli_query($conn,$qry)){
                echo "<script type='text/javascript'>
                     window.location.href='teacher-table.php';
                     </script>";
            }
        }
    }
?>