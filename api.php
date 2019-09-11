<?php
include_once('sql.php');
// print_r($_GET);
switch ($_GET['do']) {
  // 登入確認
  case 'check':
  //  $sql = "SELECT * FROM admin WHERE acc='".$_POST['acc']."' and pwd='".$_POST['pwd']."'";
  //  $re = $db->query($sql)->fetchAll();

   $data=array($_POST['acc'],$_POST['pwd']);
   $sql = "SELECT * FROM admin WHERE acc=? and pwd=?";
   $reload= $db->prepare($sql);
   $reload->execute($data);
  $re=$reload->fetchAll();
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
    unset($_SESSION['sir_admin']);
    header('location:login.php');
  break;
  // small slider 後台新增功能
  case 'smallInsert':
   $sql = "INSERT INTO small_movie(`display`) VALUE (0)";
   $db->query($sql);
   header('location:admin.php?do=small_movie');
  break;
  //  會員登入確認
  case 're_check':
   $sql = "SELECT * FROM member_profile WHERE  acc ='".$_POST['acc']."' and pwd ='".$_POST['pwd']."'";
   $res =$db->query($sql)->fetchAll();

    if($_GET['id']){
      if($res){
        header("location:sir_booking.php?id=".$_GET['id']."&date=".$_GET['date']."&time=".$_GET['time']."");
        
      }
      else{
        echo "<script>alert('您輸入的帳號或密碼有誤');</script>";
        header("location:sir_login.php?id=".$_GET['id']."&date=".$_GET['date']."&time=".$_GET['time']."");
      }
    }
    else{
      header("location:index.html");
    }
  break;
  // 會員註冊帳號確認
  case 'sir_register_check':
  $sql = "SELECT * FROM web1_register WHERE acc='".$_POST['acc']."'";
  $rows =$db->query($sql)->fetch();
 
   if($rows){
     echo "檢測帳號重覆";
   }
  else{
    echo "可使用此帳號";
  }
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
    <div class="col-lg-3  my-3">
      <div class="">
        <div class="card  front1 col-8 col-md-8 col-lg-12 mx-auto p-0" style="border: none">
          <a href="api.php?do=introduction&id=<?=$row['id']?>">
            <img class="card-img-top " src="img/small_movie/<?=$row['big_img']?>">
          </a>
          <div class="card-body text-white bg-dark">
            <h4 class="card-title font-weight-bolder h5" style="color:#fff;" ><?=$row['ch_name']?></h4>
            <p class="card-text" style="color:#999; font-size:0.1rem;"><?=$row['en_name']?></p>
          </div>
        </div>


        <!-- <div class="" style="border: none">
          <div class=" text-white">           
            <h1>1</h1>
          </div>
        </div> -->
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
  // 訂票系統
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
  // 電影介紹頁
  case 'introduction':
  header("location:movie_show.php?id=".$_GET['id']."");
  break;
  case 'dd':
    $sql = "SELECT * FROM small_movie  WHERE id=".$_GET['id'].""; 
    $rows = $db->query($sql)->fetch();
    $re = array();
  echo "<li>".$rows['introduction']."</li>
        <li>影片類型 :　".$rows['type']."</li>
        <li>上映日期 :　".$rows['time']."</li>";
  break;
  // 訂票-確認是否有會員
  case "booking_check":
  print_r($_POST);
  print_r($_SESSION);
  print_r($_GET);
    // 如果登入後 從訂票系統進來(有session)  就直接依 chmovie 轉至該 訂位頁
    // 如果未登入 就從訂票系統進來  就轉至該 會員登入頁
  if(!empty($_SESSION['sir_admin'])) {  
        // if($_POST['acc'] && $_POST['pwd']){
        //   $sql = "SELECT * FROM member_profile WHERE acc='".$_POST['acc']."' and pwd='".$_POST['pwd']."'";
        //   $rows = $db->query($sql)->fetchAll();
        //   if($rows){
        //     $_SESSION['sir_admin']=$_POST['acc'];
        //     print_r($_SESSION['sir_admin']);
        //     // header("location:sir_booking.html?id=".$_POST['chmovie']."");
        //   }
        // }
        // else{
        //   header("location:sir_login.php");
        // }  
        header("location:sir_booking.php?id=".$_POST['chmovie']."&date='".$_POST['chdate']."'&time=".$_POST['chtime']."");
      }
      else{
        
        header("location:sir_login.php?id=".$_POST['chmovie']."&date=".$_POST['chdate']."&time=".$_POST['chtime']."");
      }  
      break;
      // 非會員購票進入確認
      case "no_sir_booking_check":
      // if($_POST['chmovie']) $_GET['id']=$_POST['chmovie'];
      // if($_POST['chdate']) $_GET['date']=$_POST['chdate'];
      // if($_POST['chtime']) $_GET['time']=$_POST['chtime'];
      print_r($_POST);
      print_r($_GET);
      header("location:sir_booking.php?id=".$_GET['id']."&date=".$_GET['date']."&time=".$_GET['time']."");
  // print_r($_POST);
  // print_r($_SESSION);
  // print_r($_GET);
  break;
// str_pad() 位子號碼傳至 填充字符串的右侧，到 30 个字符的新长度 str_pad($str,30,".");
// lastInsertId()  PDO::lastInsertId — 返回最后插入行的ID或序列值(PHP 5 >= 5.1.0, PECL pdo >= 0.1.0)
 case 'seat_check':
   if(empty($_POST['seat'])) header("location:sir_booking.php");
   print_r($_POST);
   print_r($_GET);
   $seat = serialize($_POST['seat']);//座位編號 轉至sql
   $num =time();
   $_SESSION["bookok"]=$num;
   $pdo = "INSERT INTO sell(movie,date,time,seat,num) VALUES ('".$_POST['movie']."','".$_POST['date']."',".$_POST['time'].",'".$seat."','".$num."')";
    // $db->query($pdo);
  
    // header("location:sir_bookingok.php?id=".$rows['id']);
 break;
     
  
}

?>