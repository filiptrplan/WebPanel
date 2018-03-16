<?php
require_once 'inc.php';

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
            $result = $rows[0];
            $this->id = $result['id'];
            $this->username = $result['username'];
            $this->password = $result['password'];
            $this->hwid = $result['hwid'];
            $this->ban = $result['ban'];
            $this->type = $result['type'];
        } elseif ($type === 'username') {
            $rows = DB::select('SELECT * FROM users WHERE username=:username', array(':username' => $data));
            $result = $rows[0];
            $this->id = $result['id'];
            $this->username = $result['username'];
            $this->password = $result['password'];
            $this->hwid = $result['hwid'];
            $this->ban = $result['ban'];
            $this->type = $result['type'];
        } else {
            echo "Invalid Type!";
        }
    }

    public function isAdmin(){
        if($this->type === '100'){
            return true;
        }else{
            return false;
        }
    }

    public function getId(){
        return $this->id;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getHWID(){
        return $this->hwid;
    }
    public function isBanned(){
        if($this->ban == '0'){
            return false;
        }else{
            return true;
        }
    }
    public function getType(){
        return $this->type;
    }
}
