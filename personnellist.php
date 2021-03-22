<?php include "inc/header.php"; ?>

<?php 
    include 'model/personnel.php';
    $per = new personnel();

      if(!isset($_GET['delid']) || $_GET['delid'] == null){
       
      }else{
        $delid = $_GET['delid'];
        
        $del_per = $per->del_personnel($delid);

      }

?>

<div class="col-sm-9 text-left mgc"> 

   <div class="container">
  <h2 class="tl_ct">Danh sách nhân sự</h2>
    <a href="personneladd.php" type="button" class="btn btn-success mb-3 lr-btn">Thêm mới</a>
  <?php 
       if(isset($del_per)){
        echo $del_per;
       }
  ?>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Mã nhân viên</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Chức vụ</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
     <?php 

         $get_personnel = $per->show_personnel();
          if($get_personnel){
          
            while($result = $get_personnel->fetch_assoc())
           
          {?> 
    
      <tr>
        <td><?php echo $result['adminid'] ?></td>
        <td><?php echo $result['adminName'] ?></td>
        <td><?php echo $result['adminEmail'] ?></td>
        <td><?php echo $result['phone'] ?></td>
        <td><?php
                  if($result['level'] == 0){
                    echo "admin";
                  }elseif($result['level'] == 1) {
                    echo "Thủ kho";
                  }
                  else{
                    echo "Nhân viên bán hàng";
                  }

                  
         ?></td>
        <td>
          
          <a href="personneledit.php?perid=<?php echo $result['adminid'] ?>" type="button" class="btn btn-warning btn-sm">Edit</a>
          <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['adminid'] ?>" class="btn btn-danger ml-2 btn-sm">Del</a>

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

