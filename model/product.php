<?php 
  $filepath = realpath(dirname(__FILE__));
  // require_once ($filepath.'/../lib/session.php');
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>



<?php 
  class product
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }

    // function category
    public function show_product(){
        $qr = "SELECT * FROM tbl_product";
        $result= $this->db->select($qr); 
        return $result;
    }
     public function get_name_product(){
        $qr = "SELECT productName, productid FROM tbl_product";
        $result= $this->db->select($qr); 
        return $result;
    }

    public function add_product($data){
      $productName = $data['productName'];
      $catid = $data['catid'];
      $supplierid = $data['supplierid'];
      $unit = $data['unit'];
      $price = $data['price'];
      $des_c = $data['des_c'];
      $discount = $data['discount'];

      if($productName == '' || $catid == '' || $supplierid == '' || $unit == '' || $price == '' || $des_c == '' || $discount =='' ){
      $alert = "<span class='red'>Vui lòng điền đủ thông tin</span>";
      return $alert;

     }else{

      $qr = "INSERT INTO tbl_product(productName,catid,supplierid,unit,price,des_c,discount)
             VALUES ('$productName','$catid','$supplierid','$unit','$price','$des_c', '$discount')";

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

    public function get_product_by_id($productid){
        $qr = "SELECT * FROM tbl_product WHERE productid = '$productid'";
        $result= $this->db->select($qr); 
        return $result;
    }

     public function product_edit($proid, $data){
      $productName = $data['productName'];
      $catid = $data['catid'];
      $supplierid = $data['supplierid'];
      $unit = $data['unit'];
      $price = $data['price'];
      $des_c = $data['des_c'];
      $discount = $data['discount'];

      if($productName == '' || $catid == '' || $supplierid == '' || $unit == '' || $price == '' || $des_c == '' || $discount =='' ){
      $alert = "<span class='red'>Vui lòng điền đủ thông tin</span>";
      return $alert;

     }else{

      $qr = "UPDATE tbl_product SET
            productName = '$productName',
            catid = '$catid',
            supplierid = '$supplierid',
            unit = '$unit',
            price = '$price',
            des_c = '$des_c',
            discount = '$discount'
            WHERE productid = '$proid'
      ";

      $result = $this->db->update($qr);
      if($result){
              $alert = "<span class='green'>update thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='red'>update thất bại</span>";
        return $alert;
      } 
     }

    }


      public function product_del($proid){
        $qr = "DELETE FROM tbl_product WHERE productid = '$proid'";
        $result= $this->db->delete($qr); 
         if($result){
          $alert = '<span class="">delete successfull!!</span>'; 
          return $alert;
        }else{
          $alert = '<span class="">delete false!!</span>'; 
          return $alert;
        }
    }
    
  

    







}

?>