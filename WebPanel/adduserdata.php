<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';
$status = '';
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type'])) {
  $result = Manager::addUser($_POST['username'], $_POST['password'], $_POST['type']);
  if ($result == 'success') {
    $status = 'success';
  } elseif ($result == 'taken') {
    $status = 'taken';
  } else {
    $status = 'error';
  }
}

$location = Misc::appendParameters($_SESSION['previous-location'], 'status', 'adduser-' . $status);
header('Location: ' . $location);
exit;