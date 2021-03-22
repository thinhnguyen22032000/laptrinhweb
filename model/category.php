<?php 
  $filepath = realpath(dirname(__FILE__));
  // require_once ($filepath.'/../lib/session.php');
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>



<?php 
  class category
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }

    // function category
    public function get_cat_by_id($catid){
        $qr = "SELECT * FROM tbl_category WHERE catid = '$catid'";
        $result= $this->db->select($qr); 
        return $result;
    }
      public function show_category(){
        $qr = "SELECT * FROM tbl_category";
        $result= $this->db->select($qr); 
        return $result;
    }

    public function del_cat($catid){
        $qr = "DELETE FROM tbl_category WHERE catid = '$catid'";
        $result= $this->db->delete($qr); 
         if($result){
          $alert = "<p class='succes'>Xóa thành công!!<p>"; 
          return $alert;
        }else{
          $alert = '<span class="">delete false!!</span>'; 
          return $alert;
        }
    }

    public function edit_cat($catid, $catName){
      
      $catName = $this->fm->validation($catName);
      
      if($catName == ''){
        $alert = '<span class="red">Vui lòng nhập đủ thông tin</span>';
        return $alert;
      }
      else{

        $qr = "UPDATE tbl_category SET catName = '$catName' WHERE catid = '$catid'";
        $result= $this->db->update($qr);
        if($result){
        	$alert = "<p class='succes'>Cập nhật thành công!!<p>"; 
        	return $alert;
        }else{
        	$alert = "<p class='err'>Cập nhật thất bại!!<p>"; 
        	return $alert;
        }
        
    }       
     
  }


  // function suppiler

  public function show_supplier(){
      $qr = "SELECT * FROM tbl_supplier";
      $result= $this->db->select($qr); 
      return $result;
   
     
  }
   public function get_su_by_id($supplierid){
        $qr = "SELECT * FROM tbl_supplier WHERE supplierid = '$supplierid'";
        $result= $this->db->select($qr); 
        return $result;
    }

     public function edit_su($suid, $supplierName){
      
      $supplierName = $this->fm->validation($supplierName);
      
      if($supplierName == ''){
        $alert = "<p class='err'>Vui lòng nhập đủ thông tin!!<p>";
        return $alert;
      }
      else{

        $qr = "UPDATE tbl_supplier SET supplierName = '$supplierName' WHERE supplierid = '$suid'";
        $result= $this->db->update($qr);
        if($result){
          $alert = "<p class='succes'>Cập nhật thành công!!<p>"; 
          return $alert;
        }else{
          $alert = '<span class="">update false!!</span>'; 
          return $alert;
        }
        
    }       
     
  }

   public function del_su($suid){
        $qr = "DELETE FROM tbl_supplier WHERE supplierid = '$suid'";
        $result= $this->db->delete($qr); 
         if($result){
          $alert = "<p class='err'>Xóa thành công!!<p>"; 
          return $alert;
        }else{
          $alert = '<span class="">delete false!!</span>'; 
          return $alert;
        }
    }

    public function add_su($supplierName){
        if($supplierName == ''){
          $alert =  "<p class='err'>Vui lòng nhập đủ thông tin!!<p>"; 
          return $alert;
        }
        $qr = "INSERT INTO tbl_supplier(supplierName) VALUES ('$supplierName')";
        $result= $this->db->insert($qr); 
         if($result){
          $alert = "<p class='succes'>Thêm thành công!!<p>"; 
          return $alert;
        }else{
          $alert = "<p class='err'>Thêm thất bại!!<p>"; 
          return $alert;
        }
    }

    
  







}

?>