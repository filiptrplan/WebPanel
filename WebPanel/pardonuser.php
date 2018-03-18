<?php
require_once 'inc/inc.php';

$id = $_POST['id'];
$location = $_SESSION['previous-location'];
$user = new User($id, 'id');
if (Manager::pardonUser($user) == 1) {
    $_SESSION['status'] = 'success';
} else {
    $_SESSION['status'] = 'error';
}
$_SESSION['action'] = 'pardonuser';

header('Location: ' . $location);
exit;
