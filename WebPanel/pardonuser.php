<?php
require_once 'inc/inc.php';

$id = $_POST['id'];
$location = $_SESSION['previous-location'];
$user = new User($id, 'id');
Manager::pardonUser($user);
header('Location: ' . $location);
exit;
