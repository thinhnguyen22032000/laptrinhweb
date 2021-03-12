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
      if(isset($_POST['submit_phieuxuat'])){
       $date = date("Y-m-d H:i:s");
        $adminid =  session::get('adminid');
        $add_pn = $pn->add_phieunhap($adminid,$date);
      }

?>

<div class="col-sm-9 text-left"> 

   <div class="container">
  <h2>Danh sách phiếu nhập</h2>
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

         $get_pn = $pn->show_phieunhap();
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
  
</div>



</div>
</div>
     
</div>
   
<?php include "inc/footer.php"; ?>
