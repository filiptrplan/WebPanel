<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';


$id = $_POST['id'];
$user = new User($id, 'id');
if (Manager::pardonUser($user) == 1) {
  $status = 'success';
} else {
  $status = 'error';
}

$location = Misc::appendParameters($_SESSION['previous-location'], 'status', 'pardonuser-' . $status);

header('Location: ' . $location);
exit;
