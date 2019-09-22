<?php
include_once('sql.php');
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

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="slick/slick.js" type="text/javascript"></script>
  <style type="text/css">
    /* .a:focus {
      background: transparent;
      outline:none;
    } */
  </style>
  <title>會員註冊頁</title>
</head>

<body>  
  <section class="overflow-hidden">
    <!-- nav -->
    <header class="navbar navbar-expand-lg navbar-light py-3 bg-navnav fixed-top ">
      <a class="navbar-brand  " href="index.html">
        <img src="img/logo-white.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-row-reverse px-5" id="navbarNavAltMarkup">
        <div class="navbar-nav d-flex menu-left text-white">
          <a class="nav-item nav-link animated bounceInDown text-white " href="index.html">回首頁</a>
          <a class="nav-item nav-link animated bounceInDown text-white" href="ticket_price.html">電影票價</a>
        </div>
      </div>
    </header>

    <div class="container-fluid bodyimg p-0 vh-100 vw-100  ">
      <div class="row h-100 bg_filter text-white justify-content-around align-items-center">
        <form onsubmit="return checkflag()" method="post" action="api.php?do=register"
          class="col-10 col-md-8 col-lg-5 w-100 h-75 mt-5 table-bordered flex-column   rounded needs-validation" novalidate>
          
          <div class="mt-5 mt-md-5">
            <p class="text-white h2 mt-lg-3 text-center">會員註冊</p>
          </div>      
          <div class="d-flex border rounded-pill align-items-center mt-3 mt-md-4 py-2 mx-3">
            <i class="far fa-user fa-2x mx-3"></i>
            <input type="text" class="form-control  text-white col-8 col-lg-8 a"  name="acc" placeholder="註冊帳號" required  onchange='flag=0'>
            <input type="button" class="btn btn-dark " value="檢測帳號" onclick='check()'>
          </div>
          <div class="d-flex border rounded-pill align-items-center my-4  my-md-5 py-2 mx-3 ">
            <i class="fas fa-key fa-2x mx-3"></i>
            <input type="password" class="form-control text-white col-lg-10 a"  name="pwd" placeholder="輸入密碼" required>
          </div>
          <div class="d-flex border rounded-pill align-items-center my-4 my-md-5 py-2 mx-3">
          <i class="far fa-envelope fa-2x mx-3"></i>
            <input type="email" class="form-control text-white col-lg-10 a "  name="email" placeholder="E-mail" required>
          </div>
          <div class="d-flex border rounded-pill align-items-center py-2 mx-3  ">
          <i class="fas fa-mobile-alt fa-2x mx-4"></i>
            <input type="tel" class="form-control text-white col-lg-10 a"  name="tel" placeholder="聯絡電話" required>
          </div>
          <div class=" text-center  flex-md-column justify-content-around align-items-md-center mt-4 my-md-5 my-lg-3 row  ">
            <button id="submit" type="submit" class="col-5 col-md-6 bg-light  btn-block text-dark  py-3 py-md-2 mb-md-4">送出</button>

            <button id="reset" type="reset" class="col-5 col-md-6 bg-light  btn-block  text-dark my-0 py-3 py-md-2 ">重設</button>
          </div>
        </form>
      </div>
    </div>
  </section>






  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- 其它套件 or js 要放下面 -->
  <script>

//bootstrap 驗證表單
//Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

    // 帳號驗證
    var flag=0;
    function check(){
      let acc=$("input[name=acc]").val();
      if(acc.length < 6){     
        alert('帳號不得小於6碼');
      }
      else{
      $.post("api.php?do=sir_register_check",{acc},function(re){
       flag=(re=="可使用此帳號")?1:0;
       alert(re);
      })
      }
    }
    function checkflag(){
      if(!flag){
        alert("請先按檢測帳號鈕");
        return false;
      }
      else{
        return true;
      }
    }

</script>

</body>

</html>