<?php
include_once('sql.php');

switch ($_GET['do']) {
  case 'check':
   $sql = "SELECT * FROM admin WHERE acc='".$_POST['acc']."' and pwd='".$_POST['pwd']."'";
   $re = $db->query($sql)->fetchAll();

   if($re){
     $_SESSION['admin']=$_POST['acc'];
     header("location:admin.php");
   }
   else{
     echo '<script>alert("您輸入的帳號或密碼錯誤");location.replace("login.php")</script>';
   }
    break;
  case 'logout':
    unset($_SESSION['admin']);
    header('location:login.php');
  break;
  case 'smallInsert':
 $sql = "INSERT INTO small_slider(`display`) VALUE (0)";
   $db->query($sql);
   header('location:admin.php?do=small_slider');
  break;
  case 'smallUpdate':
    foreach ($_POST as $do => $row) {
      foreach ($row as $key => $value) {
     $db->query("UPDATE small_slider SET ".$do."='".$value."' WHERE id=".$key."");
    //  echo $sql=("UPDATE small_slider SET ".$do."='".$value."' WHERE id=".$key."");
     echo "<br>";
    }
  }
  header('location:admin.php?do=small_slider') ;
    



//  $db->query("UPDATE small_slider SET 'ch_name=1' WHERE id ='.$_POST['id'].'");
//  header('location:admin.php');
   print_r ($_POST);
  //  print_r ($_GET);
  
  break;
  
}






?>