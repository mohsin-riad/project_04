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
              <h3 class="page-header"><i class="fa fa-laptop"></i> Enrollment</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Enrollment</li>
              </ol>
            </div>
          </div>
          <form action="#" method="post">
            <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Select Available Session</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="card-body">
                        <div class="form-group">
                          <select class="form-control" name="session" id="session">
                            <option value="">-select session-</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-1"></div>
              <div class="col-sm-8">
                <section class="panel">
                  <header class="panel-heading"> Available Courses </header>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Choose</th>
                        <th>#S/N</th>
                        <th>Course Title</th>
                        <th>Credit</th>
                        <th>Section</th>
                        <th>Type</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $query = "SELECT * FROM `courses` WHERE 1";
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
                        
                        ?> 
                        <tr class="<?php echo $class[$it]; ?>">
                          <td>
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" name="check_list[]"  value="<?php echo $row['id']; ?>" id="checkbox">
                            </div>
                          </td>
                          <td> <?php echo $i; ?> </td>
                          <td> <strong><?php echo $row['name'].' ('.$row['type'].')'; ?></strong></td>
                          <td> <?php echo $row['credit']; ?> </td>
                          <td> 
                            <div class="form-group">
                              <select class="form-control input-sm m-bot15" name="section[]" id="section">
                                <option value="">-select section-</option>
                                <?php 
                                  $semester = $row['semester'];
                                  $query2 = "select sections.id, sections.name from courses, sections where courses.semester = sections.semester and sections.semester = $semester";
                                  $sql2 = mysqli_query($conn, $query2);
                                  $j = 0;
                                  while($row2 = mysqli_fetch_array($sql2)){ ?>
                                    <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?></option> 
                                    <?php 
                                    $j++;
                                    if($j>2){ break; }
                                  }
                                ?>
                              </select>
                            </div>
                          </td>
                          <td> 
                            <div class="form-group">
                              <select class="form-control input-sm m-bot15" name="type[]" id="type">
                                <option value="">-select course type-</option>
                                <?php 
                                  $query1 = "SELECT * FROM `type` WHERE 1";
                                  $sql1 = mysqli_query($conn, $query1);
                                  while($row1 = mysqli_fetch_array($sql1)){ ?>
                                    <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option> 
                                    <?php 
                                  }
                                  ?>
                              </select>
                            </div>
                          </td>
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
            <div class="row">
              <div class="col-sm-5"></div>
              <div class="col-sm-7">
                <div class="form-group">
                  <button name="submit" id="submit" class="btn btn-primary sub">submit</button>
                </div>
              </div>
            </div>
          </form>
        </section>
      </section>
    </section>
    <?php include '../include/script.php' ?>
  </body>
</html>

<?php //not done yet
  if(isset($_POST['submit'])){
    if(!empty($_POST['check_list'])){
      $data1=[];
      $data2=[];
      $data3=[];
      $i=0;
      foreach($_POST['check_list'] as $selected) { $data1[$i] = $selected ; $i++; }
      $i=0;
      foreach($_POST['section'] as $selected) { $data2[$i] = $selected ; $i++; }
      $i=0;
      foreach($_POST['type'] as $selected) { $data3[$i] = $selected ; $i++; }
      $n = $i;
      for($i=0; $i < $n ;$i++){
        echo $data1[$i].' - '.$data2[$i].' - '.$data3[$i];
        echo '<br>';
      }
    }
  }
?>