<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'student'){
      session_destroy();
      header('Location: ../unauthorised_user.php');
    }
    include '../include/connection.php';
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Student control panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/link.php' ?>
  </head>
  <body>
    <section id="container" class="">
      <?php include '../include/student_navbar.php' ?>
      <?php include '../include/student_sidebar.php' ?>
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-thumb-tack" aria-hidden="true"></i>Pending Enrollment</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-thumb-tack" aria-hidden="true"></i></i>Pending Enrollment</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <section class="panel">
                <header class="panel-heading">
                  My Requested Courses
                </header>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Course Title</th>
                      <th>Credit</th>
                      <th>Section</th>
                      <th>type</th>
                      <th>Session</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $student_id = $_SESSION['id'];
                    $query = "SELECT * FROM `enrollment` WHERE student_id = $student_id";
                    $sql = mysqli_query($conn, $query);
                    $class = ['active', 'success', 'warning', 'danger'];
                    $it = 0;
                    $i = 1;
                    $flag = True;
                    while($row = mysqli_fetch_array($sql)){ 
                      if($it == 4 || $it == -1) { 
                        $flag ^= 1; 
                        $it = ($flag)? $it+=2 : $it-=2;
                      } 
                      
                      $course_id = $row['course_id'];
                      $query1= "SELECT * FROM `courses` WHERE id = $course_id";
                      $sql1 = mysqli_query($conn, $query1);
                      $row1 = mysqli_fetch_assoc($sql1);
                      
                      $session_id = $row['session_id'];
                      $query2= "SELECT * FROM `sessions` WHERE id = $session_id";
                      $sql2 = mysqli_query($conn, $query2);
                      $row2 = mysqli_fetch_assoc($sql2);

                      $section_id = $row['section_id'];
                      $query3= "SELECT * FROM `sections` WHERE id = $section_id";
                      $sql3 = mysqli_query($conn, $query3);
                      $row3 = mysqli_fetch_assoc($sql3);
                      
                      $type_id = $row['type_id'];
                      $query4= "SELECT * FROM `type` WHERE id = $type_id";
                      $sql4 = mysqli_query($conn, $query4);
                      $row4 = mysqli_fetch_assoc($sql4);
                      ?> 
                      <tr class="<?php echo $class[$it]; ?>">
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo $row1['name'].' ('.$row1['type'].')'; ?> </td>
                        <td> <?php echo $row1['credit']; ?> </td>
                        <td> <?php echo $row3['name']; ?> </td>
                        <td> <?php echo $row4['name']; ?> </td>
                        <td> <?php echo $row2['name']; ?> </td>
                      </tr>
                      <?php
                      if($flag) { $it++; } 
                      else { $it--; } 
                      $i++;
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