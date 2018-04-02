<?php
require_once '../../inc/inc.php';
require_once '../api.php';

if (isset($_GET['hwid']) && isset($_GET['username']) && isset($_GET['password']) && isset($_GET['authkey'])) {
  $reqHwid = $_GET['hwid'];
  $reqUsername = $_GET['username'];
  $reqPassword = $_GET['password'];
  $authKey = $_GET['authkey'];
  echo Api::checkLogin($reqUsername, $reqPassword, $reqHwid, $authKey);
}
