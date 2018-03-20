<?php
require_once '../../inc/inc.php';
require_once '../api.php';


if (isset($_POST['hwid']) && isset($_POST['username']) && isset($_POST['password'])) {
  $reqHwid = $_POST['hwid'];
  $reqUsername = $_POST['username'];
  $reqPassword = $_POST['password'];

  echo Api::checkLogin($reqUsername, $reqPassword, $reqHwid);
}
