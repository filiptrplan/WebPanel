<?php
require_once 'inc.php';
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}
$db = new DB();
?>