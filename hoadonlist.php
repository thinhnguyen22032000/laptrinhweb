<?php include "inc/header.php"; ?>
<?php include "lib/format.php";
   $fm = new Format();
 ?>

<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');
    include 'model/hoadon.php';
    $hd = new hoadon();

      if(!isset($_GET['delid']) || $_GET['delid'] == null){
       
      }else{
        $delid = $_GET['delid'];
        
        $del_hd = $hd->del_hd($delid); //xoa hoa don

      }
      if(isset($_POST['submit_hoadon'])){ // thêm hoa hơn
       $date = date("Y-m-d H:i:s");
        $adminid =  session::get('adminid');
        
        $add_hd = $hd->add_hoadon($adminid,$date);
      }

?>

<div class="col-sm-9 text-left mgc f-ct"> 

   <div class="container">
  <h2 class="tl_ct">Danh sách hóa đơn</h2>
  <?php 
      if(isset($del_hd)){
        echo $del_hd;
      }
  ?>
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
        <th>Tổng tiền</th>
      </tr>
    </thead>
    <tbody>
     <?php 

         $get_hd = $hd->phantrang_hoadon();
          if($get_hd){
          
            while($result = $get_hd->fetch_assoc())
           
          {?> 
    
      <tr>
        <td><?php echo $result['hoadon_id'] ?></td>
        <td><?php echo $result['adminid'] ?></td>
        <td><?php echo $result['date_order'] ?></td>
        <td><?php echo $fm->canvert_vnd($result['total']) ?></td>
        <td>
          
          <a href="hoadonviewct.php?cthd=<?php echo $result['hoadon_id'] ?>" type="button" class="btn btn-warning btn-sm">view</a>
          <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['hoadon_id'] ?>" class="btn btn-danger ml-2 btn-sm">Del</a>

        </td>
      </tr>
      <?php 
     
    }
    }
     ?>
    </tbody>
  </table>      
 <!--  phan trang -->

  <div class="phantrang">
   <?php 
        $sanpham1trang = 5;
        $row = $hd->row_hd();
        $num_row = mysqli_num_rows($row);
        $sotrang = ceil($num_row/$sanpham1trang);
       
        $i = 1;
        echo "Trang" ." ";

       
        for($i=1; $i<=$sotrang;$i++){
          echo "
         
          <a class='phantrang' href='?page=".$i."'>".$i."</a>
        


          ";
        }


   ?>
 </div>    
</div>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>