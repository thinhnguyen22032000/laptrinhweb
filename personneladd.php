<?php include "inc/header.php"; ?>
<style type="text/css">
  .content{
    height: auto !important;
  }
</style>
<?php 
       
   include "model/personnel.php";

   $per = new personnel();


   if(isset($_POST['submit'])){ // add nhân viên
    $add_per= $per->add_personnel($_POST);
   }


?>

<div class="col-sm-9 text-left mgc f-ct"> 
<h3 class="tl_ct m-3">Thêm nhân viên</h3>
<?php
       if(isset($add_per)){ // xuat thong bao
        echo $add_per;
       }
 ?>
  <form class="m-5 f-ct" method="post" action="">
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Họ tên:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="adminName" placeholder="Họ tên..."> 
      </div>
  </div>
 
  
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="adminEmail" placeholder="Email..."> 
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Phone:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="số điện thoại" name="phone" value=""> 
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Chức vụ:</label>
      <div class="col-sm-4 ">
          <select class="form-control form-control-sm" aria-label="Default select example" name="level">
            <option selected>---Chức vụ---</option>
            <option value="0">admin hệ thống</option>
            <option value="1">Thủ kho</option>
            <option value="2">Nhân viên bán hàng</option>            
          </select>
        </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mật khẩu:</label>
      <div class="col-sm-4">
            <input type="password" class="form-control form-control-sm" id="colFormLabelSm" placeholder="mật khẩu" name="adminPass" value=""> 
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nhập lại mật khẩu:</label>
      <div class="col-sm-4">
            <input type="password" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Nhập lại mật khẩu" name="passAgain" value=""> 
      </div>
  </div>  
   <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit" value="Lưu">

</form>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>