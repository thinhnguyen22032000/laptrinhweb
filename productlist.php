<?php include "inc/header.php"; ?>
<?php include "model/product.php";
    
     $product = new product();
 ?>
<?php 
        if(isset($_GET['delid'])){ // nếu tồng tại biến delid ->xóa
          $proid = $_GET['delid'];
          $product_del = $product->product_del($proid);
        }
  
?>





<!-- danh sách san pham -->
<div class="col-sm-9 text-left mgc f-ct"> 

   <!-- tìm kiếm san phẩm -->
    <div class="input-group col-sm-5 mb-4">
      <form action="search.php" method="post">
           <div class="input-group">
            <input type="search" class="form-control rounded" name="key" placeholder="Search" aria-label="Search"
              aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary" name="search">search</button>
          </div>
      </form>
    </div>
	
  <div class="container">
  <h2 class="tl_ct">Danh sách sản phẩm</h2>
    <a href="productadd.php" type="button" class="btn btn-success mb-3 lr-btn">Thêm mới</a>
    <span>
    <?php 
           if(isset($product_del)){ //thông báo xóa
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

         $get_product = $product->phantrang_product(); // hiển thị ds sản phẩm
          if($get_product){
           $i=1;
            while($result = $get_product->fetch_assoc())
           
          {?> 
    
      <tr>
        <td><?php echo $result['productid'] ?></td>
        <td><?php echo $result['productName'] ?></td>
        <td><?php echo $result['catid']==0?'Null':$result['catid'] ?></td>
        <td><?php echo $result['supplierid']==0?'Null':$result['supplierid'] ?></td>
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
 <!--  phan trang php -->
 <div class="phantrang"> 
   <?php 
        $sanpham1trang = 5;
        $row = $product->row_product();
        $num_row = mysqli_num_rows($row);
        $sotrang = ceil($num_row/$sanpham1trang);
        $i = 1;
        echo "Trang" ." ";

       
        for($i=1; $i<=$sotrang;$i++){
          echo "
         
          <a class='phantrang' href='?page=".$i."'>".$i."</a>
        


          ";
        }


   ?>
 </div>
</div>


  

</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>