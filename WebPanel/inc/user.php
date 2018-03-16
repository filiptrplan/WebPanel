<?php
require_once 'inc.php';
require 'header.php';

class User
{
    private $id;
    private $username;
    private $password;
    private $hwid;
    private $ban;
    private $type;

  
    public function __construct($data, $type)
    {
        if ($type === 'id') {
            $rows = DB::select('SELECT * FROM users WHERE id=:id', array(':id' => $data));
            var_dump($rows[0]);
        } elseif ($type === 'username') {
            $rows = DB::select('SELECT * FROM users WHERE username=:username', array(':username' => $data));
        } else {
            echo "Invalid Type!";
        }
    }
}
