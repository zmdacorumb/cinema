<?php
session_start();
// $db=new PDO("mysql:host=220.128.133.15;dbname=cinema;charset=utf8","root","s1080207",null);
$db=new PDO("mysql:host=127.0.0.1;dbname=cinema;charset=utf8","root","",null);
date_default_timezone_set('Asia/Taipei');
//在連sql前加下面這段 把單.雙引號清掉
?>