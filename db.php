<?php ob_start(); session_start();
require_once 'vendor/autoload.php';
date_default_timezone_set('Europe/Istanbul');
$db = new MysqliDb(Array('host' => 'localhost',
'username' => 'root',
'password' => '',
'db'=> 'toroscafe',
'port' => 3307,
'prefix' => 'to_',
'charset' => 'utf8'));
