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
              <h3 class="page-header"><i class="fa fa-check-square-o" aria-hidden="true"></i>Result</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-check-square-o" aria-hidden="true"></i>Result</li>
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
                              $id = $_SESSION['id'];
                              $qry = "SELECT  distinct sessions.id,name FROM sessions,marks_assign WHERE marks_assign.student_id=$id AND sessions.id = marks_assign.session_id";
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
            <div class="col-md-1"></div>
            <div class="col-md-8 portlets" id="result_list">
                <section class="panel">
                    <header class="panel-heading">
                    My result
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
          </form>
        </section>
      </section>
    </section>
    <script>
      $(document).ready(function() {
        //hiding course section
        $('#result_list').hide();
        $('#session').change(function(){
            var session = $('#session').val();
            if(session != " "){ $('#result_list').show(); }
            else{ $('#result_list').hide(); }
        });
        $("#session").change(function(){
          var session = $("#session").val();
          $('#myTable tbody').html(" ");
          //ajax used: 
          $.ajax({
            url: "marks_calculation.php",
            dataType: 'json',
            data : { "session_id" : session },
            success: function(data){
              //console.log(data);
              var a;
              $('#myTable thead tr').html("\
                <th>Course code</th>\
                <th>Course title</th>\
                <th>Total</th>\
                <th>Grade</th>\
                <th>CGPA</th>\
              ");
              for(i=0; i<data.length ;i++){
                if(i%2==0){a="success";}
                else {a="active";}
                x = "<tr class='"+a+"'>"+
                "<td>  "+data[i][0]+"  </td>"+
                "<td> "+data[i][1]+"  </td>"+
                "<td>"+data[i][2]+" </td>"+
                "<td> "+ data[i][4]+" </td>"+
                "<td> "+data[i][3]+" </td>"+
                "</tr> </tbody>";
                $('#myTable tbody').append(x);
              }
            }
          });
        });
      });
    </script>
    <?php include '../include/script.php' ?>
  </body>
</html>