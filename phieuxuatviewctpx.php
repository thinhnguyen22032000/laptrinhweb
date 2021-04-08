<?php include "inc/header.php"; ?>
<style type="text/css">
 
</style>
<?php 
       
   include "model/phieuxuat.php";
    include "model/product.php";

   $px = new phieuxuat();
   $product = new product();

  
   if(isset($_GET['ctpx'])){
    $phieuxuat_id = $_GET['ctpx'];
   }


?>


<div class="col-sm-9 text-left mgc f-ct">
  <h3 class="tl_ct">Chi tiết phiếu xuất</h3>

      <?php
          $show_chitietpx = $px->show_chitietpx($phieuxuat_id);
          if($show_chitietpx){
           
            $row_ctpx = $show_chitietpx->fetch_assoc() ?>

              <div class="det-hd">
                <p>Mã phiếu xuất: <?php echo $row_ctpx['phieuxuat_id'] ?></p>
                <p>Ngày lập: <?php echo $row_ctpx['date_export'] ?></p>
                <p>Mã người lập: <?php echo $row_ctpx['adminid']?> </p>
                <p>Số loại: <?php echo mysqli_num_rows($show_chitietpx) ?> </p>

              </div>
       <?php
            
          }
       
     ?>
 <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã chi tiết</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Chú thích</th>
      </tr>
    </thead>
     <tbody>
    <?php
          $show_chitietpx = $px->show_chitietpx($phieuxuat_id);
          if($show_chitietpx){
           
            while($row_ctpx = $show_chitietpx->fetch_assoc()){ ?>
   
        <td><?php echo $row_ctpx['ctpx_id'] ?></td>
        <td><?php echo $row_ctpx['productName'] ?></td>
        <td><?php echo $row_ctpx['quantity'] ?></td>   
        <td><?php echo $row_ctpx['note'] ?></td>
       
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
   
<?php include "inc/footer.php"; ?>