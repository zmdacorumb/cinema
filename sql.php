<?php
session_start();
$db=new PDO("mysql:host=127.0.0.1;dbname=cinema;charset=utf8","root","",null);
date_default_timezone_set('Asia/Taipei');

function select($tb,$wh){
  global $db;
  return $db->query("select * from ".$tb." where ".$wh)->fetchAll();
}


?>