<?php
include_once('sql.php');

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

          <img class="card-img-top" src="img/small_movie/<?=$row['big_img']?>">
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
  echo "<option selected>請選擇電影</option>";
  foreach ($rows as $do => $row) {
      $i=$i+1;
    ?>
    
  <option value="<?=$i?>"><?=$row['ch_name']?></option>
  <?php
  }
  break;
  case 'booking':
    print_r ($_POST);
  break;


  
}






?>