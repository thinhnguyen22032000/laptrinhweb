<?php include "inc/header.php"; ?>

<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');
    include 'model/hoadon.php';
    $hd = new hoadon();

      if(!isset($_GET['delid']) || $_GET['delid'] == null){
       
      }else{
        $delid = $_GET['delid'];
        
        $del_su = $cat->del_su($delid);

      }
      if(isset($_POST['submit_hoadon'])){
       $date = date("Y-m-d H:i:s");
        $adminid =  session::get('adminid');
        $add_hd = $hd->add_hoadon($adminid,$date);
      }

?>

<div class="col-sm-9 text-left mgc"> 

   <div class="container">
  <h2 class="tl_ct">Danh sách hóa đơn</h2>
  <form method="post" action="">
    <input type="submit" class="btn btn-success mb-3 lr-btn" name="submit_hoadon" value="Thêm hóa đơn">
   
    </form>
  <?php 
       if(isset($del_su)){
        echo $del_su;
       }
  ?>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã xuất </th>
        <th>Mã nhân viên</th>
        <th>Ngày lập</th>
      </tr>
    </thead>
    <tbody>
     <?php 

         $get_hd = $hd->show_hoadon();
          if($get_hd){
          
            while($result = $get_hd->fetch_assoc())
           
          {?> 
    
      <tr>
        <td><?php echo $result['hoadon_id'] ?></td>
        <td><?php echo $result['adminid'] ?></td>
        <td><?php echo $result['date_order'] ?></td>
        <td>
          
          <a href="hoadonviewct.php?cthd=<?php echo $result['hoadon_id'] ?>" type="button" class="btn btn-warning btn-sm">view</a>
          <!-- <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['supplierid'] ?>" class="btn btn-danger ml-2 btn-sm">Del</a> -->

        </td>
      </tr>
      <?php 
     
    }
    }
     ?>
    </tbody>
  </table>      
  
</div>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>