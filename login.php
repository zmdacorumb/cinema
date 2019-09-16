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
    .a:focus{
      outline:none;
      background: transparent;
      }
  </style>
  <title>後台登入頁</title>
</head>
      
<body>
  <div class="container-fluid bodyimg p-0 vh-100 vw-100 overflow-hidden">
    <div class="row h-100 bg_filter text-white justify-content-around align-items-center ">
      <form method="post" action="api.php?do=check"
        class="col-10 col-md-8 col-lg-3 w-100 h-75 table-bordered flex-column  rounded ">
        <p class="mt-5 ml-4 h3 ">後台登入</p>
        <div class="d-flex justify-content-center my-5">
          <i class="fas fa-user-circle fa-7x my-1 "></i>
        </div>
        <div class="d-flex border rounded-pill align-items-center py-2 mx-3 ">
          <i class="far fa-user fa-2x mx-3"></i>
          <input type="text" class="form-control col-lg-9 a text-white" id="text" name="acc" placeholder="輸入帳號">
        </div>
        <div class="d-flex border rounded-pill align-items-center mt-5 py-2 mx-3 ">
          <i class="fas fa-key fa-2x mx-3"></i>
          <input type="password" class="form-control col-lg-9 a text-white" id="password" name="pwd" placeholder="輸入密碼">
        </div>
        <div style="opacity:0;">
          <p class="ml-4 my-5 d-lg-inline tip " >輸入的帳號或密碼錯誤</p>

        </div>
        <div class="my-4 mx-3  ">
          <button id="submit" type="submit" class=" bg-light  btn-block text-dark py-2 ">登入</button>
        </div>
      </form>
    </div>
  </div>
  <!-- <script>
    $(function () {
        $('input').val('')
        $('#submit').on('click', function () {
            $('.tip').show()
        })
    })
  </script> -->




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