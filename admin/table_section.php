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
    <title>Admin control panel</title>
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
              <h3 class="page-header"><i class="fa fa-laptop"></i> Table-Section</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Table-Section</li>
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
                            <th>Name</th>
                            <th>Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            include '../include/connection.php'; 
                            $qry="SELECT * FROM `sections`";
                            $r=mysqli_query($conn,$qry);
                            $i=1;
                            while($row=mysqli_fetch_array($r)){
                                ?>
                                <tr><td><?php echo $i++; ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['semester'] ?></td>
                                </tr>
                            <?php 
                            } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Semester</th>
                        </tr>
                    </tfoot>
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