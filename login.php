<?php include 'model/admin.php'; ?>

<html>
<head>
	<title>login admin</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="css/style.css">
	  <style type="text/css">
	  	.lg{
	  	    margin-top: 60px;
		    padding: 15px;
		    border: 1px solid #dee2e6;
		    box-shadow: antiquewhite;
		    box-shadow: 1px 1px 8px #888888;
		    padding-top: 50px;
		}
       .tl-lg{
       	text-align: center;
        color: #0043ff;
       }

       .err{
       	padding: 5px;
	    background-color: #ffd0d0;
	    color: red;
       }
	  </style>
</head>
<body>
	<?php
	     $ad = new admin();
         
         if(isset($_POST['submit'])){
         	$adminEmail = $_POST['adminEmail'];
         	$adminPass = $_POST['adminPass'];

            $admin_login = $ad->admin_login($adminEmail, $adminPass);
         	
         }
	 ?>
    <div class="container-fluid">
    	<div class="row justify-content-center">
    		<div class="col-12 col-sm-6 col-md-3 lg">
    			<h3 class="tl-lg">Đăng nhập</h3>
    			<form class="form-container" method="post" action="" >
				    <?php 
                         if(isset($admin_login)){
                         	echo $admin_login;
                         }
				    ?>
					  <div class="mb-3">
					    <label for="exampleInputEmail1" class="form-label">Email address</label>
					    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="adminEmail">
					    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
					  </div>
					  <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" name="adminPass">
					  </div>
					 
					  <button type="submit" class="btn btn-primary" name="submit">Login</button>

				</form>
    		</div>
    	</div>
    </div>

</body>
</html>