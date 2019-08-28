<!-- <?php
 include_once('sql.php');
 $sql = "SELECT * FROM small_movie";
 $rows=$db->query($sql)->fetchAll();
   foreach ($rows as $do => $row) {     
         ?>
      <div  class="col-lg-3 my-4 ">
         <div class="card hoverMe"  style="border: none">

            <img class="card-img-top" src="img/small_movie/<?=$row['big_img']?>" >
            <div class="card-body text-white">
               <h4 class="card-title font-weight-bolder h5" style="color:#000"><?=$row['ch_name']?></h4>
               <p class="card-text" style="color:#999; font-size:0.5rem;"><?=$row['en_name']?></p>
            </div>
         </div>
      </div> 
   <?php
      }          
?> -->