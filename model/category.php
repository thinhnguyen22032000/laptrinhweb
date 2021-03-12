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
          $alert = '<span class="">delete successfull!!</span>'; 
          return $alert;
        }else{
          $alert = '<span class="">delete false!!</span>'; 
          return $alert;
        }
    }

    public function edit_cat($catid, $catName){
      
      $catName = $this->fm->validation($catName);
      
      if($catName == ''){
        $alert = '<span class="red2">Vui lòng nhập đủ thông tin</span>';
        return $alert;
      }
      else{

        $qr = "UPDATE tbl_category SET catName = '$catName' WHERE catid = '$catid'";
        $result= $this->db->update($qr);
        if($result){
        	$alert = '<span class="">update successfull!!</span>'; 
        	return $alert;
        }else{
        	$alert = '<span class="">update false!!</span>'; 
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
        $alert = '<span class="red2">Vui lòng nhập đủ thông tin</span>';
        return $alert;
      }
      else{

        $qr = "UPDATE tbl_supplier SET supplierName = '$supplierName' WHERE supplierid = '$suid'";
        $result= $this->db->update($qr);
        if($result){
          $alert = '<span class="">update successfull!!</span>'; 
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
          $alert = '<span class="">delete successfull!!</span>'; 
          return $alert;
        }else{
          $alert = '<span class="">delete false!!</span>'; 
          return $alert;
        }
    }

    public function add_su($supplierName){
        $qr = "INSERT INTO tbl_supplier(supplierName) VALUES ('$supplierName')";
        $result= $this->db->delete($qr); 
         if($result){
          $alert = '<span class="">add successfull!!</span>'; 
          return $alert;
        }else{
          $alert = '<span class="">add false!!</span>'; 
          return $alert;
        }
    }

    
  







}

?>