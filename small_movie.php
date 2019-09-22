<?php
 include_once('sql.php');
//  if(empty($_SESSION['admin'])) header('location:login.php');
//  $mainzone=(empty($_GET['do']))?'small_movie':$_GET['do'];
?>
<div class=" w-100">
  <form action="api.php?do=smallUpdate" method="post"  class="text-white p-5">
    <table id="dt" class="  p-0 m-0 table-striped" style="width:100%;border:2px solid #004080;">
      <thead class="thead-dark">
        <tr class="bg-dbule">
          <th class="text-center" width="1%">ID</th>
          <th class="text-center" width="5%">大圖</th>
          <th class="text-center" width="5%">片名(中文)</th>
          <th class="text-center" width="5%">片名(英文)</th>
          <th class="text-center" width="3%">連結位址</th>
          <th class="text-center" width="3%">分級圖</th>
          <th class="text-center" width="20%">電影介紹</th>
          <th class="text-center" width="3%">劇情</th>
          <th class="text-center" width="3%">語言</th>
          <th class="text-center" width="3%">預告片</th>
          <th class="text-center" width="3%">上映日期</th>
          <th class="text-center" width="5%">片長</th>
          <th class="text-center" width="5%">顯示</th>
          <th class="text-center" width="5%">刪除</th>
        </tr>
      </thead>
      <tbody>
        <?php
         $sql = "SELECT * FROM small_movie";
         $rows=$db->query($sql)->fetchAll();
         foreach ($rows as  $row) {          
        ?>
        <tr>
          
          <th class="text-center bg-dbule" scope="row">
            <p name="<?=$row['id']?>"><?=$row['id']?><p>

          </th>
          <td class="text-center">
            <img src="img/small_movie/<?=$row['big_img']?>" width="30" height=auto  alt="<?=$row['ch_name']?>"></td>
          <td class="text-center" width=""><input type="text" name="ch_name[<?=$row['id']?>]" id="" value="<?=$row['ch_name']?>"size="18">
          </td>
          <td class="text-center">
            <input type="text" name="en_name[<?=$row['id']?>]" id="" value="<?=$row['en_name']?>" size="26">
          </td>
          <td class="text-center">
            <input type="text" name="big_img[<?=$row['id']?>]" id="" value="<?=$row['big_img']?>" size="6">
          </td>
          <td class="text-center">
            <input type="text" name="small_img[<?=$row['id']?>]" id="" value="<?=$row['small_img']?>" size="4">
          </td>
          <td class="text-center">
            <input type="text" name="introduction[<?=$row['id']?>]" id="" value="<?=$row['introduction']?>" size="30">
          </td>
          <td class="text-center">
            <input type="text" name="type[<?=$row['id']?>]" id="" value="<?=$row['type']?>" size="1">
          </td>
          <td class="text-center">
            <input type="text" name="lan[<?=$row['id']?>]" id="" value="<?=$row['lan']?>" size="1">
          </td>
          <td class="text-center">
            <input type="text" name="video[<?=$row['id']?>]" id="" value="<?=$row['video']?>" size="12">
          </td>
          <td class="text-center">
            <input type="text" name="time[<?=$row['id']?>]" id="" value="<?=$row['time']?>" size="10">
          </td>
          <td class="text-center">
            <input type="text" name="time_length[<?=$row['id']?>]" id="" value="<?=$row['time_length']?>" size="6">
          </td>
          <td class="text-center">
            <input type="checkbox" name="display" id="" value="<?=$row['id']?>" style="zoom:220%;" class="ml-4 mt-2"  size="1">
          </td>
          <td class="text-center">
            <input type="checkbox" name='del[]' value="<?=$row['id']?>" style="zoom:220%;" class="ml-4 mt-2" size="1">
          </td>
          
        </tr>
        <?php
        };
        ?>
      </tbody>

    </table>
    <div class="text-center ">    
      <button class="btn btn-primary m-3" onclick="gesli()" >新增 </button>
      <button class="btn btn-warning m-3" type="submit" onclick="chkok()" >修改</button>
    
    </div>
   
  </form>
</div>

<!-- <button onclick="op('#cover','#cvr','view.php?do=small_movie_chg')">新增</button> -->