<?php
include_once('sql.php');
// 非會員購票進入確認
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
  <!-- slick slider 電影小欄位 -->
  <link rel="stylesheet" href="slick/slick.css">
  <link rel="stylesheet" href="slick/slick-theme.css">
  <!--  -->
  <link rel="stylesheet" href="css/fontawesome.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="slick/slick.js" type="text/javascript"></script>
  <style type="text/css">
    .a:focus {
      background: transparent;
    }
  </style>
  <title>會員登入頁</title>
</head>

<body>  
  <header class="vw-100 navbar navbar-expand-lg navbar-light py-2   fixed-top" >
    <a class="navbar-brand ml-5 " href="index.html">
      <img src="img/logo-white.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse flex-row-reverse px-5" id="navbarNavAltMarkup">
      <div class="navbar-nav d-flex menu-left text-white">
        <a class="nav-item nav-link animated bounceInDown text-white " href="index.html">回首頁</a>
        <a class="nav-item nav-link animated bounceInDown text-white" href="#">電影票價</a>
        <a class="nav-item nav-link animated bounceInDown text-white" href="sir_registered.php">加入會員</a>
        <!-- <a class="nav-item nav-link animated bounceInDown text-white" href="sir_login.php"
        tabindex="-1">登入</a> -->
      </div>
    </div>
  </header>
  
  <section class="overflow-hidden">
    <div class="container-fluid bodyimg p-0 vh-100 vw-100">
      <div class="row h-100 bg_filter text-white justify-content-center align-items-center ">
        <form method="post" action="api.php?do=re_check"
          class="col-10 col-md-8 col-lg-3 mt-5 w-100 h-75 table-bordered flex-column rounded ">
          <div class="mt-4 mt-md-4">
            <p class="text-white h3 mt-lg-3">會員登入</p>
          </div>
          <div class="d-flex  justify-content-center">
            <i class="fas fa-user-circle fa-7x my-md-2"></i>
          </div>
          <div class="d-flex my-3 my-md-4 border rounded-pill align-items-center py-2 mx-3 ">
            <i class="far fa-user fa-2x mx-3"></i>
            <input type="text" class="form-control text-white col-lg-9 a" id="text" name="acc" placeholder="輸入帳號">
          </div>
          <div class="d-flex border rounded-pill align-items-center py-2 mx-3 ">
            <i class="fas fa-key fa-2x mx-3"></i>
            <input type="password" class="form-control text-white col-lg-9 a" id="password" name="pwd" placeholder="輸入密碼">
          </div>
          <p class="col-lg-6 ml-4  d-lg-inline tip" >輸入的帳號或密碼錯誤</p>
          <div class="my-3 my-md-5 text-center align-items-center mx-5  ">
            <button id="submit" type="submit" class="col-12 bg-light  btn-block text-dark py-2 ">登入</button>
          </div>
          <div class="my-3 my-md-5 text-center align-items-center mx-5   ">
            <button id="submit" class=" bg-light  btn-block text-dark py-2 ">
              <a class="text-dark" href="api.php?do=no_sir_booking_check&id=<?=$_GET['id']?>&date=<?=$_GET['date']?>&time=<?=$_GET['time']?>">非會員登入</a>
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
  <script>
    $(function () {
      $('input').val('');
        $('#submit').on('click', function () {
            $('.tip').show();
        })   
      })

  </script>




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- 其它套件 or js 要放下面 -->
  <script>

  </script>
</body>

</html>