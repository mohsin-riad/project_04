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
      <?php include 'include/login_navbar.php' ?>
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
                      <form class="form-horizontal" method="post" action="index.php"> 
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
    </body>
  </html>
  <?php
    include 'include/connection.php';
    if(isset($_POST['submit'])){
        $email= $_POST['email'];
        $password=md5($_POST['password']);
        $query="SELECT * FROM users WHERE email = '$email' AND password='$password'"; 
        $sql=mysqli_query($conn, $query);
        $row=mysqli_fetch_array($sql);
        $role = $row['role'];
        //admin login
        if($role == 'admin'){
          $username = $row['name'];
          $_SESSION['username'] = $username; 
          $_SESSION['role'] = $role;
          $_SESSION['id'] = $id; 
          header('Location: admin/dashboard.php');
        }
        //teacher login
        else if($role == "teacher"){
            $username = $row['name'];
            $id = $row['id'];
            $_SESSION['username'] = $username; 
            $_SESSION['id'] = $id; 
            $_SESSION['role'] = $role;
          header('Location: teacher/dashboard.php');
        }
        //student login
        else if($role == "student"){
            $username = $row['name'];
            $id = $row['id'];
            $_SESSION['username'] = $username; 
            $_SESSION['id'] = $id; 
            $_SESSION['role'] = $role;
          header('Location: student/dashboard.php');
        }
        else {
          echo "<strong>Wrong email or password</strong>";
        }
    }
?>