<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';

$status = '';
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $user = new User($id, 'id');
  $result = Manager::banUser($user);
  if ($result == 1) {
    $status = 'success';
  } else {
    $status = 'error';
  }
}

$location = Misc::appendParameters($_SESSION['previous-location'], 'status', 'banuser-' . $status);
if ($status == 'error') {
  $location = Misc::appendParameters($location, 'errormsg', $result);
}

header('Location: ' . $location);
exit;
