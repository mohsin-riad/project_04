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
              <h3 class="page-header"><i class="fa fa-check-square" aria-hidden="true"></i>Running Courses</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-check-square" aria-hidden="true"></i></i>Running Courses</li>
              </ol>
            </div>
          </div>
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
         </div>
         <div class="col-md-1"></div>
          <div class="col-md-8 portlets" id="course_list">
              <section class="panel">
                <header class="panel-heading">
                  My Running Courses
                </header>
                <table class="table" id="myTable">
                  <thead>
                    <tr></tr>
                  </thead>
                  <tbody>
                    <tr></tr>
                  </tbody>
                  <!-- used in ajax -->
                </table>
              </section>
            </div>
          </div>
        </section>
      </section>
    </section>
    <?php include '../include/script.php' ?>
    <script>
      $(document).ready(function(){
        //hiding course section
        $('#course_list').hide();
        $('#session').change(function(){
            var session = $('#session').val();
            if(session != " "){ $('#course_list').show(); }
            else{ $('#course_list').hide(); }
        });
        $("#session").change(function(){
          var session = $("#session").val();
          $('#myTable tbody').html(" ");
          //ajax used: 
          $.ajax({
            url: "get_ac_course.php",
            dataType: 'json',
            data : { "session_id" : session },
            success: function(data){
              //console.log(data);
              var a;
              $('#myTable thead tr').html("\
                <th>#ID</th>\
                <th>Course Title</th>\
                <th>Credit</th>\
                <th>Section</th>\
                <th>type</th>\
              ");
              for(i=0; i<data.length ;i++){
                if(i%2==0){a="success";}
                else {a="warning";}
                x = "<tr class='"+a+"'>"+
                "<td>  "+(i+1)+"  </td>\
                <td> "+data[i].course+" ("+data[i].course_type+") </td>"+
                "<td> "+data[i].credit+" </td>"+
                "<td>"+ data[i].section+" </td>"+
                "<td> "+data[i].type+" </td>"+
                "</tr> </tbody>";
                $('#myTable tbody').append(x);
              }
            }
          });
        });
      });
    </script>
  </body>
</html>



          