<!DOCTYPE html>
<html lang="en">
<?php
require_once 'inc/inc.php';
$status = '';

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
  $status = 'login-' . $result;
}

?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.min.css">
    
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
        if ($status == 'login-success') {
          echo '<div class="alert alert-success mt-2" role="alert">Logged in!</div>';
        } elseif ($status == 'login-invalid') {
          echo '<div class="alert alert-danger mt-2" role="alert">Invalid password!</div>';
        } elseif ($status == 'login-noexist') {
          echo '<div class="alert alert-danger mt-2" role="alert">The user doesn\'t exist!</div>';
        } elseif ($status == 'login-banned') {
          echo '<div class="alert alert-danger mt-2" role="alert">The user is banned!</div>';
        }
      
      ?>
          <p class="version-disclaimer-text"><small>WebPanel v<?php echo Config::get('webpanel_version'); ?> by 1234filip</small></p>
        </div>
        <div class="col-lg-4 align-self-end"></div>
      </div>
    </div>
    <script src="js/plugins-dist.js"></script>
  </body>

</html>