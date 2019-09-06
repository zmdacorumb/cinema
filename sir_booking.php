<?php
include_once("sql.php");
if(empty($_SESSION)) header("location:sir_login.php?do=re_check");
// print_r($_POST);
// print_r($_GET);
// print_r($_SESSION);
// $sql = "SELECT * FROM small_movie";
// $rows=$db->query($sql)->fetchAll();
// print_r($rows);
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

  <title>Hello, world!</title>
</head>

<body>
       <!-- 訂票系統 -->
   <section  class="vw-100 row justify-content-center bg-block fiexd-top  sticky-top" style="margin:0;">
      <div class="container " >
        <form action="api.php?do=test" method="POST">
          <div class="form-row align-items-center justify-content-center m-0 ">
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






  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- 其它套件 or js 要放下面 -->
  <script>
         // 訂票系統
    // 選擇電影 下拉式選單 ajax取得資料
    $.post("api.php?do=chmovie", function (re){
      $('#chmovie').html(re);
    })
    //  日期計算函式
    function getday(add){
      let today = new Date;
      let gg = today.getDate();//算今天幾號
      today.setDate(gg + add);//設定今天日期為 今日號+add
      let yy = today.getFullYear();
      let mm = today.getMonth() + 1;
      let dd = today.getDate();
      if(mm<10) mm=`0${mm}`;
      if(dd<10) dd=`0${dd}`;
      return `${yy}-${mm}-${dd}`;
    }
    //選擇日期 下拉式選單
    $('#chdate').html(`
      <option value="">請選擇場次</option>
      <option value=${getday(0)}>${getday(0)}</option>
      <option value=${getday(1)}>${getday(1)}</option>
      <option value=${getday(2)}>${getday(2)}</option>
      <option value=${getday(3)}>${getday(3)}</option>
      <option value=${getday(4)}>${getday(4)}</option>
      <option value=${getday(5)}>${getday(5)}</option>
      <option value=${getday(6)}>${getday(6)}</option>
      <option value=${getday(7)}>${getday(7)}</option>
    `);
    //  選擇場次 下拉式選單
     function getval(){
        let movie = $('#chmovie').val();
        let date = $('#chdate').val();
        // console.log(movie,date);
        $.post("api.php?do=booking",{movie,date},function (re){
          $('#chtime').html(re);
        });

      }
      getval();
  </script>
</body>

</html>