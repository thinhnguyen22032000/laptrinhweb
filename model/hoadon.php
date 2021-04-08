<?php 
  $filepath = realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/session.php');
  require_once ($filepath.'/../lib/format.php');
  require_once ($filepath.'/../lib/database.php');

  ?>
<?php 
  class hoadon
  {
  	private $db;
    private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
      $this->fm = new Format();  		
    }

  

    public function phantrang_hoadon(){
       $sp1trang = 5;
        if(isset($_GET['page'])){
          $trang = $_GET['page'];
        }else{
          $trang = 1;
        }
        $vitri = ($trang - 1)*$sp1trang;

            $qr =  "SELECT
          tbl_cthd.*,
          price,
          discount,
          adminid,
          sum(price * tbl_cthd.quantity * (1-(discount/100))) AS total
      FROM
          tbl_cthd
      INNER JOIN tbl_product ON tbl_cthd.productid = tbl_product.productid
      INNER JOIN tbl_hoadon ON tbl_cthd.hoadon_id = tbl_hoadon.hoadon_id GROUP by tbl_hoadon.hoadon_id ORDER BY hoadon_id DESC LIMIT $vitri, $sp1trang";
       
       // $qr = "SELECT * FROM tbl_hoadon  ORDER BY hoadon_id DESC LIMIT $vitri, $sp1trang";



       $result = $this->db->select($qr);
       return $result;
    }

     public function row_hd(){
       $qr = "SELECT * FROM tbl_hoadon";
       $result = $this->db->select($qr);
       return $result;
    }

     public function add_hoadon($adminid, $date){
       $qr = "INSERT INTO tbl_hoadon(adminid) VALUES('$adminid')";
       $result = $this->db->insert($qr);
       if($result){
        $qr = "SELECT * from tbl_hoadon WHERE date_order = '$date'";
        $row = $this->db->select($qr)->fetch_assoc();
        $hoadon_id = $row['hoadon_id'];
        header("location: hoadonchitiet.php?hd=".$hoadon_id."");
       }
    }
    public function get_hd_by_id($id){
       $qr = "SELECT * FROM tbl_hoadon WHERE hoadon_id = '$id'";
       $result = $this->db->select($qr);
       return $result;
    }


    public function add_chitiethd($data){
      $hoadon_id = $data['hoadon_id'];
      $date_order = $data['date_order'];
      $productid = $data['productid'];
      $quantity = $data['quantity'];
      $note = $data['note'];

      if($hoadon_id == '' || $date_order == '' || $productid == '' || $quantity == ''){
          $alert = "<p class='err'>Vui lòng điền đủ thông tin</p>";
          return $alert;

     }else{
          $get_qt_curren = "SELECT quantity FROM tbl_productsell WHERE productid = '$productid'"; //get qt kho
          $qt_cur = $this->db->select($get_qt_curren);
          if($qt_cur){
             $result = $qt_cur->fetch_assoc();
             $rows = $result['quantity'];
          }
          $quantity_product = $rows - $quantity; // quanitty sau khi xuát hàng trong tbl_product
          if($quantity_product < 0){
             $alert = "<p class='err'>Số lượng trong kho không đủ(Hiện có: ".$rows."). Vui lòng nhập thêm hàng</p>";
            return $alert;
          }
          else{
            $qr = "SELECT  * FROM tbl_cthd WHERE hoadon_id = '$hoadon_id' AND productid = '$productid' AND date_order = '$date_order'";
            $result = $this->db->select($qr);
            if($result){
                $alert = "<p class='err'>Sản phẩm đã tồn tại trong hóa đơn</p>";
               return $alert;
            }else{
              $up_quantity = "UPDATE tbl_productsell SET quantity = '$quantity_product' WHERE productid = '$productid'";
              $kq = $this->db->update($up_quantity);
              // add row vào chi tiet hd
              $qr = "INSERT INTO tbl_cthd(hoadon_id,date_order,productid,quantity,note) VALUES ('$hoadon_id','$date_order','$productid','$quantity','$note')";

              $result = $this->db->insert($qr);
              

              if($result){
                    $alert = "<p class='succes'>Thêm thành công</p>";
               return $alert;
              }
              else{
                $alert = "<span class='err'>Thêm thất bại</span>";
                return $alert;
            } 
            }
            
          }
         
          
     }

    }

    public function update_qt($quantity, $productid, $hoadon_id){
       if( $quantity == ''){
          $alert = "<span class='red'>Vui lòng điền đủ thông tin</span>";
          return $alert;

       }else{
          
          // get quantity hiien tại trong tbl_chitiethd
           $qr = "SELECT  * FROM tbl_chitiethd WHERE hoadon_id = '$hoadon_id' AND productid = '$productid'";
           $result = $this->db->select($qr)->fetch_assoc();
           $quantity_curren = $result['quantity'];
           //quan ti thay doi
           $qt_thaydoi = $quantity - $quantity_curren; //qt post - qt cthd

           //get quanti trong kho
          $get_qt_curren = "SELECT quantity FROM tbl_product WHERE productid = '$productid'";
          $qt_cur = $this->db->select($get_qt_curren);
          if($qt_cur){
             $result = $qt_cur->fetch_assoc();
             $rows = $result['quantity'];
          }

          $quantity_product = $rows - $qt_thaydoi;
          if($quantity_product < 0){
             $alert = "<span class='err'>Số lượng trong kho không đủ(Hiện có: ".$rows."). Vui lòng nhập thêm hàng</span>";
            return $alert;
          }else{
            $up_quantity = "UPDATE tbl_product SET quantity = '$quantity_product' WHERE productid = '$productid'";
            $kq = $this->db->update($up_quantity);
            
            $quantity_up = $qt_thaydoi + $quantity_curren;
            $up_quantity = "UPDATE tbl_chitiethd SET quantity = '$quantity_up' WHERE productid = '$productid'";
            $kq = $this->db->update($up_quantity);


            // update product sell

            // get san phảm trong tbl_productsell
              $get_qt_curren = "SELECT * FROM tbl_productsell WHERE productid = '$productid'";
              $qt_cur = $this->db->select($get_qt_curren);
        
               $row = $qt_cur->fetch_assoc();
               $productsell_curren = $row['quantity'];

               $productsell_upqt = $productsell_curren + $qt_thaydoi;



              $qr = "UPDATE tbl_productsell SET quantity = '$productsell_upqt' WHERE productid = '$productid'";

                $result_productsell = $this->db->update($qr);

             if($result){
                    $alert = "<span class='succes'>Cập nhật thành công</span>";
               return $alert;
              }
              else{
                $alert = "<span class='err'>Cập nhật thất bại</span>";
                return $alert;
            } 
              
          }
       }



    }

    public function show_chitiethd($hoadon_id){
       $qr = "SELECT tbl_cthd.*,productName,price,discount,unit,adminid,tbl_hoadon.date_order from tbl_cthd inner join tbl_product on tbl_cthd.productid = tbl_product.productid
         inner join tbl_hoadon on tbl_cthd.hoadon_id = tbl_hoadon.hoadon_id
       WHERE tbl_cthd.hoadon_id = '$hoadon_id'";
       $result = $this->db->select($qr);
       return $result;
    }


    






}

?>