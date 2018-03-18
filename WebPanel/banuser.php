<?php
require_once 'inc/inc.php';

$id = $_POST['id'];
$user = new User($id, 'id');
