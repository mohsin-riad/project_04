<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Admin control panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'include/link.php' ?>
  </head>
  <body>
    <section id="container" class="">
      <?php include 'include/navbar.php' ?>
      <?php include 'include/sidebar.php' ?>
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-laptop"></i> Teacher Creation</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                <li><i class="fa fa-laptop"></i>Teacher</li>
              </ol>
            </div>
          </div>
            <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Enter Teacher Information</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    <div class="form quick-post">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="name">Name</label>
                          <div class="col-lg-10">
                            <input type="text" name = "name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Email</label>
                        <div class="col-lg-10">
                            <input type="text" name = "email" class="form-control">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-lg-2" for="tags">Password</label>
                          <div class="col-lg-10">
                            <input type="text" name = "password" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" name= "submit" class="btn btn-primary">Create</button>
                            
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
    <?php include 'include/script.php' ?>
    </body>
  </html>