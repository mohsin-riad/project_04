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
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Admin (assign teacher)</title>
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
              <h3 class="page-header"><i class="fa fa-laptop"></i>Teacher Assign</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Teacher Assign</li>
              </ol>
            </div>
          </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Choose Proper Information</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                          <label class="control-label col-lg-2">Teacher</label>
                          <div class="col-lg-10">
                            <select name="teacher" id="" class="form-control">
                              <option value="">- Choose Teacher -</option>
                                <?php  
                                    $query1 = "SELECT * FROM `users` WHERE role = 'teacher'";
                                    $sql1 = mysqli_query($conn, $query1);
                                    while($row1 = mysqli_fetch_array($sql1))
                                    {?>
                                        <option value="<?php echo $row1['id']; ?>"> <?php echo $row1['name']; ?> </option>
                                    <?php
                                    }
                                ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-lg-2">Course</label>
                          <div class="col-lg-10">
                            <select name="course" id="" class="form-control">
                              <option value="">- Choose Course -</option>
                                <?php  
                                    include '../include/connection.php';
                                    $query2 = "SELECT * FROM `courses`";
                                    $sql2 = mysqli_query($conn, $query2);
                                    while($row2 = mysqli_fetch_array($sql2))
                                    {?>
                                        <option value="<?php echo $row2['id']; ?>"> <?php echo $row2['name']; ?> </option>
                                    <?php
                                    }
                                ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-lg-2">Section</label>
                          <div class="col-lg-10">
                            <select name="section" id="" class="form-control">
                              <option value="">- Choose Section -</option>
                                <?php  
                                    include '../include/connection.php';
                                    $query3 = "SELECT * FROM `sections`";
                                    $sql3 = mysqli_query($conn, $query3);
                                    while($row3 = mysqli_fetch_array($sql3))
                                    { ?>
                                        <option value="<?php echo $row3['id']; ?>"> <?php echo $row3['name']; ?> </option>
                                    <?php
                                    }
                                ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-lg-2">Session</label>
                          <div class="col-lg-10">
                            <select name="session" id="" class="form-control">
                              <option value="">- Choose session -</option>
                                <?php  
                                    include '../include/connection.php';
                                    $query4 = "SELECT * FROM `sessions` WHERE status = 1";
                                    $sql4 = mysqli_query($conn, $query4);
                                    while($row4 = mysqli_fetch_array($sql4))
                                    {?>
                                        <option value="<?php echo $row4['id']; ?>"> <?php echo $row4['name']; ?> </option>
                                    <?php
                                    }
                                ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" name = "submit" class="btn btn-success">Assign</button>
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
    if(isset($_POST['submit']))
    {
        //recvd data from input/control
        $teacher = $_POST['teacher'];
        $course = $_POST['course'];
        $section = $_POST['section'];
        $session = $_POST['session'];
        
        //db query
        //status 0 for new enroll and 1 for completed
        $query = "INSERT INTO `teacher_assign`(`teacher_id`, `section_id`, `course_id`, `session_id`, `status`) VALUES ('$teacher', '$section', '$course', '$session', 0)";
        if(mysqli_query($conn, $query))
        {
            echo "successfully assigned!!";
        }
    }
?>