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
              <h3 class="page-header"><i class="fa fa-check-square-o" aria-hidden="true"></i>Enrollment</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-check-square-o" aria-hidden="true"></i>Enrollment</li>
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
                            <option value=" ">-select session-</option>
                            <?php 
                              $qry = "SELECT * FROM sessions WHERE status = 1";
                              $r = mysqli_query($conn, $qry);
                              while($row4 = mysqli_fetch_array($r)){ ?>
                                <option value="<?php echo $row4['id']; ?>"><?php echo $row4['name']; ?></option> 
                                <?php 
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" id="course_list">
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
                      $class = ['active', 'success'];
                      $it = 1;
                      $i=0;
                      while($row = mysqli_fetch_array($sql)){ 
                          $it ^= 1;
                          $i++;
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
                                <option value=" ">-select section-</option>
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
                                <option value=" ">-select course type-</option>
                                <?php 
                                  $query1 = "SELECT * FROM `type` WHERE status = 1";
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
                      }
                    ?>
                    </tbody>
                  </table>
                </section>
              </div>
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
    <script>
      $(document).ready(function() {
        //hiding course section
        $('#course_list').hide();
        $('#session').change(function(){
            var session = $('#session').val();
            if(session != " "){ $('#course_list').show(); }
            else{ $('#course_list').hide(); }
        });
      });
    </script>
    <?php include '../include/script.php' ?>
  </body>
</html>

<?php //almost done :)
  if(isset($_POST['submit'])){
    if(!empty($_POST['check_list'])){
      $session_id = $_POST['session'];
      $id = $_SESSION['id'];

      $course_id=[];
      $section_id=[];
      $type_id=[];
      
      $i=0;
      foreach($_POST['check_list'] as $selected) {$course_id[$i] = $selected;$i++;}
      $i=0;
      foreach($_POST['section'] as $selected) {if($selected!=" "){$section_id[$i] = $selected;$i++;}}
      $i=0;
      foreach($_POST['type'] as $selected) {if($selected!=" "){$type_id[$i] = $selected;$i++;}}
      $n = count($course_id);
      //* one must choose a course in which a teacher is assigned 'Ex: check teacher assign'
      for($i=0;$i<$n;$i++){
        $qry = "SELECT * FROM teacher_assign WHERE section_id = $section_id[$i] AND course_id = $course_id[$i] AND session_id = $session_id AND status = 1"; // For later use 'AND status=0'
        $r = mysqli_query($conn, $qry);
        $row = mysqli_fetch_assoc($r);
        $teacher_id = $row['teacher_id'];
        //echo ' sec: '.$section_id[$i].' course: '.$course_id[$i].' type: '.$type_id[$i].' teacher: '.$teacher_id.'<br>'; //sidebar toggle korle printed value dekhabe :)
        $qry = "INSERT INTO enrollment(student_id,course_id,type_id,section_id,teacher_id,session_id,status) VALUES ($id, $course_id[$i], $type_id[$i], $section_id[$i], $teacher_id,$session_id,0)";
        if (mysqli_query($conn, $qry)){
          //echo "assigned\n";
          //enrollment table e inserted hobe.
          $qry1 = "SELECT * FROM num_dist WHERE teacher_id=$teacher_id AND section_id = $section_id[$i] AND course_id = $course_id[$i] AND session_id = $session_id"; 
          $sql1 = mysqli_query($conn, $qry1);

          while($row1 = mysqli_fetch_array($sql1)){
            $dist_id = $row1['id'];
            $qry2 = "INSERT INTO `marks_assign`(`student_id`, `teacher_id`, `course_id`, `section_id`, `session_id`, `dist_id`, `marks`) VALUES ($id, $teacher_id, $course_id[$i], $section_id[$i], $session_id, $dist_id, 0)";
            //echo $qry2;
            if (mysqli_query($conn, $qry2)){
              //echo "insert seccess\n";
            }
          }
          //marks_assign table e inserted hobe.
        }
      }
    }
  }
?>