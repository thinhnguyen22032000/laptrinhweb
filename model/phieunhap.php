<?php 
  $filepath = realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/session.php');
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>
<?php 
  class phieunhap
  {
  	private $db;
    private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
      $this->fm = new Format();  		
    }

  

    public function phantrang_phieunhap(){
        $sp1trang = 5;
        if(isset($_GET['page'])){
          $trang = $_GET['page'];
        }else{
          $trang = 1;
        }
        $vitri = ($trang - 1)*$sp1trang;
       
       $qr = "SELECT * FROM tbl_phieunhap ORDER BY phieunhap_id DESC LIMIT $vitri, $sp1trang ";
       $result = $this->db->select($qr);
       return $result;
    }

     public function row_pn(){
       $qr = "SELECT * FROM tbl_phieunhap";
       $result = $this->db->select($qr);
       return $result;
    }


     public function add_phieunhap($adminid, $date){
       $qr = "INSERT INTO tbl_phieunhap(adminid) VALUES('$adminid')";
       $result = $this->db->insert($qr);
       if($result){
        $qr = "SELECT * from tbl_phieunhap WHERE date_import = '$date'";
        $row = $this->db->select($qr)->fetch_assoc();
        $phieunhap_id = $row['phieunhap_id'];
        header("location: whchitietpn.php?pn=".$phieunhap_id."");
       }
    }
    public function get_pn_by_id($id){
       $qr = "SELECT * FROM tbl_phieunhap WHERE phieunhap_id = '$id'";
       $result = $this->db->select($qr);
       return $result;
    }


    public function add_chitietpn($data){
      $phieunhap_id = $data['phieunhap_id'];
      $date_import = $data['date_import'];
      $productid = $data['productid'];
      $quantity = $data['quantity'];
      $price = $data['price'];
      $note = $data['note'];

      if($phieunhap_id == '' || $date_import == '' || $productid == '' || $quantity == '' || $price == ''){
      $alert = "<p class='err'>Vui lòng điền đủ thông tin</p>";
      return $alert;

     }else{
          $qr = "SELECT  * FROM tbl_chitietpn WHERE phieunhap_id = '$phieunhap_id' AND productid = '$productid'";
          $result = $this->db->select($qr);
          if($result){
              $alert = "<p class='err'>Sản phẩm đã tồn tại trong phiếu nhập</p>";
              return $alert;
            }else{
                $get_qt_curren = "SELECT quantity FROM tbl_product WHERE productid = '$productid'";
               
                $qt_cur = $this->db->select($get_qt_curren)->fetch_assoc();
                $row = $qt_cur['quantity'];
                $quantity_product = $row + $quantity;
                $up_quantity = "UPDATE tbl_product SET quantity = '$quantity_product' WHERE productid = '$productid'";
                $kq = $this->db->update($up_quantity);

                $qr = "INSERT INTO tbl_chitietpn(phieunhap_id,date_import,productid,quantity,price,note)
                       VALUES ('$phieunhap_id','$date_import','$productid','$quantity','$price', '$note')";

                $result = $this->db->insert($qr);
                if($result){
                        $alert = "<span class='succes'>Thêm thành công</span>";
                   return $alert;
                }
                else{
                  $alert = "<span class='err'>Thêm thất bại</span>";
                  return $alert;
                } 
          }
         
     }

    }


     public function update_qt($quantity, $productid, $phieunhap_id){
       if($quantity == ''){
          $alert = "<span class='err'>Vui lòng điền đủ thông tin</span>";
          return $alert;

       }else{
          
          // get quantity hiien tại trong tbl_chitietpn
           $qr = "SELECT  * FROM tbl_chitietpn WHERE phieunhap_id = '$phieunhap_id' AND productid = '$productid'";
           $result = $this->db->select($qr)->fetch_assoc();
           $quantity_curren = $result['quantity'];
           //quan ti thay doi
           $qt_thaydoi = $quantity - $quantity_curren;  //qt thay đổi = qt_post - qt hiện tại

           //get quanti trong kho
          $get_qt_curren = "SELECT quantity FROM tbl_product WHERE productid = '$productid'";
          $qt_cur = $this->db->select($get_qt_curren);
          if($qt_cur){
             $result = $qt_cur->fetch_assoc();
             $rows = $result['quantity'];
          }

          $quantity_product = $rows + $qt_thaydoi; // quantity kho update = qt kho hiện tại + qt thay đổi
          
          $up_quantity = "UPDATE tbl_product SET quantity = '$quantity_product' WHERE productid = '$productid'";
          $kq = $this->db->update($up_quantity);
          
          $quantity_up = $qt_thaydoi + $quantity_curren;
          $up_quantity = "UPDATE tbl_chitietpn SET quantity = '$quantity_up' WHERE productid = '$productid'";
          $kq = $this->db->update($up_quantity);

           if($result){
                  $alert = "<p class='succes'>Cập nhật thành công</p>";
             return $alert;
            }
            else{
              $alert = "<p class='err'>Cập nhật thất bại</p>";
              return $alert;
          } 
              
          
       }



    }

    public function show_chitietpn($phieunhap_id){
       $qr = "SELECT tbl_chitietpn.*,productName FROM tbl_chitietpn inner join tbl_product on tbl_chitietpn.productid = tbl_product.productid 
       WHERE phieunhap_id = '$phieunhap_id'";
       $result = $this->db->select($qr);
       return $result;
    }


    






}

?>