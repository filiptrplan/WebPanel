<!DOCTYPE html>
<html lang="en">
<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';

$users = Manager::getUsers();
$previousLocation = $_SESSION['previous-location'];
$previousAction = $_SESSION['action'];
$status = $_SESSION['status'];
$_SESSION['action'] = 'none';
$_SESSION['status'] = 'none';
$_SESSION['previous-location'] = $_SERVER['REQUEST_URI'];

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/template.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <title>User List</title>
</head>

<body>
  <div class="container-fluid">
    <!-- NAVIGATION -->
    <div class="row">
      <div class="col-md-2 bg-light" id="navbar">
        <nav class="nav flex-column">
            <a class="nav-link navitem" href="adduser.php">Add User</a>
            <a class="nav-link navitem" href="bannedusers.php">Banned Users</a>
            <a class="nav-link navitem selected" href="#">User List</a>
            <a class="nav-link navitem" href="#" data-toggle="modal" data-target="#logoutmodal">Logout</a>
        </nav>
      </div>
      <div class="col-md-10" id="content">
        <input type="text" class="form-control mt-3 mb-3" id="search-input" aria-label="Search" placeholder="Search">
        <?php
          if ($previousAction == 'banuser') {
            if ($status == 'success') {
              echo '<div class="alert alert-success mt-2" role="alert">Successfully banned the user!</div>';
            } elseif ($status == 'error') {
              echo '<div class="alert alert-danger mt-2" role="alert">Unknown error!</div>';
            }
          }
        ?>
        <!-- USER LIST -->
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">HWID</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($users as $user) {
                if ($user['ban'] == 0) {
                  echo '<tr>
                          <th scope="row">' . $user['id'] . '</th>
                          <td class="username-field">' . $user['username'] . '</td>
                          <td>' . $user['hwid'] . '</td>
                          <td>
                          <button type="button" class="btn btn-danger banbtn" data-toggle="modal" data-target="#banmodal" data-id="' . $user['id'] .'">Ban</button>
                          <form action="edituser.php" method="get">
                            <input type="hidden" value="' . $user['id'] . '" name="id">
                            <input type="submit" class="btn btn-info editbtn" data-toggle="modal" value="Edit">
                          </form>
                          </td>
                        </tr>';
                }
              }
            ?>
          </tbody>
        </table>
        <!-- BAN MODAL -->
        <div class="modal fade" id="banmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ban User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Do you really want to ban this user?
              </div>
              <div class="modal-footer">
                <form action="banuser.php" method="post">
                  <input class="id-input" type="hidden" value="" name="id">
                  <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                  <input class="btn btn-danger" type="submit" value="Ban">
                </form>
              </div>
            </div>
          </div>
        </div>
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
  <script src="js/bootstrap.min.js"></script>
  <script src="js/userlist.js"></script>
</body>

</html>