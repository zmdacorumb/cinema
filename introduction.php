<?php
include_once("sql.php");
$sql = "SELECT * FROM small_movie  WHERE id=".$_GET['id'].""; 
    $rows = $db->query($sql)->fetch();
?>
<!-- modal youtube影片介紹-->


<!-- 電影介紹 -->
<div class="container h-100 ">
  <div class="row h-75 mt-5  ">
    <div class="col-lg-3  h-100  mr-lg-5 text-movie" id="movie_video" >
      <div class="form-group row justify-content-center d-none d-md-block text-center">
        <img calss="" id="photo" src="img/small_movie/<?=$rows['big_img']?>" width="285">
      </div>

        <!-- 小尺寸才會顯示 -->
      <div class="form-group row justify-content-center my-lg-0 ml-lg-1 d-md-none  ">
        <div class="col-4 col-lg-6 ">
            <label>片名 : </label>
        </div>
        <div class="col-4 col-lg-6 text-white">
        <span class="float-right"><?=$rows['ch_name']?></span>
        </div>
        <hr class="col-8 col-md-10">
      </div>

      <!--都會顯視 -->
      <div class="form-group row justify-content-center my-lg-0 ml-lg-1 ">
        <div class="col-4 col-lg-6  ">
            <label>時間 : </label>
        </div>
        <div class="col-4 col-lg-6   text-white ">
        <span class="float-right"><?=$rows['time_length']?></span>
        </div>
        <hr class="col-8 col-md-10">
      </div>

      <div class="form-group row justify-content-center my-lg-0 ml-lg-1  ">
        <div class="col-4 col-lg-6 float-left">
            <label>語言 : </label>
        </div>
        <div class="col-4 col-lg-6 text-white ">
          <span class="float-right"><?=$rows['lan']?></span>
          
        </div>
        <hr class="col-8 col-md-10">
      </div>

      <div class="form-group row justify-content-center my-lg-0 ml-lg-1 ">
        <div class="col-4 col-lg-6 ">
            <label>預告片 : </label>
        </div>
        <div class="col-4 col-lg-6 i-video" >
        <i class="float-right far fa-play-circle fa-2x text-white i"  data-toggle="modal" data-target="#exampleModal"></i>  
      </button>
                 
        </div>
        <hr class="col-8 col-md-10">
      </div>

    </div>
    <div id="movie_line"></div>
    <div class="col h-100 p-0 d-none d-lg-block">
      <div id="mname" class="col-lg-12 h-10 text-warning my-5 ">
      <p class="h1"><?=$rows['ch_name']?></p>
      <p class="ml-lg-3" ><?=$rows['en_name']?></p>
      </div>
      <div class="col-lg-12 h-40 ">
        <ul class="list-unstyled text-warning movie_li" id="introduction" >
          <li><?=$rows['introduction']?></li>
          <li>影片類型 :　<?=$rows['type']?></li>
          <li>上映日期 :　<?=$rows['time']?></li>
          <img src="img/<?=$rows['small_img']?>" alt="" width="50">
        </ul>
      </div>
      <div class="col-lg-12  h-10 row text-white  align-items-lg-end ">
        <span class="text-warning mb-2">電影場次:</span>
        <span class="mx-2 p-2 bg-seat rounded">10:00</span>
        <span class="mx-2 p-2 bg-seat rounded">12:00</span>
        <span class="mx-2 p-2 bg-seat rounded">14:00</span>
        <span class="mx-2 p-2 bg-seat rounded">16:00</span>
        <span class="mx-2 p-2 bg-seat rounded">18:00</span>
        <span class="mx-2 p-2 bg-seat rounded">20:00</span>
        <span class="mx-2 p-2 bg-seat rounded">22:00</span>
      </div>
            

          
      <!-- <input class="col-lg-2 btn btn-dark" type="button" value="訂票去"> -->
    </div>
  </div>
</div>

