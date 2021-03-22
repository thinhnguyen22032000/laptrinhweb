<?php include "inc/header.php"; ?>
<style type="text/css">
  .position-absolute{
    right: 30px;
    top: 50px;
  }
</style>
<?php 
       
   include "model/phieunhap.php";
    include "model/product.php";

   $pn = new phieunhap();
   $product = new product();

  
   if(isset($_GET['ctpn'])){
    $phieunhap_id = $_GET['ctpn'];
   }


?>


<div class="col-sm-9 text-left mgc">
  <h3 class="tl_ct">Chi tiết phiếu nhập</h3>
 <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã chi tiết</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá</th>
        <th>Thành tiền</th>
        <th>Chú thích</th>
      </tr>
    </thead>
     <tbody>
    <?php
          $show_chitietpn = $pn->show_chitietpn($phieunhap_id);
          if($show_chitietpn){
            $tongtien = 0;
            while($row_ctpn = $show_chitietpn->fetch_assoc()){ ?>
   
        <td><?php echo $row_ctpn['chitietpn_id'] ?></td>
        <td><?php echo $row_ctpn['productName'] ?></td>
        <td><?php echo $row_ctpn['quantity'] ?></td>
        <td><?php echo $row_ctpn['price'] ?></td>
        <td><?php echo $thanhtien = $row_ctpn['quantity'] * $row_ctpn['price'] ?></td>
        <td><?php echo $row_ctpn['note'] ?></td>
       
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