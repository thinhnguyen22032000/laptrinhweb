<?php include "inc/header.php"; ?>

<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');
    include 'model/phieunhap.php';
    $pn = new phieunhap();

      if(!isset($_GET['delid']) || $_GET['delid'] == null){
       
      }else{
        $delid = $_GET['delid'];
        
        $del_su = $cat->del_su($delid);

      }
      if(isset($_POST['submit_phieuxuat'])){ // add phieu nhập
       $date = date("Y-m-d H:i:s");
        $adminid =  session::get('adminid');
        $add_pn = $pn->add_phieunhap($adminid,$date);
      }

?>

<div class="col-sm-9 text-left mgc f-ct"> 

   <div class="container">
  <h2 class="tl_ct">Danh sách phiếu nhập</h2>
  <form method="post" action="">
    <input type="submit" class="btn btn-success mb-3" name="submit_phieuxuat" value="Thêm phiếu nhập">
   
    </form>
  <?php 
       if(isset($del_su)){
        echo $del_su;
       }
  ?>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã phiếu nhập</th>
        <th>Mã nhân viên</th>
        <th>Ngày lập</th>
      </tr>
    </thead>
    <tbody>
     <?php 

         $get_pn = $pn->phantrang_phieunhap(); // hiển thi ds phiếu nhập
          if($get_pn){
          
            while($result = $get_pn->fetch_assoc())
           
          {?> 
    
      <tr>
        <td><?php echo $result['phieunhap_id'] ?></td>
        <td><?php echo $result['adminid'] ?></td>
        <td><?php echo $result['date_import'] ?></td>
        <td>
          
          <a href="whviewctpn.php?ctpn=<?php echo $result['phieunhap_id'] ?>" type="button" class="btn btn-warning btn-sm">view</a>
          <!-- <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['supplierid'] ?>" class="btn btn-danger ml-2 btn-sm">Del</a> -->

        </td>
      </tr>
      <?php 
     
    }
    }
     ?>
    </tbody>
  </table>

  <!-- phan trang -->
  <div class="phantrang">
   <?php 
        $sanpham1trang = 5;
        $row = $pn->row_pn();
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
