<?php
   ob_start();
   require_once ('lib/session.php');
  
   Session::checkSession();
 
 ?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản trị</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--  icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   
  <!-- tinyce -->
  <script src="https://cdn.tiny.cloud/1/m2ilur8n7cxswf9n6r1urfksrcukl9ofpp75hsgp0soht3ma/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
      tinymce.init({
        selector: '#desc'
      });
  </script>
  <style>

  .content{
    height: auto !important;
  }

    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
   
    .pd{
      padding-bottom: 0px !important;
    }
    .taga:hover{
      text-decoration: none;
    }
    .h_ct{
      height: 60px;
      line-height: 60px;
      background-color: #117a8b;


    }
    .bbct{
      border-bottom: 1px solid white;
      padding-bottom: 15px;
      padding-top:5px;
      font-size: 18px;
      font-family: sans-serif;
    }
    .col-sm-9{
      margin-top: 20px;
      margin-bottom: 50px;
    }
    .nav-link{
      color: white;
    }
    .forc{
      color: black !important;
    }
    .dx{
      margin-left: 70%;
      color: white;
     
    }
    .dx a {
      color: white;
    }
    .login_ct {
       text-decoration: none;
       color: white;
    }
    .nav-item h3{
          line-height: 60px;
    margin-left: 20px;
    color: white;
    }

    .table thead tr {
  background-color: #17a2b8;
    color: white;
}
  
   /* .sub-menu li{
       list-style: none;

    }
    .fa-menu i{

    }
    .fa-menu:hover .sub-menu{
      display: block;
     
    }
    .sub-menu{
      padding-left: 0px;
      padding: 15px 20px;
      border: 1px solid #dee2e6;
     
      right: 55px;
      box-shadow: 1px 1px 8px #888888;
      border-radius: 5px;
      display: none;
      
    }
    .sub-menu li a{
      padding-left: 15px;
    color: black;
    }*/
  </style>
</head>

<body>
 <!--  menu navs -->
 <ul class="nav nav-pills h_ct">
    <li class="nav-item">
      <h3>Lập Trình web</h3>
    </li>
  
    <?php 
         if(isset($_GET['logout']) && $_GET['logout'] == 'logout'){
          Session::destroy();
         }
    ?>
    <li class="nav-item dx">
      
        Xin chào: <?php echo $_SESSION['adminName'] ?> || <a href="?logout=logout">Đăng xuất</a>
       
    </li>
    
  
</ul>
      

  



 
<!-- menu dropdow  -->
<div class="container-fluid">    
  <div class="row row-p">
    <div class="col-md-2 text-white d-none d-md-block sidebar" style="background-color: #e9ecef">
      <div class="left-sidebar">
        <div class="nav flex-column sidebar-nav">
        <h3 class="mt-3 mb-4"><a href="index.php" class="pl-4 mb-2 text-white forc taga">Trang chủ</a></h3>

        <!-- quan li kho -->
        <?php 
           $level = $_SESSION['level'];
           if($level == 0 || $level == 1){ ?>
              <div class="dropdown bbct pd">
              <p class="border-0 pl-4 text-white forc" type="button" data-toggle="dropdown"><i style='font-size:16px' class='fas pr-2'>&#xf494;</i>Quản lí kho<i style='font-size:18px; margin-left: 65px' class='fas'>&#xf107;</i>
              <span class="caret"></span></p>
              <ul class="dropdown-menu w-100" style="background-color: #e9ecef">
                <li><a class="dropdown-item" href="catlist.php"><i style='font-size:16px' class='fas pr-2'>&#xf105;</i>Danh mục</a></li>
                <li><a class="dropdown-item" href="supplierlist.php"><i style='font-size:16px' class='fas pr-2'>&#xf105;</i>Nhà cung cấp</a></li>
                <li><a class="dropdown-item" href="productlist.php"><i style='font-size:16px' class='fas pr-2'>&#xf105;</i>Sản phẩm</a></li>
              </ul>
            </div>
        <!-- nhap xuat kho -->
          <div class="dropdown bbct pd">
          <p class="border-0 pl-3 text-white forc" type="button" data-toggle="dropdown"><i style='font-size:24px' class='fas mr-2'>&#xf472;</i>Nhập - xuất<i style='font-size:18px; margin-left: 65px' class='fas'>&#xf107;</i>
          <span class="caret"></span></p>
          <ul class="dropdown-menu w-100" style="background-color: #e9ecef">
            <li><a class="dropdown-item" href="whimport.php"><i style='font-size:16px' class='fas pr-2'>&#xf105;</i>Nhập kho</a></li>
            <li><a class="dropdown-item" href="phieuxuatlist.php"><i style='font-size:16px' class='fas pr-2'>&#xf105;</i>Xuất kho</a></li>
          </ul>
        </div>

        <?php
           }

        ?>
       
        <!-- quan lí nhan su  -->
        <?php 
            if($level == 0){ ?>

               <a href="personnellist.php" class="pl-4 text-white taga bbct forc"><i style='font-size:24px' class='fas pr-2'>&#xf3e0;</i>Quản lí nhân sự</a>
                <a href="thongkeall.php" class="pl-4  text-white taga bbct forc"><i style='font-size:24px' class='fas pr-2'>&#xf200;</i>Thống kê</a>
        <?php
            }

        ?>

       
        
        <?php 
            if($level == 2 || $level == 0){ ?>
               <a href="hoadonlist.php" class="pl-4  text-white taga bbct forc"><i style='font-size:24px' class='fas pr-2'>&#xf681;</i>Quản lí bán hàng</a>
        <?php
            }
        ?>
        
        
        
        </div>
  



    </div>
  </div>




 
  