<?php
require_once 'inc.php';
if (!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin() || $_SESSION['user']->isBanned()) {
  header('Location: login.php');
  exit;
}
