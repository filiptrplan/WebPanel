<?php

class Api{
  /*
  PLEASE REFER TO THE LAST STEP OF THE INSTALLATION OF THE README
  IN THIS FOLDER!!!
  */
  private static function encrypt($username, $hwid, $status)
  {
    $encrypted = $username . $hwid . $status;
    //Replace the part between these comments
    $encrypted = base64_encode($encrypted);
    $encrypted = md5($encrypted);
    $encrypted = strrev($encrypted);
    //End of comments
    return $encrypted;
  }

  public static function checkLogin($reqUsername, $reqPassword, $reqHwid){
    $loggedIn = Auth::login($reqUsername, $reqPassword);
    if ($loggedIn == 'success') {
      $user = new User($reqUsername, 'username');
      if (!$user->isBanned()) {
        if ($user->getHWID() == '') {
          Manager::setHWID($user, $reqHwid);
          return self::encrypt($reqUsername, $reqHwid, 'success');
        } elseif ($user->getHWID() == $reqHwid) {
          return self::encrypt($reqUsername, $reqHwid, 'success');
        } else {
          return self::encrypt($reqUsername, $reqHwid, 'wronghwid');
        }
      } else {
        return self::encrypt($reqUsername, $reqHwid, 'banned');
      }
    } else {
      return self::encrypt($reqUsername, $reqHwid, 'invalid');
    }
  }
}
