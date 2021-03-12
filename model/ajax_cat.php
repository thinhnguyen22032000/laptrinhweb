<?php 
  $filepath = realpath(dirname(__FILE__));
  // require_once ($filepath.'/../lib/session.php');
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>


<?php
        $db = new Database();

       // load data
       $output = '';
       $qr_sl = "SELECT * FROM tbl_category";
       $sl = $db->select($qr_sl);
      
       	$output .= '
            <table class="table table-bordered mt-5">
			    <thead>
			      <tr>
			        <th>STT</th>
			        <th>Tên danh mục</th>
			        <th>Hành động</th>
			      </tr>
			    </thead>
			    <tbody>

       	';

        if($sl){
        	$i = 0;
         	while($rows = $sl->fetch_assoc()){
         		$i++;
         	$output .= '
              
		     <tr>
		        <td>'.$rows["catid"].'</td>
		        <td>'.$rows["catName"].'</td>
		        <td>
              <a href="catedit.php?catid='.$rows["catid"].'" type="button" class="btn btn-warning btn-sm" id='.$rows["catid"].'>Edit</a>
              <a onclick = "return confirm("Bạn có muốn xóa?")" href="?delid='.$rows["catid"].'" class="btn btn-danger ml-2 btn-sm">Del</a>
		        </td>
		     </tr>
          

       	';
         }
         }else{
         	$output .= '<tr>
                <td colspan="5">data empty!!</td>

         	</tr>';
         }

         $output .= '
             </tbody>
		  </table> 
         ';
         echo $output;

    ?>
    <?php 

          if(isset($_POST['catName'])){
          $catName = $_POST['catName'];

          $qr = "INSERT INTO tbl_category(catName) VALUES('$catName')";
          $result = $db->insert($qr);

       }
           
    ?>