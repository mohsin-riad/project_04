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
    <title>Admin (manage sessions)</title>
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
              <h3 class="page-header"><i class="fa fa-laptop"></i>Manage Session</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Manage Session</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Activate A Session</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                    <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Session</label>
                            <div class="col-lg-10">
                            <select name="session_id" id="session1" class="form-control">
                                <option value="">- Choose Session -</option>
                                <?php
                                    $query = "SELECT * FROM `sessions` WHERE `status` = 0";
                                    $sql = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($sql))
                                    {?>
                                        <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                    <?php
                                    }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" id ="submit1" name ="submit1" class="btn btn-success">Activate</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Deactivate A Session</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Session</label>
                            <div class="col-lg-10">
                            <select name="session_id" id="session2" class="form-control">
                                <option value="">- Choose Session -</option>
                                <?php
                                    $query = "SELECT * FROM `sessions` WHERE `status` = 1";
                                    $sql = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($sql))
                                    {?>
                                        <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                    <?php
                                    }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" id="submit2" name = "submit2" class="btn btn-danger">Deactivate</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>
        </section>
      </section>
    </section>
    <script>
      $(document).ready(function(){
        $('#submit1').click(function(){
          alert("Session has been successfully Activated!!");
        });
        $('#submit2').click(function(){
          alert("Session has been successfully Deactivated!!");
        });
      });
    </script>
    <?php include '../include/script.php' ?>
  </body>
</html>

<?php 
    if(isset($_POST['submit1']))
    {
        //recvd data from input/control
        $session_id = $_POST['session_id'];
        $query = "UPDATE `sessions` SET `status`=1 WHERE id = $session_id";
        mysqli_query($conn, $query);
    }
    else if(isset($_POST['submit2']))
    {
        //recvd data from input/control
        $session_id = $_POST['session_id'];
        $query = "UPDATE `sessions` SET `status`=0 WHERE id = $session_id";
        mysqli_query($conn, $query);
    }
?>