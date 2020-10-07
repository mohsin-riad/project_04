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
    <title>Admin (course creation)</title>
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
              <h3 class="page-header"><i class="fa fa-laptop"></i>Create Course</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Course</li>
              </ol>
            </div>
          </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Enter Course information</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="name">Name</label>
                          <div class="col-lg-10">
                            <input type="text" name = "name" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="code">Code</label>
                          <div class="col-lg-10">
                              <input type="text" name = "code" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="credit">Credit</label>
                          <div class="col-lg-10">
                              <input type="text" name = "credit" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-lg-2">Type</label>
                          <div class="col-lg-10">
                          <select class="form-control" name="type" id="">
                            <option value="">- Choose Course Type -</option>
                            <option value="theory">Theory</option>
                            <option value="lab">Lab</option>
                          </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                              <button type="submit" name = "submit" class="btn btn-primary">Create</button>
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
    <script>
      $(document).ready(function(){
        $('form').submit(function(){
          alert("course has been created");
        });
      });
    </script>
    <?php include '../include/script.php' ?>
  </body>
</html>

<?php 
    include '../include/connection.php';
    if(isset($_POST['submit']))
    {
        //recvd data from input/control
        $name = $_POST['name'];
        $code = $_POST['code'];
        $credit = $_POST['credit'];
        $type = $_POST['type'];
        //db query
        $query = "INSERT INTO `courses`(`name`, `code`, `credit`, `type`) VALUES ('$name','$code', '$credit', '$type')";
        if(mysqli_query($conn, $query))
        {
            echo "successfully created!!";
        }
    }
?>