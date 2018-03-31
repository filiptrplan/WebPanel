<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';

$id = $_POST['id'];
$location = $_SESSION['previous-location'];
$user = new User($id, 'id');
if (Manager::banUser($user) == 1) {
  $_SESSION['status'] = 'success';
} else {
  $_SESSION['status'] = 'error';
}
$_SESSION['action'] = 'banuser';

header('Location: ' . $location);
exit;
