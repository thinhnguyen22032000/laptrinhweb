<?php include "inc/header.php"; ?>

<?php 
       
    include "model/hoadon.php";
    include "model/product.php";

   $hd = new hoadon();
   $product = new product();
   // them san pham xuat
   if(isset($_POST['submit_hoadon'])){
    $add_chitiethd= $hd->add_chitiethd($_POST);
   }
   // update quantity
   if(isset($_POST['submit_upqt'])){
    $quantity = $_POST['quantity'];
    $productid = $_POST['productid'];
    $phieuxuat_id = $_POST['phieuxuat_id'];
    $update_qt= $px->update_qt($quantity, $productid, $phieuxuat_id);
   }

   if(isset($_GET['hd'])){
    $hoadon_id = $_GET['hd'];
   }


?>

<div class="col-sm-4 text-left mgc"> 
<h3 class="tl_ct m-4">Chi tiết hóa đơn</h3>
<?php
       if(isset($add_chitiethd)){
        echo $add_chitiethd;
       }
 ?>
  <form class="m-3" method="post" action="">
    <?php 
         $get_hdid = $hd->get_hd_by_id($hoadon_id);
         if($get_hdid){
          while($row = $get_hdid->fetch_assoc()){ ?>
  
  <div class="form-group row ">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Mã hóa đơn:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm"
             name="hoadon_id" value="<?php echo $row['hoadon_id'] ?>" readonly > 
      </div>
  </div>
 
  
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Ngày lập:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm"
             name="date_order" value="<?php echo $row['date_order'] ?>" readonly> 
      </div>
  </div> 
  <?php
          }
         }
      
    ?>

  <!-- <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tên khách hàng:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm"
             placeholder="Tên khách hàng" name="customerName" > 
      </div>
  </div>  -->
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tên sản phẩm:</label>
      <div class="col-sm-7 ">
          <select class="form-control form-control-sm form-select" aria-label="Default select example" name="productid">
            <option selected>---Chọn sản phẩm---</option>
          <?php 
                $get_product = $product->get_name_productsell();
                if($get_product){
                  while($row_name_pd = $get_product->fetch_assoc()){ ?>
                      <option value="<?php echo $row_name_pd['productid'] ?>"><?php echo $row_name_pd['productName'] ?></option>
          <?php
                  }
                }
     
          ?>
                   
          </select>
        </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Số lượng:</label>
      <div class="col-sm-7">
            <input type="number" class="form-control form-control-sm" id="colFormLabelSm"
             placeholder="số lượng" name="quantity" > 
      </div>
  </div> 
  <div class="form-group row ">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Ghi chú:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" 
           name="note" > 
      </div>
  </div>  
   <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit_hoadon" value="Lưu">
  

</form>



</div>

<div class="col-sm-6 text-left mgc">
  <h3 class="m-4">Hóa đơn</h3>
 <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã hóa đơn</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>Chú thích</th>
      </tr>
    </thead>
     <tbody>
    <?php
          $show_chitiethd = $hd->show_chitiethd($hoadon_id);
          if($show_chitiethd){
            $tongtien = 0;
            while($row_cthd = $show_chitiethd->fetch_assoc()){ ?>
   
        <td><?php echo $row_cthd['chitiethd_id'] ?></td>
        <td><?php echo $row_cthd['productName'] ?></td>
        <td><?php echo $row_cthd['quantity'] ?></td>
        <td><?php
              $price_sp = ($row_cthd['quantity'] * $row_cthd['price']);
              echo $price = $price_sp - $price_sp*($row_cthd['discount']/100);
         ?></td>
        <td><?php echo $row_cthd['note'] ?></td>
       
      </tr>
       <?php
           $tongtien += $price; 
            }
          }
       
     ?>
    </tbody>
  </table>
   <p>Tổng cộng: <?php echo isset($tongtien)?$tongtien .'VNĐ':'0 VNĐ' ?></p>
   <a href="hoadonlist.php" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit">Lưu phiếu</a>
   <?php 
        if(isset($update_qt)){
          echo $update_qt;
        }
   ?>

 </div>
 





</div>
     
</div>
   
<?php include "inc/footer.php"; ?>