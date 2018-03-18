<?php
require_once 'inc.php';

class Manager
{
    public static function banUser($user)
    {
        $id = $user->getId();
        return DB::query('UPDATE users SET ban=1 WHERE id=:id', array(':id' => $id));
    }
    public static function addUser($username, $password, $type)
    {
        $options = [
            'cost' => 14,
        ];
        $hashed = password_hash($password, PASSWORD_BCRYPT, $options);

        return DB::query(
            'INSERT INTO users (username, password, type) VALUES (:username, :password, :type)',
         array(':username' => $username, ':password' => $hashed, ':type' => $type)
        );
    }
    public static function removeUser($user)
    {
        $id = $user->getId();
        return DB::query('DELETE FROM users WHERE id=:id', array(':id' => $id));
    }
    public static function pardonUser($user)
    {
        $id = $user->getId();
        return DB::query('UPDATE users SET ban=0 WHERE id=:id', array(':id' => $id));
    }
    public static function getUsers()
    {
        $rows = DB::select('SELECT * FROM users', array());
        return $rows;
    }
}
