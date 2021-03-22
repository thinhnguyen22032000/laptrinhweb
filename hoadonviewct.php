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


<div class="col-sm-9 text-left mgc">
  <h3 class="tl_ct">Chi tiết hóa đơn</h3>
 <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã chi tiết</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>giảm giá</th>
        <th>Chú thích</th>
      </tr>
    </thead>
     <tbody>
    <?php
          $show_chitiethd = $hd->show_chitiethd($hoadon_id);
          if($show_chitiethd){
           
            while($row_cthd = $show_chitiethd->fetch_assoc()){ ?>
   
        <td><?php echo $row_cthd['chitiethd_id'] ?></td>
        <td><?php echo $row_cthd['productName'] ?></td>
        <td><?php echo $row_cthd['quantity'] ?></td>
        <td><?php echo ($row_cthd['quantity'] * $row_cthd['price']) - ($row_cthd['quantity'] * $row_cthd['price']) * ($row_cthd['discount']/100)  ?></td>
        <td><?php echo $row_cthd['discount'] ?></td>
        <td><?php echo $row_cthd['note'] ?></td>
       
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