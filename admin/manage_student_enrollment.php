<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'admin'){
      session_destroy();
      header('Location: ../unauthorised_user.php');
    }
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Admin (manage requests)</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/link.php' ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  </head>
  <body>
    <section id="container" class="">
      <?php include '../include/navbar.php' ?>
      <?php include '../include/sidebar.php' ?>
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-laptop"></i> Enrollment requests</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Enrollment requests</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-2"></div>
            <div class="col-6">
                <table id="example" class="display" style="width:95%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Student ID</th>
                            <th>Course code</th>
                            <th>Course type</th>
                            <th>Section</th>
                            <th>Session</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            include '../include/connection.php'; 
                            $qry="SELECT * FROM `enrollment` WHERE status=0";
                            $r=mysqli_query($conn,$qry);
                            $i=1;
                            while($row=mysqli_fetch_array($r)){
                                $student_id = $row['student_id'];
                                $course_id = $row['course_id'];
                                $type_id = $row['type_id'];
                                $section_id = $row['section_id'];
                                $session_id = $row['session_id'];

                                $qry="SELECT * FROM `courses` WHERE id=$course_id";
                                $r1=mysqli_query($conn,$qry);
                                $row1=mysqli_fetch_array($r1);
                                $course=$row1['code'];

                                $qry="SELECT * FROM `type` WHERE id=$type_id";
                                $r2=mysqli_query($conn,$qry);
                                $row2=mysqli_fetch_array($r2);
                                $type=$row2['name'];

                                $qry="SELECT * FROM `sections` WHERE id=$section_id";
                                $r3=mysqli_query($conn,$qry);
                                $row3=mysqli_fetch_array($r3);
                                $section=$row3['name'];

                                $qry="SELECT * FROM `sessions` WHERE id=$session_id";
                                $r4=mysqli_query($conn,$qry);
                                $row4=mysqli_fetch_array($r4);
                                $session=$row4['name'];

                                ?>
                                <tr><td><?php echo $i++; ?></td>
                                    <td><?php echo $student_id ?></td>
                                    <td><?php echo $type ?></td>
                                    <td><?php echo $section ?></td>
                                    <td><?php echo $session ?></td>
                                    <td><?php echo $course ?></td>
                                    <td>
                                      <a class="btn btn-primary" href="approve-enrollment.php?id=<?php echo $row['id']?>">Approve</a>
                                      <a class="btn btn-danger" data-toggle="modal" data-target="#mm<?php echo $row['id']?>">Delete</a>
                                      <!-- The Modal -->
                                      <div class="modal" id="mm<?php echo $row['id']?>">
                                          <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Delete Confirmation!!!</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Are you sure to delete <b><?php echo $student_id ?></b>'s request ?
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <a href="delete-enrollment.php?id=<?php echo $row['id']?>" class="btn btn-success">Yes</a>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                          </div>
                                      </div>
                                  </td>
                                </tr>
                            <?php 
                            } 
                        ?>
                    </tbody>
                    
                </table>
            </div>
            <div class="col-2"></div>
          </div>
        </section>
      </section>
    </section>
    <?php include '../include/script.php' ?>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // $('#example').DataTable();
            $('#example').DataTable( {
                "paging":   true,
                "ordering": false,
                "info":     false
            } );
        } );
    </script>
  </body>
</html>