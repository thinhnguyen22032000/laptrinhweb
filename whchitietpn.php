
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
       
   include "model/phieunhap.php";
    include "model/product.php";

   $pn = new phieunhap();
   $product = new product();
   // add sản phẩm vào phiếu nhập
   if(isset($_POST['submit'])){
    $add_chitietpn= $pn->add_chitietpn($_POST);
   }
   //get id pn
   if(isset($_GET['pn'])){
    $phieunhap_id = $_GET['pn'];
   }
   // update quantity ctpn
    if(isset($_POST['submit_upqt'])){
    $quantity = $_POST['quantity'];
    $productid = $_POST['productid'];
    $phieunhap_id = $_POST['phieunhap_id'];
    $update_qt= $pn->update_qt($quantity, $productid, $phieunhap_id);
   }


?>

<div class="col-sm-4 text-left  mgc"> 
<h3 class="tl_ct mt-4">Nhập sản phẩm</h3>
<?php
       if(isset($add_chitietpn)){ // xuát thong báo
        echo $add_chitietpn;
       }
 ?>
  <form class="m-3" method="post" action="">
    <?php 
         $get_pnid = $pn->get_pn_by_id($phieunhap_id);
         if($get_pnid){
          while($row = $get_pnid->fetch_assoc()){ ?>
  
  <div class="form-group row ">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Mã phiếu nhập:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm"
             name="phieunhap_id" value="<?php echo $row['phieunhap_id'] ?>" readonly > 
      </div>
  </div>
 
  
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Ngày lập:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm"
             name="date_import" value="<?php echo $row['date_import'] ?>" readonly> 
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
                $get_product = $product->get_name_product(); // show tên sản phẩm
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
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Giá:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" 
            placeholder="Nhập giá" name="price" > 
      </div>
  </div>  
  <div class="form-group row ">
      <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Ghi chú:</label>
      <div class="col-sm-7">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" 
           name="note" > 
      </div>
  </div>  
   <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit" value="Lưu">

</form>



</div>

<div class="col-sm-6 text-left mgc">
   <h3 class="tl_ct mt-4">Phiếu nhập</h3>
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
          $show_chitietpn = $pn->show_chitietpn($phieunhap_id); // show sp theo mã phiếu nhập
          if($show_chitietpn){
            $tongtien = 0;
            while($row_ctpn = $show_chitietpn->fetch_assoc()){ ?>
   
        <td><?php echo $row_ctpn['chitietpn_id'] ?></td>
        <td><?php echo $row_ctpn['productName'] ?></td>
        <td>
          <form action="" method="post">
          <input type="number" min="1" style="width: 100px;" name="quantity" value="<?php echo $row_ctpn['quantity'] ?>">
          <input type="hidden" name="productid" value="<?php echo $row_ctpn['productid'] ?>">
          <input type="hidden" name="phieunhap_id" value="<?php echo $row_ctpn['phieunhap_id'] ?>">
         
          <input type="submit" class="btn btn-danger upqt" name="submit_upqt" value="update">
          </form>
        </td>
        <td><?php echo $row_ctpn['price'] ?></td>
        <td><?php echo $thanhtien = $row_ctpn['quantity'] * $row_ctpn['price'] ?></td>
        <td><?php echo $row_ctpn['note'] ?></td>
       
      </tr>
       <?php
            $tongtien += $thanhtien;
            }
          }
       
     ?>
    </tbody>
  </table>
  <p>Tổng cộng: <?php echo isset($tongtien)?$tongtien .'VNĐ':'0 VNĐ' ?></p>
   <a href="whimport.php" class="btn btn-primary mt-3 pl-2 pl-3 pr-3 mb-5" name="submit">Lưu phiếu</a>
   <?php 
         if(isset($update_qt)){ // thong báo cập nhật quantity
          echo $update_qt;
         }
   ?>
 </div>
 





</div>
     
</div>
   
<?php include "inc/footer.php"; ?>