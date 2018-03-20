<?php

class Api{
  /*
  PLEASE REFER TO THE LAST STEP OF THE INSTALLATION OF THE README
  IN THIS FOLDER!!!
  */
  private static function encrypt($username, $hwid, $type, $status)
  {
    $encrypted = $username . $hwid . $status;
    //Replace the part between these comments
    $encrypted = base64_encode($encrypted);
    $encrypted = md5($encrypted);
    $encrypted = strrev($encrypted);
    //End of comments
    return $encrypted . str_pad($type, 3, '0', STR_PAD_LEFT);
  }

  public static function checkLogin($reqUsername, $reqPassword, $reqHwid){
    $loggedIn = Auth::login($reqUsername, $reqPassword);
    if ($loggedIn == 'success') {
      $user = new User($reqUsername, 'username');
      if (!$user->isBanned()) {
        if ($user->getHWID() == '') {
          Manager::setHWID($user, $reqHwid);
          return self::encrypt($reqUsername, $reqHwid, $user->getType(), 'success');
        } elseif ($user->getHWID() == $reqHwid) {
          return self::encrypt($reqUsername, $reqHwid, $user->getType(), 'success');
        } else {
          return self::encrypt($reqUsername, $reqHwid, '0', 'wronghwid');
        }
      } else {
        return self::encrypt($reqUsername, $reqHwid, '0', 'banned');
      }
    } else {
      return self::encrypt($reqUsername, $reqHwid, '0', 'invalid');
    }
  }
}
