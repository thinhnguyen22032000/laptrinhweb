<?php include "inc/header.php"; ?>

<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');
    include 'model/phieuxuat.php';
    $px = new phieuxuat();

      if(!isset($_GET['delid']) || $_GET['delid'] == null){
       
      }else{
        $delid = $_GET['delid'];
        
        $del_su = $cat->del_su($delid);

      }
      if(isset($_POST['submit_phieuxuat'])){
       $date = date("Y-m-d H:i:s");
        $adminid =  session::get('adminid');
        $add_px = $px->add_phieuxuat($adminid,$date);
      }

?>

<div class="col-sm-9 text-left"> 

   <div class="container">
  <h2>Danh sách phiếu xuất</h2>
  <form method="post" action="">
    <input type="submit" class="btn btn-success mb-3" name="submit_phieuxuat" value="Thêm phiếu xuất">
   
    </form>
  <?php 
       if(isset($del_su)){
        echo $del_su;
       }
  ?>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã xuất </th>
        <th>Mã nhân viên</th>
        <th>Ngày lập</th>
      </tr>
    </thead>
    <tbody>
     <?php 

         $get_px = $px->show_phieuxuat();
          if($get_px){
          
            while($result = $get_px->fetch_assoc())
           
          {?> 
    
      <tr>
        <td><?php echo $result['phieuxuat_id'] ?></td>
        <td><?php echo $result['adminid'] ?></td>
        <td><?php echo $result['date_export'] ?></td>
        <td>
          
          <a href="phieuxuatviewctpx.php?ctpx=<?php echo $result['phieuxuat_id'] ?>" type="button" class="btn btn-warning btn-sm">view</a>
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