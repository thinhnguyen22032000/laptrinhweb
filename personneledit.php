<?php include "inc/header.php"; ?>
<style type="text/css">
  .content{
    height: auto !important;
  }
</style>
<?php 
       
   include "model/personnel.php";

   $per = new personnel();
   

    if (!isset($_GET['perid']) || $_GET['perid'] == NULL) { // neu ko ton tai perid reset page
        echo "<script>window.location = 'personnellist.php'</script>";
    } else {
        $perid = $_GET['perid']; 
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){ //edit nhan vien
   
    $edit_per = $per->edit_personnel($perid, $_POST);
  
   }


?>

<div class="col-sm-9 text-left mgc f-ct"> 
<h3 class="tl_ct m-3">Cập nhật nhân viên</h3>
<?php
       if(isset($edit_per)){ // xuat thong bao
        echo $edit_per;
       }
 ?>
  <form class="m-5 f-ct" method="post" action="">
    <?php
          $get_per_by_id = $per->get_per_by_id($perid);
          if($get_per_by_id){ 
             while($result = $get_per_by_id->fetch_assoc()){ ?>
     
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Họ tên:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="adminName" 
            placeholder="Họ tên..." value="<?php echo $result['adminName'] ?>"> 
      </div>
  </div>
 
  
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="adminEmail" 
            placeholder="Email..." value="<?php echo $result['adminEmail'] ?>"> 
           
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Phone:</label>
      <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" 
            placeholder="số điện thoại" name="phone" value="<?php echo $result['phone'] ?>"> 
           
      </div>
  </div> 
  <div class="form-group row">
      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Chức vụ:</label>
      <div class="col-sm-4 ">
          <select class="form-control form-control-sm" aria-label="Default select example" name="level">
            <option selected>---Chức vụ---</option>
            <?php 
                 if($result['level'] == 0){ ?>

                <option value="0" selected>admin hệ thống</option>
                <option value="1">Thủ kho</option>
                <option value="2">Nhân viên bán hàng</option>       
            <?php
                }elseif($result['level'] == 1){ ?>
                <option value="0">admin hệ thống</option>
                <option value="1" selected>Thủ kho</option>
                <option value="2">Nhân viên bán hàng</option> 

            <?php
                }else{ ?>
                <option value="0">admin hệ thống</option>
                <option value="1">Thủ kho</option>
                <option value="2" selected>Nhân viên bán hàng</option> 

            <?php
                }
            ?>
            
                 
          </select>
        </div>
  </div> 

     <?php 
              }
             }
       ?>
   <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit" value="Lưu">

</form>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>