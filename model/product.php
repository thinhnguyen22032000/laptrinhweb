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
     public function phantrang_product(){
        $sp1trang = 5;
        if(isset($_GET['page'])){
          $trang = $_GET['page'];
        }else{
          $trang = 1;
        }
        $vitri = ($trang - 1)*$sp1trang;
        $qr = "SELECT * FROM tbl_product LIMIT $vitri, $sp1trang";
        $result= $this->db->select($qr); 
        return $result;
    }

     public function search_product($key){
        $qr = "SELECT * FROM tbl_product WHERE productName LIKE '%$key%'";
        $result= $this->db->select($qr); 
        return $result;
    }

    public function row_product(){
        $qr = "SELECT productid FROM tbl_product";
        $result= $this->db->select($qr); 
        return $result;
    }
     public function get_name_product(){
        $qr = "SELECT productName, productid FROM tbl_product";
        $result= $this->db->select($qr); 
        return $result;
    }
     public function get_name_productsell(){
        $qr = "SELECT tbl_productsell.productid, tbl_product.productName FROM tbl_product 
        inner join tbl_productsell on tbl_product.productid = tbl_productsell.productid";
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
      $alert = "<p class='err'>Vui lòng điền đủ thông tin!!<p>";
      return $alert;

     }else{

      $qr = "INSERT INTO tbl_product(productName,catid,supplierid,unit,price,des_c,discount)
             VALUES ('$productName','$catid','$supplierid','$unit','$price','$des_c', '$discount')";

      $result = $this->db->insert($qr);
      if($result){
              $alert = "<p class='succes'>Thêm thành công!!<p>";
         return $alert;
      }
      else{
        $alert = "<p class='err'>Thêm thất bại!!<p>";
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
      $alert = "<p class='err'>Vui lòng điền đủ thông tin</p>";
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
              $alert = "<p class='succes'>Cập nhật thành công!!<p>";
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
          $alert = "<p class='succes'>Xóa thành công!!<p>"; 
          return $alert;
        }else{
          $alert = '<span class="">delete false!!</span>'; 
          return $alert;
        }
    }
    
  

    







}

?>