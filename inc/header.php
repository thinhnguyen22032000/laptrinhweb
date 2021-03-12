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
  <link rel="stylesheet" type="text/css" href="css/style.css">
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   
 
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
    .forc:focus{
     outline: none !important;
   
    }
     .forc:hover{
     
     background: blue;
    }
    .taga:hover{
      text-decoration: none;
    }
  </style>
</head>

<body>
 <!--  menu navs -->
 <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link active" href="#">Active</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="#">Disabled</a>
    </li>
    <?php 
         if(isset($_GET['logout']) && $_GET['logout'] == 'logout'){
          Session::destroy();
         }
    ?>
    <li class="nav-item">
      <a class="btn btn-link" href="?logout=logout">Đăng xuất</a>
    </li>
  </ul>



 
<!-- menu dropdow  -->
<div class="container-fluid">    
  <div class="row">
    <div class="col-md-2 bg-secondary text-white d-none d-md-block sidebar">
      <div class="left-sidebar">
        <div class="nav flex-column sidebar-nav">
        <h3 class="mt-3"><a href="index.php" class="pl-4 mb-2 text-white taga">Trang chủ</a></h3>
        <div class="dropdown">
          <p class="border-0 pl-4 mt-3 mb-2 text-white bg-secondary forc" type="button"  data-toggle="dropdown">Quản lí kho
          <span class="caret"></span></p>
          <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" href="catlist.php">Danh mục</a></li>
            <li><a class="dropdown-item" href="supplierlist.php">Nhà cung cấp</a></li>
            <li><a class="dropdown-item" href="productlist.php">Sản phẩm</a></li>
          </ul>
        </div>
        <a href="personnellist.php" class="pl-4 mb-2 text-white taga">Quản lí nhân sự</a>
        <div class="dropdown">
          <p class="border-0 pl-4 bg-secondary text-white forc" type="button" data-toggle="dropdown">Quản lí nhập - xuất
          <span class="caret"></span></p>
          <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" href="whimport.php">Nhập kho</a></li>
            <li><a class="dropdown-item" href="phieuxuatlist.php">Xuất kho</a></li>
           
          </ul>
        </div>
        </div>
      

    </div>
  </div>




 
  