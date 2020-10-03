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
    <title>Teacher control panel</title>
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
              <h3 class="page-header"><i class="fa fa-laptop"></i>Distribution Display</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Show Distribution</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <section class="panel">
                <header class="panel-heading">
                  My Distributions
                </header>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Course Title</th>
                      <th>Session</th>
                      <th>Category Name</th>
                      <th>Marks</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  include '../include/connection.php';
                    $teacher_id = $_SESSION['id'];
                    $query = "SELECT * FROM `num_dist` WHERE teacher_id = $teacher_id";
                    $sql = mysqli_query($conn, $query);
                    $class = ['active', 'success', 'warning', 'danger'];
                    $it = 0;
                    $i = 1;
                    while($row = mysqli_fetch_array($sql)){ 
                      if($it == 4) { $it = 0; } 
                      $course_id = $row['course_id'];
                      $query1= "SELECT * FROM `courses` WHERE id = $course_id";
                      $sql1 = mysqli_query($conn, $query1);
                      $row1 = mysqli_fetch_assoc($sql1);
                      ?> 
                      <tr class="<?php echo $class[$it]; ?>">
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo $row1['name']; ?> </td>
                      </tr>
                      <?php
                      $it++; $i++;
                    }
                  ?>
                    
                    
                  </tbody>
                </table>
              </section>
            </div>
          </div>
        </section>
      </section>
    </section>
    <?php include '../include/script.php' ?>
  </body>
</html>