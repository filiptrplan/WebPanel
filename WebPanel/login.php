<!DOCTYPE html>
<html lang="en">
<?php
  require_once 'inc/inc.php';
  $previousLocation = $_SESSION['previous-location'];
  $previousAction = $_SESSION['action'];
  $_SESSION['action'] = 'login';
  $_SESSION['status'] = 'none';
  $_SESSION['previous-location'] = $_SERVER['REQUEST_URI'];
  if (isset($_POST['username']) && isset($_POST['password'])) {
      $result = Auth::login($_POST['username'], $_POST['password']);
      if ($result == 'success') {
          $_SESSION['user'] = new User($_POST['username'], 'username');
          if (!$_SESSION['user']->isBanned()) {
              if ($_SESSION['user']->isAdmin()) {
                  header('Location: userlist.php');
                  exit;
              } 
          } else {
              unset($_SESSION['user']);
              $result = 'banned';
          }
      }
      $_SESSION['status'] = $result;
  }
  $status = $_SESSION['status'];

?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <title>Login</title>
  </head>

  <body>
    <div class="container" style="height: 100vh;">
      <div class="row" style="height: 90%;">
        <div class="col-lg-4 align-self-start"></div>
        <div class="col-lg-4 align-self-center">
          <form class="form" action="login.php" method="POST">
            <div class="form-group">
              <label for="usernameInput">Username</label>
              <input type="username" class="form-control" id="usernameInput" name="username" placeholder="Enter Username">
            </div>
            <div class="form-group">
              <label for="passwordInput">Password</label>
              <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password">
            </div>
            <input type="submit" value="Login" class="btn btn-primary">
          </form>
          <?php
            if ($previousAction == 'login') {
                if ($status == 'success') {
                    echo '<div class="alert alert-success mt-2" role="alert">Logged in!</div>';
                } elseif ($status == 'invalid') {
                    echo '<div class="alert alert-danger mt-2" role="alert">Invalid password!</div>';
                } elseif ($status == 'noexist') {
                    echo '<div class="alert alert-danger mt-2" role="alert">The user doesn\'t exist!</div>';
                }elseif ($status == 'banned') {
                    echo '<div class="alert alert-danger mt-2" role="alert">The user is banned!</div>';
                }
            }
          ?>
        </div>
        <div class="col-lg-4 align-self-end"></div>
      </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
  </body>

</html>