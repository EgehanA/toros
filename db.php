<?php ob_start(); session_start();
require_once 'vendor/autoload.php';
date_default_timezone_set('Europe/Istanbul');
$db = new MysqliDb(Array('host' => 'localhost',
'username' => 'root',
'password' => '',
'db'=> 'toros',
'port' => 3306,
'prefix' => 'to_',
'charset' => 'utf8'));
