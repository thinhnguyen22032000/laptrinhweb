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

<div class="col-sm-9 text-left"> 

   <div class="container">
  <h2>Danh sách nhà cung cấp</h2>
    <a href="supplieradd.php" type="button" class="btn btn-success mb-3">Thêm mới</a>
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



