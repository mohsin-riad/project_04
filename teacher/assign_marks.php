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
          <form action="" method="post">
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
                            <!-- <option value=" ">-select course-</option>  -->
                            <!-- ajax -->
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
                  <table class="table" id="student_dist">
                    <thead>
                      <tr>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>  
                      </tr>
                    </tbody>
                  </table>
                </section>
              </div>
              <div class="col-sm-5"></div>
              <div class="col-sm-7">
                <div class="form-group">
                  <button name="submit" id="submit" class="btn btn-primary sub">Save Progress</button>
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
            url: "get_course_section.php",
            dataType: 'json',
            data: {
              "session_id" : session_id
            },
            success: function(data) {
              $("#course").html('<option value=" ">-select course-</option>');
              for(i=0; i<data.length;i++){
                var x = '<option value="'+data[i].course_id+'|'+data[i].section_id+'">'+data[i].course_name+'&emsp;&emsp;&emsp;'+data[i].section_name+'</option>';
                $("#course").append(x);
              }
            }
          });
        });
      });
    </script>
    <script>
      $(document).ready(function(){
        var table = $('#student_dist').DataTable({
          columnDefs: [{
            orderable: false,
            targets: [1,2,3]
          }]
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $("#course").change(function() {
          var cnt = 0;
          var course_id = $("#course").val().split('|')[0];
          var section_id = $("#course").val().split('|')[1];
          var session_id = $("#session").val();
          //alert(course_id+'-'+section_id+'-'+session_id);
          // using ajax
          $.ajax({
            url: "get_students_dist_form.php",
            dataType: 'json',
            data: {
              "course_id" : course_id,
              "session_id" : session_id,
              "section_id" : section_id
            },
            success: function(data) {
              console.log(data);
              $("#student_dist thead tr").html('\
                <th>#S/N</th>\
                <th>ID</th>\
                <th>Name</th>\
                ');
              for(i=0; i<data.length;i++){
                var x = '<th>'+data[i].catagory_name+' ('+data[i].marks+') '+'</th>';
                $("#student_dist thead tr").append(x);
                cnt++;
              }
              $("#student_dist thead tr").append('<th>Total</th>');
            }
          });

          $.ajax({
            url: "get_enrolled_students.php",
            dataType: 'json',
            data: {
              "course_id" : course_id,
              "session_id" : session_id,
              "section_id" : section_id
            },
            success: function(data) {
              console.log(data);
              $("#student_dist tbody tr").html(' ');
              for(i=0; i<data.length;i++){
                var x = '<tr><input type="hidden" name="serial_id" value="'+(i+1)+'"><td>'+(i+1)+'</td>'+'<td>\
                          <input type="hidden" name="student_id[]" value="'+data[i].student_id+'">\
                          <input type="hidden" name="begin[]" value="'+data[i].begin+'">\
                          <input type="hidden" name="end[]" value="'+data[i].end+'">'+data[i].student_id+'</td>'+'<td>'+data[i].name+'</td>';
                var begin = parseInt(data[i].begin);
                var end = parseInt(data[i].end);
                var k = parseInt("0");
                var total_mark_sum = parseInt("0");;
                for(j=begin; j<=end;j++){
                  x = x+'<td><input class="form-control input-sm m-bot15 marks" type="number" name="marks'+(k+1)+'[]" value="'+data[i][k]+'" id="marks"></td>';
                  total_mark_sum += parseInt(data[i][k]);
                  k++;
                }
                
                $("#student_dist tbody ").append(x+'<td><output id="total_mark">'+total_mark_sum+'</output></td><tr>');
              }
              // $('#student_dist tr').on('input', 'td', function(){
              //   var sum = 0;
              //   $('#student_dist tbody tr .marks').each(function(){
              //     var input_val = $(this).val();
              //     if($.isNumeric(input_val)){
              //       sum += parseFloat(input_val);
              //     }
              //   });
              //   $('td #total_mark').text(sum+'/100');
                // if(sum > 100){ 
                //   alert('MARKS LIMIT EXCEEDED!');
                //   //$('#submit').prop('disabled', true);
                //   //$('#add').prop('disabled', true);
                // }
                // else if(sum == 100){ 
                //   //alert('Submit Now: total marks fixed'); 
                //   //$('#submit').prop('disabled', false);
                //   //$('#add').prop('disabled', true);
                // }
                // else { 
                //   //$('#submit').prop('disabled', true); 
                //   //$('#add').prop('disabled', false);
                // }
              // });
            }
          });
        });
      });
    </script>
    <?php include '../include/script.php' ?>
  </body>
</html>
<?php  ?>
<?php 
  if(isset($_POST['submit'])){
    $session_id = $_POST['session'];
    $course_section_id = $_POST['course'];
    $course_section_id1  = explode('|',$course_section_id);
    $c  = count($course_section_id1);
    $section_id = $course_section_id1[$c - 1];
    $course_id = $course_section_id1[$c - 2];
    $n = $_POST['serial_id'];
    $student_id = [];
    $begin = [];
    $end = [];
    $i=0;
    foreach($_POST['student_id'] as $selected) {if($selected!=" "){$student_id[$i] = $selected;$i++;}}
    $i=0;
    foreach($_POST['begin'] as $selected) {if($selected!=" "){$begin[$i] = $selected;$i++;}}
    $i=0;
    foreach($_POST['end'] as $selected) {if($selected!=" "){$end[$i] = $selected;$i++;}}
    
    for($i=0; $i < $n ;$i++){
      $total_dist = abs($begin[$i]-$end[$i])+1;
      // echo $student_id[$i].' - '.$begin[$i].' - '.$end[$i]."\n";
      // echo $total_dist;
      // echo '<br>';
      $cnt = $begin[$i];
      for($j=1; $j <= $total_dist ;$j++){
        $marks = [];
        $k = 0;
        foreach($_POST['marks'.$j] as $selected) {if($selected!=" "){$marks[$k] = $selected;$k++;}}
        // echo $marks[$i];
        // echo '-';
        $qry = "UPDATE `marks_assign` SET `marks`= $marks[$i] WHERE `student_id`=$student_id[$i] AND `teacher_id`=$id AND `course_id`=$course_id AND `section_id`=$section_id AND `session_id`=$session_id AND `dist_id`=$cnt";
        mysqli_query($conn, $qry);
        // echo $qry;
        // echo '<br>';
        $cnt++;
      }
    }
  }
?>