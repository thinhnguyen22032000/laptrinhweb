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

  

    public function show_phieuxuat(){
       $qr = "SELECT * FROM tbl_phieuxuat ORDER BY phieuxuat_id DESC";
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
          $alert = "<span class='red'>Vui lòng điền đủ thông tin</span>";
          return $alert;

     }else{
          $get_qt_curren = "SELECT quantity FROM tbl_product WHERE productid = '$productid'";
          $qt_cur = $this->db->select($get_qt_curren);
          if($qt_cur){
             $result = $qt_cur->fetch_assoc();
             $rows = $result['quantity'];
          }
          $quantity_product = $rows - $quantity;
          if($quantity_product < 0){
             $alert = "<span class='red'>Số lượng trong kho không đủ(Hiện có: ".$rows."). Vui lòng nhập thêm hàng</span>";
            return $alert;
          }
          else{
            $qr = "SELECT  * FROM tbl_chitietpx WHERE phieuxuat_id = '$phieuxuat_id' AND productid = '$productid' AND date_export = '$date_export'";
            $result = $this->db->select($qr);
            if($result){
                $alert = "<span class='green'>Sản phẩm đã tồn tại trong phiếu xuất</span>";
               return $alert;
            }else{
              $up_quantity = "UPDATE tbl_product SET quantity = '$quantity_product' WHERE productid = '$productid'";
              $kq = $this->db->update($up_quantity);

              $qr = "INSERT INTO tbl_chitietpx(phieuxuat_id,date_export,productid,quantity,note)
                   VALUES ('$phieuxuat_id','$date_export','$productid','$quantity','$note')";

              $result = $this->db->insert($qr);

              if($result){
                    $alert = "<span class='green'>Thêm thành công</span>";
               return $alert;
              }
              else{
                $alert = "<span class='red'>Thêm thất bại</span>";
                return $alert;
            } 
            }
            
          }
         
          
     }

    }

    public function update_qt($quantity, $productid, $phieuxuat_id){
       if( $quantity == ''){
          $alert = "<span class='red'>Vui lòng điền đủ thông tin</span>";
          return $alert;

       }else{
          
          // get quantity hiien tại trong tbl_chitietpx
           $qr = "SELECT  * FROM tbl_chitietpx WHERE phieuxuat_id = '$phieuxuat_id' AND productid = '$productid'";
           $result = $this->db->select($qr)->fetch_assoc();
           $quantity_curren = $result['quantity'];
           //quan ti thay doi
           $qt_thaydoi = $quantity - $quantity_curren; 

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

             if($result){
                    $alert = "<span class='green'>Cập nhật thành công</span>";
               return $alert;
              }
              else{
                $alert = "<span class='red'>Cập nhật thất bại</span>";
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