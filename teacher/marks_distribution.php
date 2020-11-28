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
              <h3 class="page-header"><i class="fa fa-indent" aria-hidden="true"></i>Marks Distribution</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-indent" aria-hidden="true"></i>Distribute</li>
              </ol>
            </div>
          </div>
          <div class="row">
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
                          <label for="">Select Session</label>
                          <select class="form-control" name="session" id="session">
                            <option value="">-select session-</option>
                            <?php
                              $teacher_id = $_SESSION['id'] ; 
                              $query = "SELECT DISTINCT `session_id` FROM `teacher_assign` WHERE teacher_id = $teacher_id AND `status` = 0";
                              $sql = mysqli_query($conn, $query);
                              while($row = mysqli_fetch_array($sql)){
                                  $session_id = $row['session_id'];
                                  $query1 = "SELECT * FROM `sessions` WHERE id = $session_id";
                                  $sql1 = mysqli_query($conn, $query1);
                                  $row1 = mysqli_fetch_assoc($sql1);
                                  ?>
                                  <option value="<?php echo $session_id; ?>"><?php echo $row1['name']; ?></option>
                                  <?php
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group" id="crs">
                          <label for="">Select course (specific section)</label>
                          <select class="form-control" name="course" id="course">
                          </select>
                        </div>
                        <div class="form-group" id="sec">
                        </div>
                        <div class="form-group">
                            <button name="add" id="add" class="btn btn-success">Add</button>
                        </div>
                        <div id="dynamic_row" class="form-group row">
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
      $(document).ready(function() {
        //hiding course section
        $('#crs').hide();
        $('#sec').hide();
        $('#session').change(function(){
            var session = $('#session').val();
            if(session != ""){
                $('#crs').show();
                $('#crs').change(function(){
                  var course = $('#course').val();
                  if(course != ""){
                    $('#sec').show();
                  }
                  else{
                    $('#sec').hide();
                  }
                });
            }
            else{
                $('#crs').hide();
                $('#sec').hide();
            }
        });
        var session_id;
        $("#session").change(function() {
          session_id = $("#session").val();
          $.ajax({
            url: "get_course.php",
            dataType: 'json',
            data: {
              "session_id" : session_id
            },
            success: function(data) {
              console.log(data);
              $("#course").html('<option value="">-select course-</option>');
              for(i=0; i<data.length;i++){
                var x = '<option value="'+data[i].course_id+'">'+data[i].course_name+'</option>';
                $("#course").append(x);
              }
            }
          });
        });
        $("#course").change(function() {
          var course_id = $("#course").val();
          var session_id1 = session_id;
          //alert(course_id+'|'+session_id1); 
          $.ajax({
            url: "get_section.php",
            dataType: 'json',
            data: {
              "session_id" : session_id1,
              "course_id" : course_id
            },
            success: function(data) {
              console.log(data);
              $("#sec").html('<label class="form-check-label" >Sections: </label>');
              for(i=0; i<data.length;i++){
                var x = '&emsp;<input type="checkbox" name="check_section[]" value="'+data[i].section_id+'">'+data[i].section_name+'&emsp;';
                $("#sec").append(x);
              }
            }
          });
        });
      });
    </script>
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
      if(!empty($_POST['check_section'])){
        $session_id = $_POST['session'];
        $course_id = $_POST['course'];
        $section_id=[];
        $i=0;
        foreach($_POST['check_section'] as $selected) {$section_id[$i] = $selected; $i++;}
        $n = count($section_id);
        $c = count($_POST['catagory_name']);
        for($i=0; $i<$n ;$i++){
          
          $query4 = "UPDATE `teacher_assign` SET `status`= 1 WHERE `teacher_id`= $teacher_id AND `session_id` AND `course_id`= $course_id AND `section_id` = $section_id[$i]";
          mysqli_query($conn, $query4);

          for($j=0; $j < $c ;$j++){
              $cname = $_POST['catagory_name'][$j];
              $cvalue = $_POST['catagory_value'][$j];

              $query = "INSERT INTO `num_dist`(`course_id`, `teacher_id`, `section_id`, `session_id`, `catagory_name`, `marks`) VALUES ($course_id, $teacher_id, $section_id[$i], $session_id, '$cname', $cvalue)";
              mysqli_query($conn, $query);
          }
        }
      }
    }
?>