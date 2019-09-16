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
  $data=array($_POST['acc'],$_POST['pwd']);
   $sql = "SELECT * FROM member_profile WHERE  acc ='".$_POST['acc']."' and pwd ='".$_POST['pwd']."'";
   $reload =$db->prepare($sql);
   $reload ->execute($data);
   $res = $reload->fetchAll();
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
  // 會員註冊帳號重覆確認
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
  //新會員帳號入資料庫
  case 'register':
    print_r($_POST);
    $sql = "INSERT INTO web1_register(acc,pwd,email,tel) VALUES 
    ('".$_POST['acc']."','".$_POST['pwd']."','".$_POST['email']."','".$_POST['tel']."') ";
    $db->query($sql);

    // $data =array($_POST['acc'],$_POST['pwd'],$_POST['email'],$_POST['tel']);
    // $sql = "INSERT INTO web1_register(acc,pwd,email,tel) VALUES (?) ";
    // $reload=$db->prepare($sql);
    // $reload->execute($data);

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
    <div class="col-lg-3  my-3 d-sm-block d-lg-none">
      <div>
        <div class="card  front1 col-8 col-md-8 col-lg-12 mx-auto p-0" style="border: none">
          <a href="api.php?do=introduction&id=<?=$row['id']?>">
            <img class="card-img-top " src="img/small_movie/<?=$row['big_img']?>">
          </a>
          <div class="card-body text-white bg-dark">
            <h4 class="card-title font-weight-bolder h5" style="color:#fff;" ><?=$row['ch_name']?></h4>
            <p class="card-text" style="color:#999; font-size:0.1rem;"><?=$row['en_name']?></p>
          </div>
        </div>
      </div>
    </div>


    <div class="image-flip col-10 col-md-6  col-lg-3  my-3 d-none d-lg-block " ontouchstart="this.classList.toggle('hover');">
      <div class="mainflip  ">
        <div class="frontside">
          <div class="card  front1 col-8 col-md-8 col-lg-12 mx-auto p-0" style="border: none">
            <a href="api.php?do=introduction&id=<?=$row['id']?>">
              <img class="card-img-top img- fluid " src="img/small_movie/<?=$row['big_img']?>">
            </a>
            <div class="card-body text-white bg-dark">
              <h4 class="card-title font-weight-bolder h5" style="color:#fff;" ><?=$row['ch_name']?></h4>
              <p class="card-text" style="color:#999; font-size:0.1rem;"><?=$row['en_name']?></p>
            </div>
          </div>
        </div>
     

        <div class="backside">
          <div class="card" >
            <div class="bg-dark" style="z-index:1; opacity:0.5;">
              <a class="bg-dark" href="api.php?do=introduction&id=<?=$row['id']?>">
              <img class="card-img-top img- fluid " src="img/small_movie/<?=$row['big_img']?>" width="280" height="475">
            </a>
            </div>
            
            <div class="card-body fixed-top bg-block text-white h-100" style="z-index:2; opacity:0.9;border:2px solid #ffc108">
              <h4 class="card-title font-weight-bolder h5" ><?=$row['ch_name']?></h4>
              <p class="card-text" style="font-size:0.1rem;"><?=$row['introduction']?></p>
              <p>類型:　<span><?=$row['type']?></span></p>
              <div class="">
                <a class="w-50 btn btn-outline-warning  fixed-bottom mb-5 ml-4 text-white"href="api.php?do=introduction&id=<?=$row['id']?>">
                  看更多
              </a>
              </div>
              
            </div>
          </div>
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
        // echo '<option value="'.($i+1).'">'.$time[$i][0].'剩餘座位'.((50-$time[$i][1])).'</option>';
        echo '<option value="'.($i+1).'">'.$time[$i][0].'</option>';
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
  if(!empty($_SESSION['sir_admin'])) {  
        header("location:sir_booking.php?id=".$_POST['chmovie']."&date='".$_POST['chdate']."'&time=".$_POST['chtime']."");
      }
      else{
        
        header("location:sir_login.php?id=".$_POST['chmovie']."&date=".$_POST['chdate']."&time=".$_POST['chtime']."");
      }  
      break;
      // 非會員購票進入確認
      case "no_sir_booking_check":
      if($_POST['chmovie']) $_GET['id']=$_POST['chmovie'];
      if($_POST['chdate']) $_GET['date']=$_POST['chdate'];
      if($_POST['chtime']) $_GET['time']=$_POST['chtime'];
      // print_r($_POST);
      // print_r($_GET);
      header("location:sir_booking.php?id=".$_GET['id']."&date=".$_GET['date']."&time=".$_GET['time']."");
  break;
// str_pad() 位子號碼傳至 填充字符串的右侧，到 30 个字符的新长度 str_pad($str,30,".");
// lastInsertId()  PDO::lastInsertId — 返回最后插入行的ID或序列值(PHP 5 >= 5.1.0, PECL pdo >= 0.1.0)
 case 'seat_check':
      print_r($_POST);
   if(empty($_POST['seat'])) header("location:sir_booking.php");
   $many =count($_POST['seat']);
   $seat = serialize($_POST['seat']);//座位編號 轉至sql
   $num  =time();
   $_SESSION["bookok"]=$num;
   $pdo = "INSERT INTO sell(movie,date,time,many,seat,num) VALUES 
   ('".$_POST['movie']."','".$_POST['date']."',".$_POST['time'].",".$many.",'".$seat."','".$num."')";
      $db->query($pdo);
  
    header("location:sir_bookingok.php");
 break;
 case 'unset':
      unset($_SESSION['bookok']);
 break;












 case 'movieee':
  $sql = "SELECT * FROM small_movie";
  $rows=$db->query($sql)->fetchAll();
    foreach ($rows as $do => $row) {     
      
      ?>


  <?php
        }          
  break;
     
  
}

?>