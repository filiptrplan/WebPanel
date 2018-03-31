<?php
class Config{
  public static function get($name){
    $config = parse_ini_file('config.ini');
    return $config[$name];
  }
}