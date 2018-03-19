<?php
require_once 'inc.php';

class Auth
{
  /*
  Simple function to check the username and the password inputed
  Return 'success' for a match, returns 'noexist' for no existing username and 'invalid'
  for invalid
  */
  public static function login($username, $password)
  {
    $rows = DB::select('SELECT * FROM users WHERE username=:username', array(':username' => $username));
    if (count($rows) == 0) {
      return 'noexist';
    }
    $user = $rows[0];
    $correctPassword = password_verify($password, $user['password']);
    if ($correctPassword) {
      return 'success';
    } else {
      return 'invalid';
    }
  }
}
