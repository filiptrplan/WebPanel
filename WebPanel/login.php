<!DOCTYPE html>
<html lang="en">
  <?php
    require_once 'inc/inc.php';
    $previousLocation = $_SESSION['previous-location'];
    $previousAction = $_SESSION['action'];
    $status = $_SESSION['status'];
    $_SESSION['action'] = 'login';
    $_SESSION['status'] = 'none';
    $_SESSION['previous-location'] = $_SERVER['REQUEST_URI'];
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $result = Auth::login($_POST['username'], $_POST['password']);
        echo $result;
    }
  ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/login.css">
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
      </div>
      <div class="col-lg-4 align-self-end"></div>
    </div>
  </div>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>