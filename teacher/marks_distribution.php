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
    <title>Teacher (Marks Distribution)</title>
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
              <h3 class="page-header"><i class="fa fa-laptop"></i>Marks Distribution</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Distribute</li>
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
                    <div class="card-body">
                      <form action="" method="post">
                          <div class="form-group">
                              <label for="">Select course</label>
                              <select class="form-control" name="course" id="course">
                                  <option value="">-select course-</option>
                                  <?php
                                      $teacher_id = $_SESSION['id'] ; 
                                      $query1 = "SELECT * FROM `teacher_assign` WHERE teacher_id = $teacher_id";
                                      $sql1 = mysqli_query($conn, $query1);
                                      while($row1 = mysqli_fetch_array($sql1)){ 
                                        if($row1['status'] == 0){

                                          $course_id = $row1['course_id'];
                                          $query2 = "SELECT * FROM `courses` WHERE id = $course_id";
                                          $sql2 = mysqli_query($conn, $query2);
                                          $row2 = mysqli_fetch_assoc($sql2);
                                          
                                          $section_id = $row1['section_id'];
                                          $query3 = "SELECT * FROM `sections` WHERE id = $section_id";
                                          $sql3 = mysqli_query($conn, $query3);
                                          $row3 = mysqli_fetch_assoc($sql3);
                                          
                                          $session_id = $row1['session_id'];
                                          $query4 = "SELECT * FROM `sessions` WHERE id = $session_id";
                                          $sql4 = mysqli_query($conn, $query4);
                                          $row4 = mysqli_fetch_assoc($sql4);
                                          ?>
                                          <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name'].' - '.$row3['name'].' - '.$row4['name']; ?></option>
                                          <?php 
                                        }
                                      }
                                  ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <button name="add" id="add" class="btn btn-success">Add</button>
                          </div>
                          <div id="dynamic_row" class="form-group row">
                              <!-- <div class="col-6">
                                  <input type="text" name="catagory_name[]" id="" placeholder="enter catagory" class="form-control">
                              </div>
                              <div class="col-6">
                                  <input type="number" name="catagory_value[]" id="" placeholder="enter number" class="form-control">
                              </div> -->
                          </div>
                          <div class="form-group">
                            <div class="alert alert-secondary" id="show_total" role="alert">
                              <label for=""> Total Marks :</label>
                              <output id="result"></output>
                            </div>
                          </div>
                          <div class="form-group">
                              <button name="submit" id="submit" class="btn btn-primary sub">submit</button>
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
          $('#show_total').hide();
          $('#add').hide();
          $('#course').change(function(){
              var course = $('#course').val();
              if(course != ""){
                  $('#add').show();
                  $('#show_total').show();
              }
              else{
                  $('#add').hide();
                  $('#show_total').hide();
              }
          });
          $('#add').click(function(e){
              e.preventDefault();
              var str =  '<div class="col-md-6 portlets">\
                              <input type="text" name="catagory_name[]" id="" placeholder="enter catagory" class="form-control">\
                          </div>\
                          <div class="col-md-6 portlets">\
                              <input type="number" name="catagory_value[]" id="" placeholder="enter number" class="form-control marks">\
                          </div>';
              $('#dynamic_row').append(str);
          });
      });
    </script>
    <script>
      //Dynamic marks calculation :)
      $(document).ready(function(){
        $("#submit").attr("disabled", true);

        $('.form-group').on('input', '.marks', function(){
          var sum = 0;
          $('.form-group .marks').each(function(){
            var input_val = $(this).val();
            if($.isNumeric(input_val)){
              sum += parseFloat(input_val);
            }
          });
          $('#result').text(sum+'/100');
          if(sum > 100){ 
            alert('MARKS LIMIT EXCEEDED!');
            $('#submit').prop('disabled', true);
            $('#add').prop('disabled', true);
          }
          else if(sum == 100){ 
            //alert('Submit Now: total marks fixed'); 
            $('#submit').prop('disabled', false);
            $('#add').prop('disabled', true);
          }
          else { 
            $('#submit').prop('disabled', true); 
            $('#add').prop('disabled', false);
          }
        });
      });
    </script>
    <?php include '../include/script.php' ?>
  </body>
</html>

<?php 
    if(isset($_POST['submit'])){
        $course_id = $_POST['course'];
        
        $query3 = "SELECT * FROM `teacher_assign` WHERE course_id = $course_id";
        $sql3 = mysqli_query($conn, $query3);
        $row3 = mysqli_fetch_assoc($sql3);
        $session_id = $row3['session_id'];
        $section_id = $row3['section_id'];

        $query4 = "UPDATE `teacher_assign` SET `status`= 1 WHERE `teacher_id`= $teacher_id AND `course_id`= $course_id";
        mysqli_query($conn, $query4);
        $n = count($_POST['catagory_name']);

        for($i=0; $i < $n ;$i++){
            $cname = $_POST['catagory_name'][$i];
            $cvalue = $_POST['catagory_value'][$i];

            $query = "INSERT INTO `num_dist`(`course_id`, `teacher_id`, `section_id`, `session_id`, `catagory_name`, `marks`) VALUES ($course_id, $teacher_id, $section_id, $session_id, '$cname', $cvalue)";
            mysqli_query($conn, $query);
        }
    }
?>