<?php include "inc/header.php"; ?>
<style type="text/css">
  .position-absolute{
    right: 30px;
    top: 50px;
  }
  /*.content {
  border: 2px solid #ccc;
  padding: 10px;
  width: 20em;
}*/

.items {
  width: -moz-fit-content;
  width: fit-content;
 
  padding: 5px;
  margin-bottom: 1em;
}
</style>
<?php 
       
   include "model/phieuxuat.php";
    include "model/product.php";

   $px = new phieuxuat();
   $product = new product();
   // them san pham xuat
   if(isset($_POST['submit_phieuxuat'])){
    $add_chitietpx= $px->add_chitietpx($_POST);
   }
   // update quantity
   if(isset($_POST['submit_upqt'])){
    $quantity = $_POST['quantity'];
    $productid = $_POST['productid'];
    $phieuxuat_id = $_POST['phieuxuat_id'];
    $update_qt= $px->update_qt($quantity, $productid, $phieuxuat_id);
   }

   if(isset($_GET['px'])){ //get biến px
    $phieuxuat_id = $_GET['px'];
   }


?>

<div class="col-sm-4 text-left mt-3 mgc"> 
<h3 class="tl_ct">Xuất sản phẩm</h3>
<?php
       if(isset($add_chitietpx)){ // thông báo
        echo $add_chitietpx;
       }
 ?>
  <form class="m-3" method="post" action="">
    <?php 
         $get_pxid = $px->get_px_by_id($phieuxuat_id); // get phiếu xuất bởi id truyền vào
         if($get_pxid){
          while($row = $get_pxid->fetch_assoc()){ ?>
  
  <div class="form-group row ">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Mã phiếu xuất:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm"
             name="phieuxuat_id" value="<?php echo $row['phieuxuat_id'] ?>" readonly > 
      </div>
  </div>
 
  
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Ngày lập:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm"
             name="date_export" value="<?php echo $row['date_export'] ?>" readonly> 
      </div>
  </div> 
  <?php
          }
         }
      
    ?>

  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tên sản phẩm:</label>
      <div class="col-sm-7 ">
          <select class="form-control form-control-sm form-select" aria-label="Default select example" name="productid">
            <option selected>---Chọn sản phẩm---</option>
          <?php 
                $get_product = $product->get_name_product();
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
   <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit_phieuxuat" value="Lưu">

</form>



</div>

<div class="col-sm-6 text-left mt-3 mgc">
  <h3 class="tl_ct">Phiếu xuất</h3>
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
          $show_chitietpx = $px->show_chitietpx($phieuxuat_id); //show chi tiết px
          if($show_chitietpx){
           
            while($row_ctpx = $show_chitietpx->fetch_assoc()){ ?>
   
        <td><?php echo $row_ctpx['ctpx_id'] ?></td>
        <td><?php echo $row_ctpx['productName'] ?></td>
        <form action="" method="post">
        <td><input type="number" name="quantity" value="<?php echo $row_ctpx['quantity'] ?>">
          <input type="hidden" name="productid" value="<?php echo $row_ctpx['productid'] ?>">
          <input type="hidden" name="phieuxuat_id" value="<?php echo $row_ctpx['phieuxuat_id'] ?>">
         
          <input type="submit" name="submit_upqt" value="update">
        </td>
        </form>
        <td><?php echo $row_ctpx['note'] ?></td>
       
      </tr>
       <?php
  
            }
          }
       
     ?>
    </tbody>
  </table>
   <a href="phieuxuatlist.php" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit">Lưu phiếu</a>
   <?php 
        if(isset($update_qt)){ // thông báo mess
          echo $update_qt;
        }
   ?>

 </div>
 





</div>
     
</div>
   
<?php include "inc/footer.php"; ?>