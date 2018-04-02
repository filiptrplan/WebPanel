<?php
require_once '../inc/inc.php';
class Api
{
  /*
  PLEASE REFER TO THE LAST STEP OF THE INSTALLATION OF THE README
  IN THIS FOLDER!!!
  */
  private static function encrypt($str)
  {
    //Replace the part between these comments
    $encrypted = base64_encode($str);
    $encrypted = md5($encrypted);
    $encrypted = strrev($encrypted);
    //End of comments
    return $encrypted;
  }

  private static function encryptLogin($username, $hwid, $type, $status)
  {
    $str = $username . $hwid . $status;
  
    $encrypted = self::encrypt($str);
  
    return $encrypted . str_pad($type, 3, '0', STR_PAD_LEFT);
  }
  public static function registerUser($username, $password, $type, $authkey)
  {
    if ($authkey == Config::get('api_authkey')) {
      $result = Manager::addUser($username, $password, $type);
      if ($result == 'success') {
        $status = 'success';
      } elseif ($result == 'taken') {
        $status = 'taken';
      } else {
        $status = 'error';
      }
    } else {
      $status = 'invalidkey';
    }
    return self::encrypt($status);
  }
  public static function checkLogin($reqUsername, $reqPassword, $reqHwid)
  {
    $loggedIn = Auth::login($reqUsername, $reqPassword);
    if ($loggedIn == 'success') {
      $user = new User($reqUsername, 'username');
      if (!$user->isBanned()) {
        if ($user->getHWID() == '') {
          Manager::setHWID($user, $reqHwid);
          return self::encryptLogin($reqUsername, $reqHwid, $user->getType(), 'success');
        } elseif ($user->getHWID() == $reqHwid) {
          return self::encryptLogin($reqUsername, $reqHwid, $user->getType(), 'success');
        } else {
          return self::encryptLogin($reqUsername, $reqHwid, '0', 'wronghwid');
        }
      } else {
        return self::encryptLogin($reqUsername, $reqHwid, '0', 'banned');
      }
    } else {
      return self::encryptLogin($reqUsername, $reqHwid, '0', 'invalid');
    }
  }
}
