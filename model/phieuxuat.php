<?php 
  $filepath = realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/session.php');
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>
<?php 
  class phieuxuat
  {
  	private $db;
    private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
      $this->fm = new Format();  		
    }

  

    public function phantrang_phieuxuat(){
       $sp1trang = 5;
        if(isset($_GET['page'])){
          $trang = $_GET['page'];
        }else{
          $trang = 1;
        }
        $vitri = ($trang - 1)*$sp1trang;
       
       
       $qr = "SELECT * FROM tbl_phieuxuat ORDER BY phieuxuat_id DESC LIMIT $vitri, $sp1trang";
       $result = $this->db->select($qr);
       return $result;
    }

     public function row_px(){
       $qr = "SELECT * FROM tbl_phieuxuat";
       $result = $this->db->select($qr);
       return $result;
    }

     public function add_phieuxuat($adminid, $date){
       $qr = "INSERT INTO tbl_phieuxuat(adminid) VALUES('$adminid')";
       $result = $this->db->insert($qr);
       if($result){
        $qr = "SELECT * from tbl_phieuxuat WHERE date_export = '$date'";
        $row = $this->db->select($qr)->fetch_assoc();
        $phieuxuat_id = $row['phieuxuat_id'];
        header("location: phieuxuatsp.php?px=".$phieuxuat_id."");
       }
    }
    public function get_px_by_id($id){
       $qr = "SELECT * FROM tbl_phieuxuat WHERE phieuxuat_id = '$id'";
       $result = $this->db->select($qr);
       return $result;
    }


    public function add_chitietpx($data){
      $phieuxuat_id = $data['phieuxuat_id'];
      $date_export = $data['date_export'];
      $productid = $data['productid'];
      $quantity = $data['quantity'];
      $note = $data['note'];

      if($phieuxuat_id == '' || $date_export == '' || $productid == '' || $quantity == ''){
          $alert = "<p class='err'>Vui lòng điền đủ thông tin</p>";
          return $alert;

     }else{
          $get_qt_curren = "SELECT quantity FROM tbl_product WHERE productid = '$productid'"; //get qt kho
          $qt_cur = $this->db->select($get_qt_curren);
          if($qt_cur){
             $result = $qt_cur->fetch_assoc();
             $rows = $result['quantity'];
          }
          $quantity_product = $rows - $quantity; // quanitty sau khi xuát hàng trong tbl_product
          if($quantity_product < 0){
             $alert = "<p class='err'>Số lượng trong kho không đủ(Hiện có: ".$rows."). Vui lòng nhập thêm hàng</p>";
            return $alert;
          }
          else{
            $qr = "SELECT  * FROM tbl_chitietpx WHERE phieuxuat_id = '$phieuxuat_id' AND productid = '$productid' AND date_export = '$date_export'";
            $result = $this->db->select($qr);
            if($result){
                $alert = "<p class='err'>Sản phẩm đã tồn tại trong phiếu xuất</p>";
               return $alert;
            }else{
              $up_quantity = "UPDATE tbl_product SET quantity = '$quantity_product' WHERE productid = '$productid'";
              $kq = $this->db->update($up_quantity);
              // add row vào chi tiet px
              $qr = "INSERT INTO tbl_chitietpx(phieuxuat_id,date_export,productid,quantity,note)
                   VALUES ('$phieuxuat_id','$date_export','$productid','$quantity','$note')";

              $result = $this->db->insert($qr);
              
              // add vào sp bán hàng(tbl_productsell)
              // get san phảm trong tbl_productsell
              $get_qt_curren = "SELECT * FROM tbl_productsell WHERE productid = '$productid'";
              $qt_cur = $this->db->select($get_qt_curren);
              if($qt_cur){
                 $row = $qt_cur->fetch_assoc();
                 $productsell_curren = $row['quantity'];

                $productsell_upqt = $productsell_curren + $quantity;


                $qr = "UPDATE tbl_productsell SET quantity = '$productsell_upqt' WHERE productid = '$productid'";

                $result_productsell = $this->db->update($qr);
              }else{
                $qr = "INSERT INTO tbl_productsell(productid,quantity)
                     VALUES ('$productid', '$quantity')";

                $result_productsell = $this->db->insert($qr);
              }
              

              if($result){
                    $alert = "<p class='succes'>Thêm thành công</p>";
               return $alert;
              }
              else{
                $alert = "<p class='err'>Thêm thất bại</p>";
                return $alert;
            } 
            }
            
          }
         
          
     }

    }

    public function update_qt($quantity, $productid, $phieuxuat_id){
       if( $quantity == ''){
          $alert = "<p class='err'>Vui lòng điền đủ thông tin!!<p>";
          return $alert;

       }else{
          
          // get quantity hiien tại trong tbl_chitietpx
           $qr = "SELECT  * FROM tbl_chitietpx WHERE phieuxuat_id = '$phieuxuat_id' AND productid = '$productid'";
           $result = $this->db->select($qr)->fetch_assoc();
           $quantity_curren = $result['quantity'];
           //quan ti thay doi
           $qt_thaydoi = $quantity - $quantity_curren; //qt post - qt ctpx

           //get quanti trong kho
          $get_qt_curren = "SELECT quantity FROM tbl_product WHERE productid = '$productid'";
          $qt_cur = $this->db->select($get_qt_curren);
          if($qt_cur){
             $result = $qt_cur->fetch_assoc();
             $rows = $result['quantity'];
          }

          $quantity_product = $rows - $qt_thaydoi;
          if($quantity_product < 0){
             $alert = "<span class='red'>Số lượng trong kho không đủ(Hiện có: ".$rows."). Vui lòng nhập thêm hàng</span>";
            return $alert;
          }else{
            $up_quantity = "UPDATE tbl_product SET quantity = '$quantity_product' WHERE productid = '$productid'";
            $kq = $this->db->update($up_quantity);
            
            $quantity_up = $qt_thaydoi + $quantity_curren;
            $up_quantity = "UPDATE tbl_chitietpx SET quantity = '$quantity_up' WHERE productid = '$productid'";
            $kq = $this->db->update($up_quantity);


            // update product sell

            // get san phảm trong tbl_productsell
              $get_qt_curren = "SELECT * FROM tbl_productsell WHERE productid = '$productid'";
              $qt_cur = $this->db->select($get_qt_curren);
        
               $row = $qt_cur->fetch_assoc();
               $productsell_curren = $row['quantity'];

               $productsell_upqt = $productsell_curren + $qt_thaydoi;



              $qr = "UPDATE tbl_productsell SET quantity = '$productsell_upqt' WHERE productid = '$productid'";

                $result_productsell = $this->db->update($qr);

             if($result){
                    $alert = "<p class='succes'>Cập nhật thành công!!<p>";
               return $alert;
              }
              else{
                $alert = "<p class='err'>Cập nhật thất bại!!<p>";
                return $alert;
            } 
              
          }
       }



    }

    public function show_chitietpx($phieuxuat_id){
       $qr = "SELECT tbl_chitietpx.*,productName FROM tbl_chitietpx inner join tbl_product on tbl_chitietpx.productid = tbl_product.productid 
       WHERE phieuxuat_id = '$phieuxuat_id'";
       $result = $this->db->select($qr);
       return $result;
    }


    






}

?>