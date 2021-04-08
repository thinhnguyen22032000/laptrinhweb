
<?php include "inc/header.php"; ?>
<script src="js/myjs.js"></script>
<?php 
    include 'model/category.php';
    $cat = new category();

      if(!isset($_GET['delid']) || $_GET['delid'] == null){
       
      }else{
        $catid = $_GET['delid'];
        
        $del_cat = $cat->del_cat($catid);

      }

?>

<div class="col-sm-9 text-left mgc f-ct"> 
	<!-- Button trigger modal -->
<h2 class="tl_ct">Danh sách danh mục</h2>
<button type="button" class="btn btn-success lr-btn" data-toggle="modal" data-target="#exampleModal">
  Thêm danh mục
</button>

<!-- Modal add --> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form >
        	 <label>Tên danh mục</label>
        	 <div id="message"></div>
        	 <input type="text" id="catName" class="form-control my-2" placeholder="Tên danh mục...">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_cat">Đóng</button>
        <button type="button" class="btn btn-primary" id="add-cat">Lưu</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal upadte cat --> 
<!-- jQuery library -->
<!-- jQuery library -->


<?php 
      if(isset($del_cat)){
        echo $del_cat;
      }
?>
<div id=data-cat></div>
  

</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>