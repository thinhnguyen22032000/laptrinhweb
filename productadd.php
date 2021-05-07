<?php include "inc/header.php"; ?>
<style type="text/css">
  .content{
    height: auto !important;
  }
</style>
<?php 
       
   include "model/product.php";
   include "model/category.php";

   $product = new product();
   $cat = new category();


   if(isset($_POST['submit'])){ // thêm sản phẩm
    $add_product = $product->add_product($_POST);
   }


?>

<div class="col-sm-9 text-left mgc"> 
<h3 class="tl_ct m-3">Thêm sản phẩm</h3>
<?php
       if(isset($add_product)){ // xuất thông báo khi thêm thành công
        echo $add_product;
       }
 ?>
  <form class="m-5 f-ct" method="post" action="">
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tên sản phẩm:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="productName" placeholder="Tên sản phẩm..."> 
      </div>
  </div>
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Danh mục:</label>
      <div class="col-sm-4 ">
          <select class="form-control form-control-sm" aria-label="Default select example" name="catid">
            <option selected>---Danh mục sản phẩm---</option>
                <?php 
                       
                        $catlist = $cat->show_category(); // danh sách danh mục
                        if($catlist){
                            while($result_cat = $catlist->fetch_assoc()) { ?>
                             
                             <option value="<?php echo $result_cat['catid'] ?>"><?php echo $result_cat['catName'] ?></option>
                             <?php
                            }
                        }
                        
                    ?>
            
          </select>
        </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nhà cung cấp:</label>
      <div class="col-sm-4 ">
          <select class="form-control form-control-sm" aria-label="Default select example" name="supplierid">
            <option selected>---Nhà cung cấp---</option>
              <?php 
                      
                        $supplierlist = $cat->show_supplier(); //danh sách nhà cung cấp
                        if($supplierlist){
                            while($result = $supplierlist->fetch_assoc()) { ?>
                             
                             <option value="<?php echo $result['supplierid'] ?>"><?php echo $result['supplierName'] ?></option>
                             <?php
                            }
                        }
                        
                    ?>
           
          </select>
        </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Đơn vị:</label>
      <div class="col-sm-4 ">
          <select class="form-control form-control-sm" aria-label="Default select example" name="unit">
            <option selected>---Đơn vị---</option>
            <option value="1">kg</option>
            <option value="2">chai</option>
            
          </select>
        </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Giá:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="price" placeholder="Giá sản phẩm..."> 
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Giảm giá:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="%..." name="discount" value="0"> 
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mô tả:</label>
      <div class="col-sm-4">
           <textarea id="desc" name="des_c"></textarea>
      </div>
  </div>  
   <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit" value="Lưu">

</form>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>