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


    
    if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<script>window.location = 'productlist.php'</script>";
    } else {
        $proid = $_GET['proid']; 
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
  
    $product_edit = $product->product_edit($proid, $_POST);
  
   }
           



?>

<div class="col-sm-10 text-left "> 
<h3>Cập nhật sản phẩm</h3>
<?php
       if(isset($product_edit)){
        echo $product_edit;
       }
 ?>
  <form class="m-5" method="post" action="">
  <?php 
         $get_product_by_id = $product->get_product_by_id($proid);
         if($get_product_by_id){
          while($result = $get_product_by_id->fetch_assoc()){ ?>
 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tên sản phẩm:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="productName" placeholder="Tên sản phẩm..." value="<?php echo $result['productName'] ?>"> 
      </div>
  </div>
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Danh mục:</label>
      <div class="col-sm-4 ">
          <select class="form-control form-control-sm" aria-label="Default select example" name="catid">
            <option selected>---Danh mục sản phẩm---</option>
                <?php 
                       
                        $catlist = $cat->show_category();
                        if($catlist){
                            while($result_cat = $catlist->fetch_assoc()) { ?>
                             
                             <option 
                                   <?php 
                                         if($result_cat['catid'] == $result['catid']){
                                          echo 'selected';
                                         }
                              
                                   ?>
                                   value="<?php echo $result_cat['catid'] ?>"><?php echo $result_cat['catName'] ?></option>

                                  
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
                      
                        $supplierlist = $cat->show_supplier();
                        if($supplierlist){
                            while($result_sup = $supplierlist->fetch_assoc()) { ?>
                             
                             <option
                              <?php 
                                    if($result_sup['supplierid'] == $result['supplierid']){
                                      echo 'selected';
                                    }
                              ?>
                              
                              value="<?php echo $result_sup['supplierid'] ?>"><?php echo $result_sup['supplierName'] ?></option>
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
            <?php 
                
                  if($result['unit'] == '1'){    ?>
                  <option selected value="1">kg</option>
                  <option value="2">chai</option>
                  <?php 
                   }else{
                  ?>
                  <option value="1">kg</option>
                  <option selected value="2">chai</option>  
                  <?php 
              }
                            

            ?>
            
          </select>
        </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Giá:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="price" placeholder="Giá sản phẩm..." value="<?php echo $result['price'] ?>"> 
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Giảm giá:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="%..." name="discount" value="<?php echo $result['discount'] ?>"> 
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mô tả:</label>
      <div class="col-sm-4">
           <textarea id="desc" name="des_c"><?php echo $result['des_c'] ?></textarea>
      </div>
  </div>  
   <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit" value="Lưu">
 <?php
          }
         }
    
  ?>


</form>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>