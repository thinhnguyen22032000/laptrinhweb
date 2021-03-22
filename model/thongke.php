<?php 
  $filepath = realpath(dirname(__FILE__));
  // require_once ($filepath.'/../lib/session.php');
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>



<?php 
  class thongke
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }

    // function category
    public function thongke_product(){
        $qr = "SELECT count(productid) as qt FROM tbl_product";
        $result= $this->db->select($qr)->fetch_assoc();
        $qt = $result['qt'];
        return $qt;
    }

     public function thongke_category(){
        $qr = "SELECT count(catid) as qt FROM tbl_category";
        $result= $this->db->select($qr)->fetch_assoc();
        $qt = $result['qt'];
        return $qt;
    }

     public function thongke_supplier(){
        $qr = "SELECT count(supplierid) as qt FROM tbl_supplier";
        $result= $this->db->select($qr)->fetch_assoc();
        $qt = $result['qt'];
        return $qt;
    }

     public function thongke_phieunhap(){
        $qr = "SELECT count(phieunhap_id) as qt FROM tbl_phieunhap";
        $result= $this->db->select($qr)->fetch_assoc();
        $qt = $result['qt'];
        return $qt;
    }

     public function thongke_pricepn(){
        $qr = "SELECT sum(price * quantity) as qt FROM tbl_chitietpn";
        $result= $this->db->select($qr)->fetch_assoc();
        $qt = $result['qt'];
        return $qt;
    }
     public function thongke_phieuxuat(){
        $qr = "SELECT count(phieuxuat_id) as qt FROM tbl_phieuxuat";
        $result= $this->db->select($qr)->fetch_assoc();
        $qt = $result['qt'];
        return $qt;
    }

     public function thongke_hoadon(){
        $qr = "SELECT count(hoadon_id) as qt FROM tbl_hoadon";
        $result= $this->db->select($qr)->fetch_assoc();
        $qt = $result['qt'];
        return $qt;
    }

     public function thongke_doanhthu(){
       $qr = "SELECT sum(tbl_cthd.quantity * tbl_product.price) - sum(tbl_cthd.quantity * tbl_product.price)*(discount/100)
        as dt FROM tbl_cthd inner join tbl_product on tbl_cthd.productid = tbl_product.productid ";
      $result= $this->db->select($qr)->fetch_assoc();
        $dt = $result['dt'];
        return $dt;
    }

    
  

    







}

?>