<?php
 include_once('sql.php');
 if(empty($_SESSION['admin'])) header('location:login.php');
$mainzone=(empty($_GET['do']))?'small_movie':$_GET['do'];
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/css.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/myboots.css">
  <title>我的後台</title>
</head>

<body>
  <div class="container-fluid vh-100 ">
    <div class="row h-100">
      <div class="col-1 bg-dbule text-center">
        <nav class="nav flex-column nav-pills ">
          <a class="navbar-brand font-weight-bold text-white  m-0" href="#">後台管理</a>
          <hr class="w-100 bg-white">
          <button class="navbar-toggler btn-outline-secondary" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="nav-link" id="navbarNav">
            <ul class="navbar-nav font-weight-bold">
              <li class="nav-item my-2">
                <a class="btn btn-primary nav-link text-white " href="?do=small_movie">上映輪播</a>
              </li>
              <li class="nav-item my-2">

                <a class="btn btn-primary nav-link text-white" href="#">預告輪播</a>
              </li>
              <li class="nav-item my-2">
                <a class="btn btn-primary nav-link text-white" href="#">訂單處理</a>
              </li>
              <li class="nav-item my-2">
                <a class="btn btn-primary nav-link text-white" href="#" >會員資料</a>
              </li>
            </ul>
            <div class="mt-4">
              <button class="btn btn-outline-light" onclick="tip()">登出</button>
            </div>
          </div>
        </nav>
      </div>
      <div class="col-11 p-0 h-100 bg-lblue">
        <?php include_once($mainzone.".php") ?>
      </div>
    </div>
  </div>
  <!-- 後台上映電影區 -->


  <!-- Optional JavaScript -.....................................................................................>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- 其它套件 or js 要放下面 -->
  <script src="js/myjs.js"></script>
  <script>
   function tip(){
    location.replace('api.php?do=logout');
  }
  </script>
</body>

</html>