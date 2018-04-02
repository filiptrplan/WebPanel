<?php
require_once '../../inc/inc.php';
require_once '../api.php';

if (isset($_GET['username']) && isset($_GET['password']) && isset($_GET['authkey'])) {
  $reqType = Config::get('user_defaulttype');
  $reqUsername = $_GET['username'];
  $reqPassword = $_GET['password'];
  $authKey = $_GET['authkey'];
  echo Api::registerUser($reqUsername, $reqPassword, $reqType, $authKey);
}
