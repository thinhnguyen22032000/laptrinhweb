
<?php include "inc/header.php"; ?>
<?php 
       
   include "model/category.php";


   $cat = new category();
   // neu ko ton tai catid ->reset page
   if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php'</script>";
    } else {
        $catid = $_GET['catid']; 
    }
   // khi an nut them thuc hien thêm categoty
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    $catName = $_POST['catName'];
    $catid = $_GET['catid'];  
    $catedit = $cat->edit_cat($catid, $catName);
  
   }
?>

<div class="col-sm-9 text-left mgc f-ct" style="margin-bottom: 200px;"> 
<h3 class="tl_ct">Cập nhật danh mục</h3>
<?php
       if(isset($catedit)){ // hien thị mess
        echo $catedit;
       }
 ?>
  <form class="m-5 f-ct" method="post" action="">
  <div class="form-group row">

      <label for="colFormLabelSm" style="font-size: 17px;" class="col-sm-2 col-form-label col-form-label-sm">Danh mục:</label>
      <div class="col-sm-6">

      <?php 
           $get_cat_by_id = $cat->get_cat_by_id($catid); // get category theo id truyen vao
           if($get_cat_by_id){
            while($result = $get_cat_by_id->fetch_assoc()) { ?> 

      <input type="text" class="form-control form-control-sm" style="height: 40px;font-size: 18px;" id="colFormLabelSm" name="catName" value="<?php echo $result['catName'] ?>" placeholder="Tên danh mục...">

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