 <?php
include_once("sql.php");
// if(empty($_SESSION)) header("location:sir_login.php?do=re_check");
print_r($_POST);
print_r($_GET);
print_r($_SESSION);
if(!empty($_GET['id'])){
  $sql = "SELECT * FROM small_movie WHERE id=".$_GET['id']."";
}
else {
  header("location:index.html");
}
$rows=$db->query($sql)->fetch();
$pdo = "SELECT * FROM sell WHERE movie='".$rows['ch_name']."'";
$sells=$db->query($pdo)->fetchAll();
if($_GET['time']==1) $time="10:00~12:00";
if($_GET['time']==2) $time="12:00~14:00";
if($_GET['time']==3) $time="14:00~16:00";
if($_GET['time']==4) $time="16:00~18:00";
if($_GET['time']==5) $time="18:00~20:00";
if($_GET['time']==6) $time="20:00~22:00";
if($_GET['time']==7) $time="22:00~24:00";

$seat=[1,2];

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


   <title>訂票頁面</title>
 </head>

 <body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
     <a class="navbar-brand " href="index.html"><img src="img/logo-white.png" alt="logo"></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
       <span class="navbar-toggler-icon"></span>
     </button>
     <!-- 訂票系統 -->
     <section class=" collapse navbar-collapse" id="navbar" style="margin:0;">
       <div class="container-fluid ">
         <form class="row" action="api.php?do=no_sir_booking_check" method="POST">
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
   <div class="vh-100 vw-100  booking_bg pt-5 ">
     <div class="container h-100">
       <div class="row h-100  flex-lg-row justify-content-lg-center ">
         <div class="col-lg-2 bg-danger h-60">
           <div class="row align-items-center h-100">
             <img src="img/small_movie/<?=$rows['big_img']?>" alt="" class="position-relative" style="z-index:1;">
           </div>
         </div>
         <div class="row col-lg-8 bg-info h-60 p-0 m-0">
           <div class="col-lg-1 h-100 bg-dark"></div>
           <div class="col-lg-11 h-100 w-100  bg-primary   align-items-center ">



             <div  id="booking" class="h-100">
               <div class="w-90 mt-3 mx-auto bg-warning text-center">螢幕</div>
               <div class="w-100 h-10 text-center"></div>
               <form method="post" action="api.php?do=seat_check">
                 <div class="text-center">
                   <?php
                  for($i=1; $i<51; $i++){
                    if(in_array($i,$seat)){
                    echo '<input type="button" name="'.$i.'" data-num="'.$i.'" data-text=tt value="╳" class="see btn btn-outline-light d-inline-block  text-center text-danger m-1"></input>';
                    }
                    else{
                    echo '
                          <input type="button" name="'.$i.'" data-num="'.$i.'" data-text=tt  value="'.$i.'" class="see btn btn-outline-light d-inline-block  text-center text-white m-1"></input>
                    ';
                    }
                    if($i % 10 == 0) echo "<br>";
                  }
                  for($i=1; $i<51; $i++){                 
                    echo '
                    <input type="checkbox" name="seat[]" class="seat" value="'.$i.'" id="'.$i.'" style="display:none;" ></input>';
                  }                 
                ?>
                 </div>
                 <div class="w-100 h-5 text-center"></div>
                 <div class="row flex-column w-70 ml-5 pl-3 text-white ">
                   <input type="hidden" name="movie" value="<?=$rows['ch_name']?>">
                   <input type="hidden" name="date" value="<?=$_GET['date']?>">
                   <input type="hidden" name="time" value="<?=$_GET['time']?>">
                   <div class="col">您所選擇的電影: <?=$rows['ch_name']?><br></div>
                   <div class="col">您所選擇的時間: <?=$_GET['date']?>. <?=$time?><br></div>
                   <div class="col">您已勾選了<span id="many">0</span>張票，最多可購買4張票.<br></div>
                   <!-- <button id="btn1" onclick="gobook()" type="button" class="btn btn-light mt-3 bg-danger">下一步</button> -->
                   <input type="submit"  class="btn btn-light mt-3 bg-danger" value="下一步">
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
   <script>
     let movie,date,time,seat;
     var num = 0;
     // 訂票系統
     getval();
    //  點選座位後的動作
     $("input[data-text=tt]").click(function(){ 
          let text = $(this).val();
          let seat_num  = $(this).attr('data-num');
          // console.log(seat_num);
          if(text != "╳"){
            $(this).val('╳');
            $(`.seat#${seat_num}`).attr('checked', true);
            num++;
            $('#many').text(num);
            if(num>4){
              $(this).val(seat_num);
              num--;
              $('#many').text(num);
            $(`.seat#${seat_num}`).attr('checked', false);
            }
          }
          else{
            $(this).val(seat_num);
            $(`.seat#${seat_num}`).attr('checked', false);
            num--;
            $('#many').text(num);
          }
         
        })
        // 頁面切換
        function gobook(){ 
          
          
          $('#booking').load('booking.php',function(){
               // seat.length=0;  //將座位陣列清空
               // qt=0;  //將訂票計數先歸零
                 
               //切換兩個區塊的狀態(一個隱蔵,一個顯示)
               $("#booking").toggle();
               $("#checkout").toggle();
               })
             }
       
    // booking checkout
   </script>
 </body>

 </html>