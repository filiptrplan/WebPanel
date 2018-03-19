<?php
require_once 'inc/inc.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin() || $_SESSION['user']->isBanned()) {
  header('Location: login.php');
  exit;
}


$id = $_POST['id'];
$location = $_SESSION['previous-location'];
$user = new User($id, 'id');
if (Manager::removeUser($user) == 1) {
  $_SESSION['status'] = 'success';
} else {
  $_SESSION['status'] = 'error';
}
$_SESSION['action'] = 'removeuser';

header('Location: ' . $location);
exit;
