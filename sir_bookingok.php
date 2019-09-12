<?php
include_once("sql.php");
if(empty($_SESSION["bookok"])) header("location:index.html");
$sql = "SELECT * FROM sell WHERE num='".$_SESSION['bookok']."'";
$rows=$db->query($sql)->fetch(); //從DB只取出一筆

$seat = unserialize($rows["seat"]); //將某數據解壓縮，變成陣列型態之變數
// print_r($seat); //檢查該陣列


// foreach($rows as $row)
// {
//     $s = unserialize($row["seat"]);
//     $seat = array_merge($seat, $s);
// }

$pdo = "SELECT * FROM small_movie WHERE ch_name='".$rows['movie']."'";
$img=$db->query($pdo)->fetch();
if($rows['time']==1) $time="10:00~12:00";
if($rows['time']==2) $time="12:00~14:00";
if($rows['time']==3) $time="14:00~16:00";
if($rows['time']==4) $time="16:00~18:00";
if($rows['time']==5) $time="18:00~20:00";
if($rows['time']==6) $time="20:00~22:00";
if($rows['time']==7) $time="22:00~24:00";
// 將每筆訂單的已選的座位合併進空陣列

// print_r($seat);
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/myboots.css">
  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/fontawesome.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <title>訂票確認</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
    <a class="navbar-brand " href="index.html"><img src="img/logo-white.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>


  </nav>
  <div class="vh-100 vw-100  booking_bg pt-5 ">
    <div class="container h-100">
      <div class="row h-100  flex-lg-row justify-content-lg-center align-items-lg-center ">
        <div class="col-lg-2 bg-danger h-60">
          <div class="row align-items-center h-100">
            <img src="img/small_movie/<?=$img['big_img']?>" alt="" class="position-relative" style="z-index:1;">
          </div>
        </div>
        <div class="row col-lg-8 bg-info h-60 p-0 m-0">
          <div class="col-lg-1 h-100 bg-dark"></div>
          <div class="col-lg-11 h-100 w-100  bg-primary   align-items-center p-0 ">
            <div id="booking" class="h-100">
              <div id="seatnum" class="row h-100 flex-column  pl-5 w-100 h-60 text-white m-0 bg-warning ">

                <div class="col mt-3 ">
                  <span>你選了<?=$rows['many']?>個位子: 
                </span>
                <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                    <span class="mi" data-ticket>
                          <i class="fas fa-child fa-lg "></i>
                    </span>
                <?php 
                  }
                    ?>
                
                </div>

                <div class="col">
                  <span>早場 :</span>
                  
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                    <div class="mi a<?=$i?> d-inline-block " >
                          <i class="fas fa-child fa-2x "></i>
                  </div>
                <?php 
                  }
                    ?>
                </div>

                <div class="col">
                  <span>全票 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                    <span class="mi b<?=$i?>" >
                          <i class="fas fa-child fa-2x "></i>
                    </span>
                <?php 
                  }
                    ?>
                </div>

                <div class="col">
                  <span>優待 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                    <span class="mi c<?=$i?>" >
                          <i class="fas fa-child fa-2x "></i>
                    </span>
                <?php 
                  }
                    ?>
                </div class="col">

                <div class="col">
                  <span>夜貓 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                    <span class="mi d<?=$i?>" >
                          <i class="fas fa-child fa-2x "></i>
                    </span>
                <?php 
                  }
                    ?>
                </div>

                <div class="col">
                  <span>長青 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                    <span class="mi e<?=$i?>" >
                          <i class="fas fa-child fa-2x "></i>
                    </span>
                <?php 
                  }
                    ?>
                </div>
              </div>
              <div>
                <form class="col bg-info" method="post" action="api.php?do=seat_check">
                  <div class="w-100 h-5 text-center"></div>
                  <div class="row flex-column w-70 ml-5 pl-3 text-white ">
                    <input type="hidden" name="movie" value="<?=$rows['ch_name']?>">
                    <input type="hidden" name="date" value="<?=$_GET['date']?>">
                    <input type="hidden" name="time" value="<?=$_GET['time']?>">
                    <div class="col">您所選擇的電影: <?=$rows['movie']?><br></div>
                    <div class="col">您所選擇的時間: <?=$rows['date']?>　<?=$time?><br></div>
                    <div class="col">您已選了<?=$rows['many']?>張票，位子為 :
                    <?php
                      foreach($seat as $value){ 
                        echo $value.".";
                      }
                      ?>
                    <br></div>
                    <div class="col">您的訂單編號:<?=$rows['num']?></div>
                    <!-- <button id="btn1" onclick="gobook()" type="button" class="btn btn-light mt-3 bg-danger">下一步</button> -->
                    <input type="submit" class="btn btn-light mt-3 bg-danger" value="確認">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/myjs.js"></script>
    <!-- 其它套件 or js 要放下面 -->
  <script>
    $('.mi').click(function(){
      
      $(this).addClass('a1');
    })
  </script>
    

</body>

</html>