<?php
require 'inc.php';
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}
?>