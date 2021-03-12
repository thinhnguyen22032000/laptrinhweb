<?php 
  $filepath = realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/session.php');
   Session::checkLogin();
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>
<?php 
  class admin
  {
  	private $db;
    private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
      $this->fm = new Format();  		
    }

    public function admin_login($adminEmail, $adminPass){
      $adminEmail = $this->fm->validation($adminEmail);
      $adminPass = $this->fm->validation($adminPass);
      
      if(empty($adminPass) || empty($adminPass)){
      $alert = "Vui lòng kiểm tra input!!";
      return $alert;
      }
      else{
        $qr = "SELECT * FROM tbl_admin WHERE adminEmail = '$adminEmail' AND adminPass = '$adminPass' LIMIT 1";
        $result = $this->db->select($qr);

        if($result != false){
          $value = $result->fetch_assoc();
          Session::set('adminlogin', true);
          Session::set('adminid', $value['adminid']);
              Session::set('adminEmail', $value['adminEmail']);
              Session::set('adminName', $value['adminName']);
              Session::set('level', $value['level']);
              header('location: index.php');
        }
        else{
          $alert = "Tài khoản hoặc mật khẩu không chính xác";
          return $alert;
        } 

    }
     
    }

   
    
  
    
  







}

?>