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

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/myboots.css">
  <title>我的後台</title>
</head>

<body>
  <div class="container-fluid">
    <div>
      <nav class="navbar mb-5 navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand font-weight-bold" href="#">後台管理</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav font-weight-bold">
            <li class="nav-item">
              <a class="nav-link" href="?do=small_movie">上映電影Slider</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" tabindex="-1">Disabled</a>
            </li>
          </ul>
          <div>
            <button onclick="tip()">登出</button>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <!-- 前台上映電影區 -->
  <div class="container-fluid">
  <?php include_once($mainzone.".php") ?>
  </div>

  <!-- Optional JavaScript -.....................................................................................->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- 其它套件 or js 要放下面 -->
  <script src="js/js.js"></script>
  <script>
   function tip(){
    location.replace('api.php?do=logout');
  }
  </script>
</body>

</html>