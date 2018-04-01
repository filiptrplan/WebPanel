<!DOCTYPE html>
<html lang="en">
<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';


$previousLocation = $_SESSION['previous-location'];
$previousAction = $_SESSION['action'];
$_SESSION['action'] = 'adduser';
$_SESSION['status'] = 'none';
$_SESSION['previous-location'] = $_SERVER['REQUEST_URI'];
$status = $_SESSION['status'];
?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.min.css">
    
    <title>Add user</title>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- NAVIGATION -->
        <div class="col-sm-2 bg-light" id="navbar">
          <nav class="nav flex-column">
            <a class="nav-link navitem selected" href="#">Add User</a>
            <a class="nav-link navitem" href="bannedusers.php">Banned Users</a>
            <a class="nav-link navitem" href="userlist.php">User List</a>
            <a class="nav-link navitem" href="#" data-toggle="modal" data-target="#logoutmodal">Logout</a>
          </nav>
        </div>
        <div class="col-sm-10" id="content">
          <!-- LOGOUT MODAL -->
          <div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ban User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Do you really want to logout?
                </div>
                <div class="modal-footer">
                  <form action="logout.php" method="post">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input class="btn btn-danger" type="submit" value="Logout">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/plugins-dist.js"></script>
  </body>

</html>