<?php include "inc/header.php"; ?>

<?php 
    include 'model/category.php';
    $cat = new category();

      if(!isset($_GET['delid']) || $_GET['delid'] == null){
       
      }else{
        $delid = $_GET['delid'];
        
        $del_su = $cat->del_su($delid);

      }

?>

<div class="col-sm-9 text-left mgc f-ct"> 

  <?php 
       
   $cat = new category();
   if(isset($_POST['submit'])){
    $supplierName = $_POST['supplierName'];
    $suadd = $cat->add_su($supplierName);
   }

?>

<div class=""> 
<h3 class="tl_ct">Quản lí nhà cung cấp</h3>
<?php
       if(isset($suadd)){
        echo $suadd;
       }
 ?>
  <form class="m-5 f-ct" method="post" action="">
  <div class="form-group row " style="margin-left: 20%;">

      <label for="colFormLabelSm" style="font-size: 16px;" class="col-sm-2 col-form-label col-form-label-sm">Nhà cung cấp:</label>
      <div class="col-sm-6">
    
      <input type="text" class="form-control form-control-sm" style="height: 40px;" id="colFormLabelSm" name="supplierName" placeholder="...">

      <input type="submit" class="btn btn-primary mt-3 pl-2 pl-3 pr-3" name="submit" value="Lưu">
    </div>
  </div> 
</form>



</div>





   <div class="container">
<!--   <h2 class="tl_ct">Danh sách nhà cung cấp</h2> -->
 
  <?php 
       if(isset($del_su)){
        echo $del_su;
       }
  ?>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>STT</th>
        <th>Nhà cung cấp</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
     <?php 

         $get_supplier = $cat->show_supplier();
          if($get_supplier){
          
            while($result = $get_supplier->fetch_assoc())
           
          {?> 
    
      <tr>
        <td><?php echo $result['supplierid'] ?></td>
        <td><?php echo $result['supplierName'] ?></td>
        <td>
          
          <a href="supplieredit.php?suid=<?php echo $result['supplierid'] ?>" type="button" class="btn btn-warning btn-sm">Edit</a>
          <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['supplierid'] ?>" class="btn btn-danger ml-2 btn-sm">Del</a>

        </td>
      </tr>
      <?php 
     
    }
    }
     ?>
    </tbody>
  </table>      
  
</div>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>



