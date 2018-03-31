<?php
require_once 'inc/inc.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin() || $_SESSION['user']->isBanned()) {
  header('Location: login.php');
  exit;
}


$id = $_POST['id'];
$location = $_SESSION['previous-location'];
$user = new User($id, 'id');
 $_SESSION['status'] = 'success';
if (isset($_POST['hwid'])){
  if(Manager::setHWID($user, $_POST['hwid']) != 1){
    $_SESSION['status'] = 'error';
  }
}
if (isset($_POST['username']) && !empty($_POST['username'])){
  if(Manager::setUsername($user, $_POST['username']) != 1){
    $_SESSION['status'] = 'error';
  }
}
if (isset($_POST['password']) && !empty($_POST['password'])){
  if(Manager::setPassword($user, $_POST['password']) != 1){
    $_SESSION['status'] = 'error';
  }
}

$_SESSION['action'] = 'edituser';
header('Location: ' . $location);
exit;
