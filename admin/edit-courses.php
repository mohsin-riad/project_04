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
    
    $qry="SELECT * FROM courses WHERE id=$id";
    $r=mysqli_query($conn,$qry);
    $courses=mysqli_fetch_array($r);
    //echo $courses['id'];
    //echo $courses['name'];
?>


<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Admin (course Edition)</title>
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
              <h3 class="page-header"><i class="fa fa-laptop"></i>Edit Course</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Course</li>
              </ol>
            </div>
          </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Edit Course information</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal" method="post">

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="name">Name</label>
                          <div class="col-lg-10">
                            <input type="text" value="<?php echo $courses['name'];?>" name = "name" id="" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="code">Code</label>
                          <div class="col-lg-10">
                              <input type="text" value="<?php echo $courses['code'];?>" name = "code" id="" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-lg-2" for="credit">Credit</label>
                          <div class="col-lg-10">
                              <input type="text" value="<?php echo $courses['credit'];?>" name = "credit" id="" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-lg-2">Type</label>
                            <div class="col-lg-10">
                                <select class = "form-control" name = "type" id="">
                                    <option <?php if($courses['type']=='theory'){echo 'selected';}?> value = "theory"> theory </option> 
                                    <option <?php if($courses['type']=='lab'){echo 'selected';}?> value = "lab"> lab </option> 
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <input type="submit" class="btn btn-primary" name="submit" value="Edit Course">
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
        $code = $_POST['code'];
        $type = $_POST['type'];
        $credit = $_POST['credit'];

        //db query
        $qry="UPDATE `courses` SET name='$name', code='$code', type='$type', credit = '$credit'  WHERE id = $id";
        if(mysqli_query($conn,$qry)){
            //header('Location:course-table.php');
            echo "<script type='text/javascript'>
            window.location.href='course-table.php';
            </script>";
            //echo 'Succesfully Inserted';
        }
    }
?>