<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
  $id = $_POST['id'];
  $user = new User($id, 'id');
}
$status = 'success';
if (isset($_POST['hwid'])){
  $result = Manager::setHWID($user, $_POST['hwid']);
  if($result != 1){
    $status = 'error';
  }
}
if (isset($_POST['username']) && !empty($_POST['username'])){
  $result = Manager::setUsername($user, $_POST['username']);
  if($result != 1 && $_POST['username'] != $user->getUsername()){
    $status = 'error';
  }
}
if (isset($_POST['password']) && !empty($_POST['password'])){
  $result = Manager::setPassword($user, $_POST['password']);
  if($result != 1){
    $status = 'error';
  }
}

$location = Misc::appendParameters($_SESSION['previous-location'], 'status', 'edituser-' . $status);
header('Location: ' . $location);
exit;
