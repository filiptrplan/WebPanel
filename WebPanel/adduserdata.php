<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';

$_SESSION['action'] = 'adduser';
$location = $_SESSION['previous-location'];

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type'])) {
  $result = Manager::addUser($_POST['username'], $_POST['password'], $_POST['type']);
  if ($result == 'success') {
    $_SESSION['status'] = 'success';
  } elseif ($result == 'taken') {
    $_SESSION['status'] = 'taken';
  } else {
    $_SESSION['status'] = 'error';
  }
}

header('Location: ' . $location);
exit;