<?php
print_r($_SESSION["bookok"]);
include_once("sql.php");
if(empty($_SESSION["bookok"])) header("location:index.html");
$sql = "SELECT * FROM sell WHERE num='".$_SESSION['bookok']."'";
$rows=$db->query($sql)->fetch(); //從DB只取出一筆
$seat = unserialize($rows["seat"]); //將某數據解壓縮，變成陣列型態之變數
$pdo = "SELECT * FROM small_movie WHERE ch_name='".$rows['movie']."'";
$img=$db->query($pdo)->fetch();
if($rows['time']==1) $time="10:00~12:00";
if($rows['time']==2) $time="12:00~14:00";
if($rows['time']==3) $time="14:00~16:00";
if($rows['time']==4) $time="16:00~18:00";
if($rows['time']==5) $time="18:00~20:00";
if($rows['time']==6) $time="20:00~22:00";
if($rows['time']==7) $time="22:00~24:00";
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
  <script src="js/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/sweetalert.css.css">
  <!-- <link rel="stylesheet" href="css/sweetalert.css"> -->
  <title>訂票確認</title>
</head>

<body>
  


  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top"
    style="background-image: linear-gradient(to right, #ffa400, #ffbe00, #ffd900,#fff305, #ffbe00,#ff8a05) !important">
    <a class="navbar-brand " href="index.html"><img src="img/logo-white.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>


  </nav>
  <div class="vh-100 vw-100  booking_bg pt-5 ">
    <div class="container h-100">
      <div class="row h-100  flex-lg-row justify-content-lg-center align-items-lg-center ">
        <div class="col-lg-2 h-60">
          <div class="row align-items-center h-100">
            <img src="img/small_movie/<?=$img['big_img']?>" alt="" class="position-relative shadow" style="z-index:1;">
          </div>
        </div>
        <div class="row col-lg-8 h-60 p-0 m-0 bg-warning rounded-d ">
          <div class="col-lg-1 h-100"></div>
          <div class="col-lg-11 h-100 w-100    align-items-center p-0 ">
            <div id="booking" class="h-100">
              <div id="seatnum" class="row h-100 flex-column  pl-5 w-100 h-60 text-white m-0 ">

                <div class="col mt-3  ">
                  <span>你選了<?=$rows['many']?>個位子:
                  </span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                  <span class="seatCk<?=$i?>">
                    <i class="fas fa-child fa-lg "></i>
                  </span>
                  <?php 
                  }
                    ?>
                </div>

                <div id="t1000" class="col ">
                  <span>早場 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                  <div class="tic  a<?=$i?> d-inline-block" id='ti' style="color:rgb(255, 255, 255);">
                    <i class="fas fa-child fa-2x "></i>
                  </div>
                  <?php 
                  }
                    ?>
                </div>

                <div id="t1200" class="col ">
                  <span>全票 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                  <div class="tic  a<?=$i?> d-inline-block" id='ti' style="color:rgb(255, 255, 255);">
                    <i class="fas fa-child fa-2x "></i>
                  </div>
                  <?php 
                  }
                    ?>
                </div>

                <div id="s0000" class="col ">
                  <span>優待 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                  <div class="tic  a<?=$i?> d-inline-block" id='ti' style="color:rgb(255, 255, 255);">
                    <i class="fas fa-child fa-2x "></i>
                  </div>
                  <?php 
                  }
                    ?>
                </div>

                <div id="t2200" class="col ">
                  <span>夜貓 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                  <div class="tic  a<?=$i?> d-inline-block" id='ti' style="color:rgb(255, 255, 255);">
                    <i class="fas fa-child fa-2x "></i>
                  </div>
                  <?php 
                  }
                    ?>
                </div>

                <div class="col ">
                  <span>長青 :</span>
                  <?php
                  for ($i=1; $i <= $rows['many']; $i++) { 
                    ?>
                  <div class="tic  a<?=$i?> d-inline-block" id='ti' style="color:rgb(255, 255, 255);">
                    <i class="fas fa-child fa-2x "></i>
                  </div>
                  <?php 
                  }
                    ?>
                </div>
              </div>
              <div>
                <form class="col" method="post" action="api.php?do=seat_check">
                  <div class="w-100 h-5 text-center"></div>
                  <div class="row flex-column w-70 ml-5 pl-3 text-white ">
                    <input id='time' type="hidden" name="time" value="<?=$rows['time']?>">
                    <input id='many' type="hidden" name="many" value="<?=$rows['many']?>">
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
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                      Launch demo modal
                    </button>

                    <!-- <input type="submit" class="btn btn-light mt-3 bg-danger" value="確認" > -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- footer區 -->
    <div class="container-fluid p-0 fixed-bottom ">
      <div>
        <ul class="nav  justify-content-center">
          <li class="nav-item ">
            <a class="nav-link text-light active" href="#">Copyright &copy; JO</a>
          </li>
        </ul>
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
    // 調用sweetAlert
    // swal({
    //   title: "Error!",
    //   text: "Here's my error message!",
    //   type: "error",
    //   confirmButtonText: "Cool"
    // });
    // 判斷早場和夜貓場的票種顯示
    var time = $('#time').val();
    var many = $('#many').val();
    if (time != 1) $('#t1000').css("display", "none");
    if (time != 7) $('#t2200').css("display", "none");
    if (time == 1) $('#t1200').css("display", "none");
    if (time == 1) $('#s0000').css("display", "none");

    // 判斷點擊後 票種顏色的顯示 和計算可點擊的數量
    let num = 1;
    $('.tic').click(function () {
      let color = $(this).css('color');
      if (color == "rgb(255, 255, 255)") {
        if (num <= many) {
          $(this).css('color', 'rgb(220, 53, 69)')
          $(`.seatCk${num}`).css('color', 'rgb(220, 53, 69)')
          num++;
        }
      } else {
        $(this).css('color', 'rgb(255, 255, 255)')
        num--;
        $(`.seatCk${num}`).css('color', 'rgb(255, 255, 255)')
      }
    })

    // modal js
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
  </script>


</body>

</html>