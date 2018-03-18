<?php
require_once 'inc.php';

DB::connect();
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
