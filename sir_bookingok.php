<?php
include_once("sql.php");
if(empty($_SESSION["bookok"])) header("location:index.html");
$sql = "SELECT * FROM sell WHERE num='".$_SESSION['bookok']."'";
$rows=$db->query($sql)->fetch();
$pdo = "SELECT * FROM small_movie WHERE ch_name='".$rows['movie']."'";
$img=$db->query($pdo)->fetch();
// print_r($img);
if($rows['time']==1) $time="10:00~12:00";
if($rows['time']==2) $time="12:00~14:00";
if($rows['time']==3) $time="14:00~16:00";
if($rows['time']==4) $time="16:00~18:00";
if($rows['time']==5) $time="18:00~20:00";
if($rows['time']==6) $time="20:00~22:00";
if($rows['time']==7) $time="22:00~24:00";
print_r($rows);
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
           <div class="col-lg-11 h-100 w-100  bg-primary   align-items-center ">



             <div  id="booking" class="h-100">
               
               <div class="w-100 h-10 text-center"></div>
               <form method="post" action="api.php?do=seat_check">
                 <div class="w-100 h-5 text-center"></div>
                 <div class="row flex-column w-70 ml-5 pl-3 text-white h5">
                   <input type="hidden" name="movie" value="<?=$rows['ch_name']?>">
                   <input type="hidden" name="date" value="<?=$_GET['date']?>">
                   <input type="hidden" name="time" value="<?=$_GET['time']?>">
                   <div class="col">您所選擇的電影: <?=$rows['movie']?><br></div>
                   <div class="col">您所選擇的時間: <?=$rows['date']?> <?=$time?><br></div>
                   <div class="col">您已勾選了?張票，位子為.<br></div>
                   <div class="col">您的訂單編號:<?=$rows['num']?></div>
                   <!-- <button id="btn1" onclick="gobook()" type="button" class="btn btn-light mt-3 bg-danger">下一步</button> -->
                   <input type="submit"  class="btn btn-light mt-3 bg-danger" value="確認">
                  </div>
               </form>
             </div>



             <div  id="checkout" class="h-100 bg-white d-none">
              <p>123</p>
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
   
 </body>

 </html>