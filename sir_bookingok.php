<?php
include_once("sql.php");
if (empty($_SESSION["bookok"])) header("location:index.html");
$sql = "SELECT * FROM sell WHERE num='" . $_SESSION['bookok'] . "'";
$rows = $db->query($sql)->fetch(); //從DB只取出一筆
$seat = unserialize($rows["seat"]); //將某數據解壓縮，變成陣列型態之變數
$pdo = "SELECT * FROM small_movie WHERE ch_name='" . $rows['movie'] . "'";
$img = $db->query($pdo)->fetch();
if ($rows['time'] == 1) $time = "10:00~12:00";
if ($rows['time'] == 2) $time = "12:00~14:00";
if ($rows['time'] == 3) $time = "14:00~16:00";
if ($rows['time'] == 4) $time = "16:00~18:00";
if ($rows['time'] == 5) $time = "18:00~20:00";
if ($rows['time'] == 6) $time = "20:00~22:00";
if ($rows['time'] == 7) $time = "22:00~24:00";
?>
<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/bootstrap.css">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/myboots.css">
  <link rel="stylesheet" href="css/fontawesome.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <title>訂票確認</title>
  <style>
    @media (max-width: 575px) {
      .h-sm-70 {
        height: 70% !important;
      }
    }
  </style>
</head>

<body class="bg-block">
  <!-- Modal -->
  <div class="modal fade" id="mymodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">謝謝您的光臨</h5>
          <button type="button" class="close" data-dismiss="modal">
            <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <div class="modal-body">
          <div id="" class="col">
            您的訂單編號:　<span class="font-weight-bold h5"><?= $rows['num'] ?></span>
            <p>請至售票處付費取票即可</p>

          </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          <button id="ticketok" type="button" class="btn btn-primary" onclick="ticketok()">
            你已完成訂單
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-image: linear-gradient(to right, #ffa400, #ffbe00, #ffd900,#fff305, #ffbe00,#ff8a05) !important">
    <a class="navbar-brand " href="index.html"><img src="img/logo-white.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <!-- 選票種 -->
  <div class="vh-100 vw-100  booking_bg pt-5 ">
    <div class="container h-100">
      <div class="row h-100  flex-lg-row justify-content-lg-center align-items-lg-center  ">
        <div class="row col-lg-2 h-60  justify-content-center px-0 mx-0 ">
          <div class="row align-items-center h-100 mt-5 mt-md-0 ml-lg-5 ">
            <img src="img/small_movie/<?= $img['big_img'] ?>" alt="" class="position-relative shadow " style="z-index:1;">
          </div>
        </div>
        <div class="row col-lg-6 h-60 h-sm-70 p-0 m-0 bg-white  rounded-d mx-3 mt-5 mt-md-0 mx-lg-0   ">
          <!--白框-->
          <div class="col-lg-1 h-100  d-none d-lg-block "></div>
          <div class="col-lg-11 h-100 w-100  p-0 ">
            <div id="booking" class="h-100">
              <div id="seatnum" class="row h-100 flex-column  pl-5 w-100 h-50 text-dark m-0">
                <div class="col mt-5 mt-lg-5 z2 ">
                  <span>你選了<?= $rows['many'] ?>個位子:
                  </span>
                  <?php
                  for ($i = 1; $i <= $rows['many']; $i++) {
                    ?>
                    <span class="seatCk<?= $i ?>" >
                      <i class="fas fa-child fa-lg "></i>
                    </span>
                  <?php
                  }
                  ?>
                </div>

                <div id="t1000" class="col ">
                  <span>早場 :</span>
                  <?php
                  for ($i = 1; $i <= $rows['many']; $i++) {
                    ?>
                    <div class="tic z2 a<?= $i ?> d-inline-block" id='ti' >
                      <i class="fas fa-child fa-2x "></i>
                    </div>
                  <?php
                  }
                  ?>
                </div>

                <div id="t1200" class="col ">
                  <span>全票 :</span>
                  <?php
                  for ($i = 1; $i <= $rows['many']; $i++) {
                    ?>
                    <div class="tic z2 a<?= $i ?> d-inline-block" id='ti' >
                      <i class="fas fa-child fa-2x "></i>
                    </div>
                  <?php
                  }
                  ?>
                </div>

                <div id="s0000" class="col ">
                  <span>優待 :</span>
                  <?php
                  for ($i = 1; $i <= $rows['many']; $i++) {
                    ?>
                    <div class="tic z2 a<?= $i ?> d-inline-block" id='ti' >
                      <i class="fas fa-child fa-2x "></i>
                    </div>
                  <?php
                  }
                  ?>
                </div>

                <div id="t2200" class="col ">
                  <span>夜貓 :</span>
                  <?php
                  for ($i = 1; $i <= $rows['many']; $i++) {
                    ?>
                    <div class="tic z2 a<?= $i ?> d-inline-block" id='ti' >
                      <i class="fas fa-child fa-2x "></i>
                    </div>
                  <?php
                  }
                  ?>
                </div>

                <div class="col ">
                  <span>長青 :</span>
                  <?php
                  for ($i = 1; $i <= $rows['many']; $i++) {
                    ?>
                    <div class="tic z2 a<?= $i ?> d-inline-block" id='ti' >
                      <i class="fas fa-child fa-2x "></i>
                    </div>
                  <?php
                  }
                  ?>
                </div>
              </div>
              <hr class="w-80">
              <div class="row col  m-0 p-0 mt-5">
                <form class=" col w-100 " method="post" action="api.php?do=seat_check">
                  <div class="row w-100 flex-column w-100 ml-0 pl-lg-3  text-dark  ">
                    <input id='time' type="hidden" name="time" value="<?= $rows['time'] ?>">
                    <input id='many' type="hidden" name="many" value="<?= $rows['many'] ?>">
                    <input type="hidden" name="movie" value="<?= $rows['ch_name'] ?>">
                    <input type="hidden" name="date" value="<?= $_GET['date'] ?>">
                    <input type="hidden" name="time" value="<?= $_GET['time'] ?>">
                    <div class="col pl-0 pl-md-5">
                      您所選擇的電影:<span class="font-weight-bold h5"><?= $rows['movie'] ?></span><br>
                    </div>
                    <div class="col pl-0 pl-md-5">
                      您所選擇的時間: <span class="font-weight-bold "><?= $rows['date'] ?>　<?= $time ?></span><br>
                    </div>
                    <div class="col pl-0 pl-md-5"><span id="tknum">您已確定了票種<span id="tknum">0</span>張</span>，位子為 :<span class="font-weight-bold ">
                        <?php
                        foreach ($seat as $value) {
                          echo $value . ".";
                        }
                        ?>
                      </span>
                      <br></div>
                  </div>

                  <!-- Button trigger modal -->
                  <div class="row justify-content-center align-items-center justify-content-lg-between  ml-lg-5 ">
                    <button id="submit" type="button" class="btn btn-warning col-6 mt-3" data-toggle="modal" data-target="">
                      送出
                    </button>
                  </div>


                  <!-- <input type="submit" class="btn btn-light mt-3 bg-danger" value="確認" > -->
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
            <span class="nav-link text-light active" href="#">Copyright &copy; JO</span>
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
    many
    // 判斷點擊後 票種顏色的顯示 和計算可點擊的數量
    // $(this).hasClass('myYellow') //return boolen
    let num = 1;
    $('.tic').click(function() {
      if ($(this).hasClass('z1')) {
        $(this).removeClass('z1');
        $(this).addClass('z2');
        num--;
        $(`.seatCk${num}`).addClass('z2');
        $(`.seatCk${num}`).removeClass('z1');
        $('#tknum').text(`您已確定了票種${(num-1)}張`);       
      } 
      else {
        if (num <= many) {
          $(this).addClass('z1');
          $(this).removeClass('z2');
          $(`.seatCk${num}`).addClass('z1');
          $(`.seatCk${num}`).removeClass('z2');
          num++;
          $('#tknum').text(`您已確定了票種${(num-1)}張`);
          }
      }
      if ((num - 1) == many) {
        $('#submit').attr('data-target', "#mymodal");
      } else {
        $('#submit').attr('data-target', "");
      }
    })

    // modal js
    $('#myModal').on('shown.bs.modal', function() {
      $('#myInput').trigger('focus')
    });

    // 完成訂單按鈕
    function ticketok() {
      $.post("api.php?do=unset", function(re) {

        location.href = "index.html";
      })
    }
  </script>


</body>

</html>