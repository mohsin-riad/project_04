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
    $id = $_SESSION['id'];
    include '../include/connection.php';
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Teacher (marks assignation)</title>
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
              <h3 class="page-header"><i class="fa fa-pencil" aria-hidden="true"></i>Marks assignation</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-pencil" aria-hidden="true"></i>Marks Assign</li>
              </ol>
            </div>
          </div>
          <form action="#" method="post">
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-5 portlets">
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
                              $qry = "SELECT DISTINCT sessions.id, sessions.name FROM sessions, teacher_assign WHERE teacher_assign.teacher_id = $id AND teacher_assign.session_id = sessions.id";
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
              <div class="col-md-5 portlets" id="course_list">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="pull-left">Select Available Course</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-body">
                    <div class="padd">
                      <div class="card-body">
                        <div class="form-group">
                          <select class="form-control" name="course" id="course">
                            <option value=" ">-select session-</option>
                            <?php 
                              $sql = "SELECT courses.id, courses.name, sections.id, sections.name FROM courses, sections, teacher_assign WHERE teacher_assign.teacher_id = $id AND teacher_assign.course_id = courses.id AND teacher_assign.section_id = sections.id";
                              $r = mysqli_query($conn, $qry);
                              while($row4 = mysqli_fetch_array($r)){ ?>
                                <option value = "<?php echo $row4['courses.id']; ?>"><?php echo $row4['courses.name']; ?></option> 
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
            <div class="row" id="student_marks">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <section class="panel">
                  <header class="panel-heading">Enrolled Students</header>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#S/N</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Type</th>
                      </tr>
                    </thead>
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
        $('#student_marks').hide();
        $('#session').change(function(){
          var session = $('#session').val();
          if(session != " "){
            $('#course_list').show();
            $('#course').change(function(){
              var course = $('#course').val();
              if(course != " "){ $('#student_marks').show(); }
              else { $('#student_marks').hide(); }
            });
          }
          else{ $('#course_list').hide(); $('#student_marks').hide(); }
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $("#session").change(function() {
          var session_id = $("#session").val();
          //using ajax
          $.ajax({
            url: "get_course.php",
            dataType: 'json',
            data: {
              "session_id" : session_id
            },
            success: function(data) {
              $("#course").html('<option value=" ">-select course-</option>');
              for(i=0; i<data.length;i++){
                var x = '<option value="'+data[i].course_id+'">'+data[i].course_name+'&emsp;&emsp;&emsp;'+data[i].section_name+'</option>';
                $("#course").append(x);
              }
            }
          });
        });
      });
    </script>

    <?php include '../include/script.php' ?>
  </body>
</html>

<?php 
    
?>