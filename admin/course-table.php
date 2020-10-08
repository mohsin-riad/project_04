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
    include '../include/connection.php';
?>


<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Admin (course table)</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/link.php' ?>
  </head>
  <body>
    <section id="container" class="">
      <?php include '../include/navbar.php' ?>
      <?php include '../include/sidebar.php' ?>
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-laptop"></i>All Courses</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Course Table</li>
              </ol>
            </div>
          </div>
          <div class='row'>
            <div class="col-lg-10">
              <table class="table table-dark table-striped">
                  <thead>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Type</th>
                      <th>Credit</th>
                      <th>Action</th>
                  </thead>
                  <tbody>
                      <?php 
                          $qry="SELECT * FROM `courses`";
                          $r=mysqli_query($conn,$qry);
                          while($row=mysqli_fetch_array($r)){ ?>
                              <tr>
                                  <td> <?php echo $row['name']?> </td>
                                  <td> <?php echo $row['code']?> </td>
                                  <td> <?php echo $row['type']?> </td>
                                  <td> <?php echo $row['credit']?> </td>
                                  <td>
                                      <a class="btn btn-primary" href="edit-courses.php?id=<?php echo $row['id']?>">Edit</a>
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
                                                    Are you sure to delete <b><?php echo $row['name'] ?></b> ?
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <a href="delete-courses.php?id=<?php echo $row['id']?>" class="btn btn-success">Yes</a>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                        <?php } ?>
                  </tbody>
              </table>
            </div>
          </div>
        </section>
      </section>
    </section>
    <?php include '../include/script.php' ?>
  </body>
</html>