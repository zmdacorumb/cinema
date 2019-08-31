<?php
include_once("sql.php");
$sql = "SELECT * FROM small_movie  WHERE id=".$_GET['id'].""; 
    $rows = $db->query($sql)->fetch();
?>
<div class="container h-100 ">
  <div class="row h-75 mt-5 ">
    <div class="col-lg-4  h-100 p-0">
      <img id="photo" src="img/small_movie/<?=$rows['big_img']?>" width="300">
    </div>
    <div class="col  h-100 h-100 p-0">
      <div id="mname" class="col-lg-12 h-10 text-warning h1 my-5 "><?=$rows['ch_name']?></div>
      <div class="col-lg-12 h-40 ">
        <ul class="list-unstyled text-warning" id="introduction">
          <li><?=$rows['introduction']?></li>
          <li>影片類型 :　<?=$rows['type']?></li>
          <li>上映日期 :　<?=$rows['time']?></li>
          <img src="img/<?=$rows['small_img']?>" alt="" width="50">
        </ul>
      </div>
      <div class="h-10">
        <span class="col-lg-3 bg-white">10:00</span>
        <span class="col-lg-3 bg-white">12:00</span>
        <span class="col-lg-3 bg-white">14:00</span>
        <span class="col-lg-3 bg-white">16:00</span>
        <span class="col-lg-3 bg-white">18:00</span>
        <span class="col-lg-3 bg-white">20:00</span>
        <span class="col-lg-3 bg-white">22:00</span>
      </div>
      <!-- <input class="col-lg-2 btn btn-dark" type="button" value="訂票去"> -->
    </div>
  </div>
</div>