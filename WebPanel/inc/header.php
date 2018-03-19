<?php
require_once 'inc.php';
require_once 'user.php';

DB::connect();
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['previous-location'])) {
  $_SESSION['previous-location'] = 'none';
}
if (!isset($_SESSION['action'])) {
  $_SESSION['action'] = 'none';
}
if (!isset($_SESSION['status'])) {
  $_SESSION['status'] = 'none';
}
