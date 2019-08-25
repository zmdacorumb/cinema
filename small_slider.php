<?php
 include_once('sql.php');
 if(empty($_SESSION['admin'])) header('location:login.php');
 $mainzone=(empty($_GET['do']))?'small_slider':$_GET['do'];
?>

<div class="container-fluid bg-dark ">

  <form action="api.php?do=smallUpdate" method="post"  class="text-white">
    <table class=" table-dark p-0 m-0">
      <thead class="">
        <tr>
          <th>ID</th>
          <th>大圖</th>
          <th>片名(中文)</th>
          <th>片名(英文)</th>
          <th>連結位址</th>
          <th>分級圖連結</th>
          <th>片長</th>
          <th>是否顯示</th>
          <th>刪除</th>
        </tr>
      </thead>
      <tbody>
        <?php
         $sql = "SELECT * FROM small_slider";
         $rows=$db->query($sql)->fetchAll();
         foreach ($rows as  $row) {          
        ?>
        <tr>
          
          <th scope="row"><p name="<?=$row['id']?>"><?=$row['id']?><p></th>
          <td><img src="img/small_slider/<?=$row['big_img']?>" width="70" height="100"  alt="<?=$row['ch_name']?>"></td>
          <td><input type="text" name="ch_name[<?=$row['id']?>]" id="" value="<?=$row['ch_name']?>"></td>
          <td><input type="text" name="en_name[<?=$row['id']?>]" id="" value="<?=$row['en_name']?>"></td>
          <td><input type="text" name="big_img[<?=$row['id']?>]" id="" value="<?=$row['big_img']?>"></td>
          <td><input type="text" name="small_img[<?=$row['id']?>]" id="" value="<?=$row['small_img']?>"></td>
          <td><input type="text" name="time_length[<?=$row['id']?>]" id="" value="<?=$row['time_length']?>"></td>
          <td><input type="checkbox" name="display" id="" value="<?=$row['id']?>" style="zoom:220%;" class="ml-4 mt-2 active" ></td>
          <td><button name='del'>刪除</button>           </td>
        </tr>
        <?php
        };
        ?>
      </tbody>
    </table>
    <table>
      <button class="btn btn-primary" onclick="gesli()" >新增 </button>
      <button class="btn btn-warning" type="submit" onclick="chkok()" >修改</button>
    </table>
  </form>
</div>

<!-- <button onclick="op('#cover','#cvr','view.php?do=small_slider_chg')">新增</button> -->