<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'teacher'){
      session_destroy();
      header('Location: ../unauthorised_user.php');
    }
    include '../include/connection.php';
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Teacher (change password)</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/link.php' ?>
  </head>
  <body>
    <section id="container" class="">
    <?php include '../include/teacher_navbar.php' ?>
      <?php include '../include/teacher_sidebar.php' ?>
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-wrench" aria-hidden="true"></i>Change Password</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-wrench" aria-hidden="true"></i>change password</li>
              </ol>
            </div>
          </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Enter to change the password</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal" method="post" action="">

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="pass0">Old password</label>
                          <div class="col-lg-10">
                            <input type="password" name = "pass0" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="pass1">New password</label>
                          <div class="col-lg-10">
                            <input type="password" id="pass1" name = "pass1" onkeyup="f1()" class="form-control" required></br>
                            <label id="lbl1" for="pass1"><p style='color: red;'>Minimum password length is 5</p></label>
                            <label id="lbl2" for="pass1"><p style='color: green;'>password length strong</p></label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="pass2">Retype new password</label>
                          <div class="col-lg-10">
                            <input type="password" id="pass2" name = "pass2" onkeyup="f2()" class="form-control" required></br>
                            <label id="lbl3" for="pass2"><p style='color: red;'>Minimum password length is 5</p></label>
                            <label id="lbl4" for="pass2"><p style='color: green;'>password length strong</p></label>
                          </div>
                        </div>

                        <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-9">
                          <button type="submit" name = "submit" class="btn btn-primary">Change Password</button>
                        </div>
                      </div>
                      <?php 
                        if(isset($_POST['submit']))
                        {
                            //recvd data from input/control
                            $pass0 = md5($_POST['pass0']);
                            $pass1 = $_POST['pass1'];
                            $pass2 = $_POST['pass2'];
                            $id = $_SESSION['id'];

                            //old pass query
                            $query = "SELECT * FROM users WHERE id = $id";
                            $r=mysqli_query($conn, $query);
                            $row=mysqli_fetch_array($r);
                            $pass = $row['password'];

                            //pass check and update
                            if($pass0!=$pass){
                                echo "<p style='color: red;'>Old password does not matched</p>";
                            }
                            else if($pass1!=$pass2){
                                echo "<p style='color: red;'>New passwords does not matched</p>";
                            }
                            else if(strlen($pass1)<5){
                                echo "<p style='color: red;'>New password is too short</p>";
                            }
                            else{
                                //update password
                                $pass1 = md5($pass1);
                                $query = "UPDATE users SET password = '$pass1' WHERE id = $id";
                                if(mysqli_query($conn, $query)){
                                    echo "<p style='color: green;'>Password updated successfully</p>";
                                }
                            }
                            
                        }
                    ?>
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

    <script>
                $('#lbl1').hide();
                $('#lbl2').hide();
                $('#lbl3').hide();
                $('#lbl4').hide();
        function f1(){
            var pass1 = document.getElementById('pass1').value;
            if(pass1.length<5){
                $('#lbl1').show();
                $('#lbl2').hide();
            }
            else{
                $('#lbl2').show();
                $('#lbl1').hide();
            }
        }
        function f2(){
            var pass2 = document.getElementById('pass2').value;
            if(pass2.length<5){
                $('#lbl3').show();
                $('#lbl4').hide();
            }
            else{
                $('#lbl4').show();
                $('#lbl3').hide();
            }
        }
    </script>
  </body>
</html>



