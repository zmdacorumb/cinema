 <?php
include_once("sql.php");
// if(empty($_SESSION)) header("location:sir_login.php?do=re_check");
print_r($_POST);
print_r($_GET);
// print_r($_SESSION);
if(!empty($_GET['id'])){
  $sql = "SELECT * FROM small_movie WHERE id=".$_GET['id']."";
  $rows=$db->query($sql)->fetch();//找所選擇到的電影資料
 
  $sellseats = "SELECT * FROM sell WHERE movie='".$rows['ch_name']."' and date='".$_GET['date']."' and time=".$_GET['time']." ";
  $sells = $db->query($sellseats)->fetchAll();

  if($_GET['time']==1) $time="10:00~12:00";
  if($_GET['time']==2) $time="12:00~14:00";
  if($_GET['time']==3) $time="14:00~16:00";
  if($_GET['time']==4) $time="16:00~18:00";
  if($_GET['time']==5) $time="18:00~20:00";
  if($_GET['time']==6) $time="20:00~22:00";
  if($_GET['time']==7) $time="22:00~24:00";
      // 將每筆訂單的已選的座位合併進空陣列
      $seat = array();
      foreach($sells as $row)
      {
          $s = unserialize($row["seat"]);
          $seat = array_merge($seat, $s);
      }
}
else {
  header("location:index.html");
}


?>
 <!doctype html>
 <html lang="en">

 <head>
   <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-YY177GGBHH"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-YY177GGBHH');
  </script>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/myboots.css">
   <link rel="stylesheet" href="css/css.css">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">


   <title>訂票頁面</title>
 </head>

 <body class="bg-block">
   <!-- navbar -->
   <!-- fixed-top -->
   <nav class="navbar navbar-expand-lg navbar-dark fixed-top  "
     style="background-image: linear-gradient(to right, #ffa400, #ffbe00, #ffd900,#fff305, #ffbe00,#ff8a05) !important">
     <a class="navbar-brand " href="index.html"><img src="img/logo-white.png" alt="logo"></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
       <span class="navbar-toggler-icon"></span>
     </button>
     <!-- 訂票系統 -->
     <section class=" collapse navbar-collapse" id="navbar" style="margin:0 ;">
       <div class="container-fluid ">
         <form class="row" action="api.php?do=no_sir_booking_check" method="POST">
         <!-- <form class="row" action="sir_bookingok.php" method="POST"> -->
           <div class="form-row col-lg-10 align-items-center justify-content-center m-0 ">
             <div class="col-md-3">
               <select name="chmovie" id="chmovie" class="form-control " onchange="getval()">
               </select>
             </div>
             <div class=" col-md-2 my-3 ">
               <select name="chdate" id="chdate" class="form-control " onchange="getval()">
               </select>
             </div>
             <div class=" col-md-3 my-3">
               <select name="chtime" id="chtime" class="form-control ">
               </select>
             </div>
             <div class="col-auto ">
               <button type="submit" class="btn btn-light">確定場次</button>
             </div>
           </div>
         </form>
       </div>
     </section>
   </nav>

   <!-- 選位 -->
   <section class="vh-100 vw-100  booking_bg  pt-3 ">
     <div class="container h-100">
       <div class="row h-100   flex-lg-row justify-content-lg-center align-items-lg-center m-0 ">
         <div class="row col-lg-3 w-100 h-60 justify-content-center m-0 p-0">
           <div
             class="row col ml-auto justify-content-center justify-content-lg-end  align-items-center w-100  h-100 mt-3 mt-md-0 mx-0 p-0">
             <img class=" bg-white" src="img/small_movie/<?=$rows['big_img']?>" alt="">
           </div>
         </div>
         <div class="row col  col-lg-8 bg-white rounded-d h-60 p-0 m-0 ">
           <div class="row col h-100 justify-content-center mx-auto   " id="booking">
             <div class="row col-10 col-lg-8  h-10 mt-3 alert-secondary justify-content-center align-items-center ">
               <span class="h-50 ">螢幕</span>
             </div>
             <form class="row col-12 h-70  justify-content-center   " method="post" action="api.php?do=seat_check">
               <div class="row col mx-0  ">
                 <?php
                  for($i=1; $i<61; $i++){
                    if( in_array($i,$seat)){
                    echo '<div class=" col-1 p-0 pl-lg-1 my-1">
                    <input type="button" name="'.$i.'" data-num="'.$i.'"  value="✖" class=" see btn btn-danger    text-white" disabled  "></input>
                          </div>
                          ';
                    }
                    else{
                    echo '<div class="col-1  p-0 pl-lg-1 my-1 ">
                          <input type="button" name="'.$i.'" data-num="'.$i.'" data-text=tt  value="'.$i.'" class="see btn btn-outline-warning text-dark"></input>
                          </div>
                          ';
                    }
                    // if($i % 10 == 0) echo "<br>";
                  }
                  for($i=1; $i<61; $i++){                 
                    echo '
                    <input type="checkbox" name="seat[]" class="seat" value="'.$i.'" id="'.$i.'" style="display:none;" ></input>';
                  }                 
                ?>
               </div>
               <div class="w-100 h-0 text-center"></div>
               <div class="row flex-column w-90 text-dark ">
                 <input type="hidden" name="movie" value="<?=$rows['ch_name']?>">
                 <input type="hidden" name="date" value="<?=$_GET['date']?>">
                 <input type="hidden" name="time" value="<?=$_GET['time']?>">
                 <br>
                 <div class="col ">您所選擇的電影: <?=$rows['ch_name']?><br></div>
                 <div class="col">您所選擇的時間: <?=$_GET['date']?> <?=$time?><br></div>
                 <div class="col">您已選了<span id="many">0</span>張票，最多可購買4張票.<br></div>
                 <div class="col">
                   <input type="submit" class="btn btn-light mt-1 mt-md-3 bg-warning" value="下一步">
                 </div>
               </div>
             </form>
         </div>
       </div>
     </div>    
   </section>
   <!-- footer區 -->
   <section>
     <div class="container-fluid p-0 fixed-bottom ">
       <div>
         <ul class="nav  justify-content-center">
           <li class="nav-item ">
             <a class="nav-link text-light active" href="#">Copyright &copy; JO</a>
           </li>
         </ul>
       </div>
     </div>
   </section>

   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery-3.4.1.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/myjs.js"></script>
   <!-- 其它套件 or js 要放下面 -->
   <script>
     let movie, date, time, seat;
     var num = 0;
     // 訂票系統
     getval();
     //  點選座位後的動作
     $("input[data-text=tt]").click(function () {
       let text = $(this).val();
       let seat_num = $(this).attr('data-num');
       // console.log(seat_num);
       if (text != "✖") {

         $(this).val('✖').addClass('btn-warning');

         $(`.seat#${seat_num}`).attr('checked', true);
         num++;
         $('#many').text(num);
         if (num > 4) {
           $(this).val(seat_num);
           num--;
           $('#many').text(num);
           $(`.seat#${seat_num}`).attr('checked', false);
           $(this).removeClass('btn-warning');
         }
       } else {
         $(this).val(seat_num);
         $(`.seat#${seat_num}`).attr('checked', false);
         num--;
         $('#many').text(num);
         $(this).removeClass('btn-warning');
       }
     })
   </script>
 </body>

 </html>