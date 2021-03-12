<?php include "inc/header.php"; ?>
<?php include "model/product.php";
    
     $product = new product();
 ?>
<?php 
        if(isset($_GET['delid'])){
          $proid = $_GET['delid'];
          $product_del = $product->product_del($proid);
        }
  
?>
<div class="col-sm-9 text-left h-auto"> 
	
   <div class="container">
  <h2>Danh sách sản phẩm</h2>
    <a href="productadd.php" type="button" class="btn btn-success mb-3">Thêm mới</a>
    <span>
    <?php 
           if(isset($product_del)){
            echo $product_del;
           }
     ?>
  </span>
  <?php 
       
  ?>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Mã danh mục</th>
        <th>Mã nhà cung cấp</th>
        <th>Đơn vị</th>
        <th>Số lượng/ĐV</th>
        <th>Giá</th>
        <th>khuyến mãi</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
     <?php 

         $get_product = $product->show_product();
          if($get_product){
           $i=1;
            while($result = $get_product->fetch_assoc())
           
          {?> 
    
      <tr>
        <td><?php echo $result['productid'] ?></td>
        <td><?php echo $result['productName'] ?></td>
        <td><?php echo $result['catid'] ?></td>
        <td><?php echo $result['supplierid'] ?></td>
        <td><?php 
                  if($result['unit'] == 1){
                    echo 'kg';
                  }else{
                    echo 'chai';
                  }
            ?>      
        </td>
        <td><?php echo $result['quantity'] ?></td>
        <td><?php echo $result['price'] ?></td>
        <td><?php echo $result['discount'].'%' ?></td>
        <td>
          
          <a href="productedit.php?proid=<?php echo $result['productid'] ?>" type="button" class="btn btn-warning btn-sm">Edit</a>
          <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['productid'] ?>" class="btn btn-danger ml-2 btn-sm">Del</a>

        </td>
      </tr>
      <?php 
      $i++;
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