
<?php include "inc/header.php"; ?>
<?php 
       
   include "model/category.php";


   $cat = new category();

   if (!isset($_GET['suid']) || $_GET['suid'] == NULL) {
        echo "<script>window.location = 'supplierlist.php'</script>"; // f5
    } else {
        $suid = $_GET['suid']; 
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){ // edit ncc
    $supplierName = $_POST['supplierName'];
    $suid = $_GET['suid'];  
    $suedit = $cat->edit_su($suid, $supplierName);
  
   }
?>

<div class="col-sm-9 text-left mgc f-ct" style="margin-bottom: 200px"> 
<h3 class="tl_ct m-3">Cập nhật nhà cung cấp</h3>
<?php
       if(isset($suedit)){ // echo thông báo
        echo $suedit;
       }
 ?>
  <form class="m-5 f-ct" method="post" action="">
  <div class="form-group row">

      <label for="colFormLabelSm" style="font-size: 17px;font-size: 18px;" class="col-sm-2 col-form-label col-form-label-sm">Danh mục:</label>
      <div class="col-sm-6">

      <?php 
           $get_su_by_id = $cat->get_su_by_id($suid); //show ncc theo id
           if($get_su_by_id){
            while($result = $get_su_by_id->fetch_assoc()) { ?>

      <input type="text" style="height: 40px" class="form-control form-control-sm" id="colFormLabelSm" name="supplierName" value="<?php echo $result['supplierName'] ?>" placeholder="Tên danh mục...">

        <?php
            }
           } 
           
      ?>

      <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit" value="Lưu">
    </div>
  </div> 
</form>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>