<?php
require_once 'inc.php';
DB::connect();
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
$user = new User(1, 'id');
$user->isAdmin();
