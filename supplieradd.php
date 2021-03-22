<?php include "inc/header.php"; ?>
<?php 
       
   include "model/category.php";
   $cat = new category();
   if(isset($_POST['submit'])){
    $supplierName = $_POST['supplierName'];
    $suadd = $cat->add_su($supplierName);
   }

?>

<div class="col-sm-9 text-left mgc"> 
<h3 class="tl_ct">Thêm nhà cung cấp</h3>
<?php
       if(isset($suadd)){
        echo $suadd;
       }
 ?>
  <form class="m-5" method="post" action="">
  <div class="form-group row">

      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nhà cung cấp:</label>
      <div class="col-sm-4">
    
      <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="supplierName" placeholder="Tên danh mục...">

      <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit" value="Lưu">
    </div>
  </div> 
</form>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>