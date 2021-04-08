<?php include "inc/header.php"; ?>
<style type="text/css">
 
</style>
<?php 
       
   include "model/hoadon.php";
   include "model/product.php";

   $hd = new hoadon();
   $product = new product();
  
  
   if(isset($_GET['cthd'])){
    $hoadon_id = $_GET['cthd'];
   }


?>


<div class="col-sm-9 text-left mgc f-ct">
  <h3 class="tl_ct">Chi tiết hóa đơn</h3>
  <?php
          $show_chitiethd = $hd->show_chitiethd($hoadon_id);
          if($show_chitiethd){
       
            $row_cthd = $show_chitiethd->fetch_assoc() ?>

                <div class="det-hd">
                <p>Mã hóa đơn: <?php echo $row_cthd['hoadon_id'] ?></p>
                <p>Ngày lập: <?php echo $row_cthd['date_order'] ?></p>
                <p>Mã người lập: <?php echo $row_cthd['adminid']?> </p>
                <p>Số loại: <?php echo mysqli_num_rows($show_chitiethd)?> </p>

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
        <th>Đơn vị</th>
        <th>Thành tiền</th>
        <th>giảm giá</th>
        <th>Chú thích</th>
      </tr>
    </thead>
     <tbody>
       <?php
          $show_chitiethd = $hd->show_chitiethd($hoadon_id);
          if($show_chitiethd){
           $tongtien = 0;
            while($row_cthd = $show_chitiethd->fetch_assoc()){ ?>

        <tr>
   
        <td><?php echo $row_cthd['chitiethd_id'] ?></td>
        <td><?php echo $row_cthd['productName'] ?></td>
        <td><?php echo $row_cthd['quantity'] ?></td>
        <td><?php
          if($row_cthd['unit']==1){
            echo "kg";
          }elseif($row_cthd['unit']==2){
            echo "chai";
          }
          ?>
        </td>
        <td><?php echo $total = ($row_cthd['quantity'] * $row_cthd['price']) - ($row_cthd['quantity'] * $row_cthd['price']) * ($row_cthd['discount']/100)  ?></td>
        <td><?php echo $row_cthd['discount'] ?></td>
        <td><?php echo $row_cthd['note'] ?></td>
       
      </tr>
       <?php
        $tongtien +=$total;
            }
           
          }
       
     ?>
    
    </tbody>
  </table>
  <p>Tổng tiền: <?php echo $tongtien.' VNĐ' ?></p>
 </div>





</div>
     
</div>
   
<?php include "inc/footer.php"; ?>