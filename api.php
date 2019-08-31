<?php
session_start();
$db=new PDO("mysql:host=127.0.0.1;dbname=cinema;charset=utf8","root","",null);
date_default_timezone_set('Asia/Taipei');

switch ($_GET['do']) {
  // 登入確認
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
  // 登出鈕
  case 'logout':
    unset($_SESSION['admin']);
    header('location:login.php');
  break;
  // small slider 後台新增功能
  case 'smallInsert':
 $sql = "INSERT INTO small_movie(`display`) VALUE (0)";
   $db->query($sql);
   header('location:admin.php?do=small_movie');
  break;
  // small slider 後台更新功能
  case 'smallUpdate':
    foreach ($_POST as $do => $row) {
      foreach ($row as $key => $value) {
      $db->query("UPDATE small_movie SET ".$do."='".$value."' WHERE id=".$key."");
      switch ($do) {
        case 'del':
        $db->query("DELETE FROM small_movie WHERE id=".$value);
          break;   
      }
    }
  }
  header('location:admin.php?do=small_movie') ;
  break;
  // index card 電影介紹
  case 'movie':
  $sql = "SELECT * FROM small_movie";
  $rows=$db->query($sql)->fetchAll();
    foreach ($rows as $do => $row) {     
      
      ?>
      <div class="col-lg-3 my-4 ">
        <div class="card hoverMe" style="border: none">
        <a href="api.php?do=introduction&id=<?=$row['id']?>">
          <img class="card-img-top" src="img/small_movie/<?=$row['big_img']?>">
        </a>  
          <div class="card-body text-white">
            <h4 class="card-title font-weight-bolder h5" style="color:#000"><?=$row['ch_name']?></h4>
            <p class="card-text" style="color:#999; font-size:0.5rem;"><?=$row['en_name']?></p>
          </div> 
        </div>
      </div>
      <?php
        }          
  break;


  // 請選擇電影 ajax 下拉式選單  
  case 'chmovie':
  $sql = "SELECT * FROM small_movie";
  $rows=$db->query($sql)->fetchAll();
  // print_r($rows);
  echo '<option value="">請選擇電影</option>';
  foreach ($rows as $do => $row) {
    ?>  
  <option value=<?=$row['id']?>><?=$row['ch_name']?></option>
  <?php
  }
  break;
  
  case 'booking':
  $sql = "SELECT * FROM ticket_sell WHERE movie='".$_POST['movie']."' and  date='".$_POST['date']."'";
  $rows =$db->query($sql)->fetchAll();
  // 統計 每一時段 總銷售量 $time[時段][銷售數]
  $time = array(
    array("10:00~12:00",0), //i=0
    array("12:00~14:00",0), //i=1
    array("14:00~16:00",0), //i=2
    array("16:00~18:00",0), //i=3
    array("18:00~20:00",0), //i=4
    array("20:00~22:00",0), //i=5
    array("22:00~24:00",0)  //i=6 
  );
  // print_r($_POST);
  // echo $_POST['date'];
    foreach ($rows as $row) {
      // $row['time']第一個為1 ，要先減1才能等於$time第一個的0, 
      $time[$row['time']-1][1]+=$row['many'];
    }
    if($_POST['date'] == date('Y-m-d')){
      $begin=(date('H')<10 )?0: floor(date('H')/2)-4;
    }
    else{
      $begin=0;
    }
    echo '<option value="">請選擇時段</option>';
    for($i=$begin;$i<7;$i++){
      if($time[$i][1]!=50){
        echo '<option value="'.($i+1).'">'.$time[$i][0].'剩餘座位'.((50-$time[$i][1])).'</option>';
      }
    };
  break;
  case 'introduction':
  header("location:movie_show.php?id=".$_GET['id']."");
  break;
  case 'dd':
  // print_r($_GET);



    $sql = "SELECT * FROM small_movie  WHERE id=".$_GET['id'].""; 
    $rows = $db->query($sql)->fetch();
    $re = array();
  echo "<li>".$rows['introduction']."</li>
        <li>影片類型 :　".$rows['type']."</li>
        <li>上映日期 :　".$rows['time']."</li>";
  break;
  


  
}

?>