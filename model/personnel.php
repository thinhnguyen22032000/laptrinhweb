<?php 
  $filepath = realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/session.php');
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>
<?php 
  class personnel
  {
  	private $db;
    private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
      $this->fm = new Format();  		
    }

  

    public function show_personnel(){
       $qr = "SELECT * FROM tbl_admin ";
       $result = $this->db->select($qr);
       return $result;
    }

    public function add_personnel($data){
      $adminName = $data['adminName'];
      $adminEmail = $data['adminEmail'];
     
      $adminPass = md5($data['adminPass']);
      $phone = $data['phone'];
      $level = $data['level'];
      $passAgain = md5($data['passAgain']);

      if($adminName == '' || $adminEmail == '' || $adminPass == '' || $phone == '' || $level == '' || $passAgain =='' ){
      $alert = "<p class='err'>Vui lòng điền đủ thông tin</p>";
      return $alert;

      }
      elseif($adminPass != $passAgain){
       $alert = "<p class='err'>Kiểm tra lại mật khẩu</p>";
       return $alert;
      }
      // check email
      $qr = "SELECT * FROM tbl_admin WHERE adminEmail = '$adminEmail'";
      $result = $this->db->select($qr);
      if($result){
        $alert = "<p class='err'>Email đã tồn tại</p>";
        return $alert;
      }
      else{
      $qr = "INSERT INTO tbl_admin(adminName, adminEmail, adminPass, phone, level)
             VALUES ('$adminName','$adminEmail','$adminPass','$phone','$level')";

            $result = $this->db->insert($qr);
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


   public function get_per_by_id($perid){
     $qr = "SELECT * FROM tbl_admin WHERE adminid = '$perid'";
     $result = $this->db->select($qr);
     return $result;
    }     
    //edit admin
    public function edit_personnel($perid, $data){
      $adminName = $data['adminName'];
      $adminEmail = $data['adminEmail'];
      $phone = $data['phone'];
      $level = $data['level'];
     

      if($adminName == '' || $adminEmail == '' || $phone == '' || $level == ''){
      $alert = "<p class='err'>Vui lòng điền đủ thông tin</p>";
      return $alert;
      }
      else{
        $qr = "SELECT * FROM tbl_admin WHERE adminEmail = '$adminEmail'";
        $result = $this->db->select($qr);
        if($result){
          $alert = "<p class='err'>Email đã tồn tại</p>";
          return $alert;
        }
      $qr = "UPDATE tbl_admin SET
            adminName = '$adminName',
            adminEmail = '$adminEmail',
            phone = '$phone',
            level = '$level'
            WHERE adminid = '$perid'
             ";

            $result = $this->db->update($qr);
            if($result){
                    $alert = "<p class='succes'>Cập nhật thành công</p>";
               return $alert;
            }
            else{
              $alert = "<span class='err'>Cập nhật thất bại</span>";
              return $alert;
      } 
     }

    }

     public function del_personnel($delid){
     $qr = "DELETE FROM tbl_admin WHERE adminid = '$delid'";
     $result = $this->db->delete($qr);
      if($result){
          $alert = "<p class='succes'>Xóa thành công</p>";
          return $alert;
      }
      else{
        $alert = "<p class='err'>Xóa thất bại</p>";
        return $alert;
      } 
    }  
  
    
  







}

?>