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

  

    public function show_phieunhap(){
       $qr = "SELECT * FROM tbl_phieunhap ORDER BY phieunhap_id DESC";
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
      $alert = "<span class='red'>Vui lòng điền đủ thông tin</span>";
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
              $alert = "<span class='green'>Thêm thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='red'>Thêm thất bại</span>";
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