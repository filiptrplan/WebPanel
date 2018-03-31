<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';


$id = $_POST['id'];
$user = new User($id, 'id');
$status = 'success';
if (isset($_POST['hwid'])){
  if(Manager::setHWID($user, $_POST['hwid']) != 1){
    $status = 'error';
  }
}
if (isset($_POST['username']) && !empty($_POST['username'])){
  if(Manager::setUsername($user, $_POST['username']) != 1){
    $status = 'error';
  }
}
if (isset($_POST['password']) && !empty($_POST['password'])){
  if(Manager::setPassword($user, $_POST['password']) != 1){
    $status = 'error';
  }
}

$location = Misc::appendParameters($_SESSION['previous-location'], 'status', 'edituser-' . $status);
header('Location: ' . $location);
exit;
