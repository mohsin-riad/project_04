<?php
    session_start();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include 'include/link.php'?>
  </head>
  <body>
    <section id="container" class="">
<?php include 'include/navbar.php'?>
      <section id="main-content">
        <section class="wrapper">
          
            <div class="col-md-6 ">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Login</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post"  >
                      <form class="form-horizontal" method="post" > 
                        <div class="form-group">
                            <label class="control-label col-lg-2" for="email">Email</label>
                            <div class="col-lg-10">
                              <input type="text" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="password">Password</label>
                          <div class="col-lg-10">
                              <input type="password" name="password" id="password" class="form-control">  
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">login</button>
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
<?php include 'include/script.php'?>
    </body>
  </html>
  <?php
    include 'connection.php';
    if(isset($_POST['submit'])){
        $email= $_POST['email'];
        $password=md5($_POST['password']);
        $qry="SELECT * FROM member WHERE email = '$email' AND password='$password'"; 
        $r=mysqli_query($con,$qry);
        $row=mysqli_fetch_array($r);
        if($row){
            header('Location: dashboard.php');
        }
        else echo "Wrong email or password";
    }
?>