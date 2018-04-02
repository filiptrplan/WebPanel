<?php
require_once '../../inc/inc.php';
require_once '../api.php';

if (isset($_POST['type']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['authkey'])) {
  $reqType = $_POST['type'];
  $reqUsername = $_POST['username'];
  $reqPassword = $_POST['password'];
  $authKey = $_POST['authkey'];
  echo Api::registerUser($reqUsername, $reqPassword, $reqType, $authKey);
}
