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
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Admin control panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/link.php' ?>
  </head>
  <body>
    <section id="container" class="">
      <?php include '../include/navbar.php' ?>
      <?php include '../include/teacher_sidebar.php' ?>
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Dashboard</li>
              </ol>
            </div>
          </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Quick Post</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="title">Title</label>
                          <div class="col-lg-10">
                            <input type="text" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="content">Content</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-lg-2">Category</label>
                          <div class="col-lg-10">
                            <select class="form-control">
                              <option value="">- Choose Cateogry -</option>
                              <option value="1">General</option>
                              <option value="2">News</option>
                              <option value="3">Media</option>
                              <option value="4">Funny</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="tags">Tags</label>
                          <div class="col-lg-10">
                            <input type="text" class="form-control" id="tags">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" class="btn btn-primary">Publish</button>
                            <button type="submit" class="btn btn-danger">Save Draft</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                          </div>
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
    <?php include '../include/script.php' ?>
    </body>
  </html>