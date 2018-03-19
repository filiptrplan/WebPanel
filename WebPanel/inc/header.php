<?php
require_once 'inc.php';
require_once 'user.php';

DB::connect();
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
