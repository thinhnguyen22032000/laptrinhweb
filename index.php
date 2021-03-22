<?php include "inc/header.php" ?>
<?php include "lib/format.php" ?>
<?php 
    include "model/thongke.php";
    $fm = new Format();
    $thongke = new thongke();  
?>
<style type="text/css">
	 .c_block{
           padding: 30px 10px;
           margin: 20px;
	 }

</style>
        <div class="col-sm-8 text-left mgc">
        <h3 class="mt-3 tl_ct">Quản trị</h3>   
    	<div class="m-5 container_block">
        <button type="button" class="btn btn-primary w-25 c_block">
        	<h6 class="pb-2 border-bottom">Sản phẩm</h6>
        	<p class="">Số lượng: <?php echo $thongke->thongke_product();?></p>
        </button>
		<button type="button" class="btn btn-secondary w-25 c_block">
			<h6 class="pb-2 border-bottom">Danh mục</h6>
        	<p class="">Số lượng: <?php echo $thongke->thongke_category();?></p>
		</button>
		<button type="button" class="btn btn-success w-25 c_block">
			<h6 class="pb-2 border-bottom">Nhà cung cấp</h6>
        	<p class="">Số lượng: <?php echo $thongke->thongke_supplier();?></p>
		</button>
		<button type="button" class="btn btn-danger w-25 c_block">
			<h6 class="pb-2 mb-0 border-bottom">Số phiếu nhập</h6>
        	<p class="mb-0">Số lượng: <?php echo $thongke->thongke_phieunhap();?></p>
        	<p class="mb-0">Tiền nhập: <?php echo $fm->canvert_vnd($thongke->thongke_pricepn());?></p>
		</button>
		<button type="button" class="btn btn-warning w-25 c_block">
			<h6 class="pb-2 border-bottom">Phiếu xuất</h6>
        	<p class="">Số lượng: <?php echo $thongke->thongke_phieuxuat();?></p>
		</button>
		<button type="button" class="btn btn-info w-25 c_block">
			<h6 class="pb-2 mb-0 border-bottom">Hóa đơn</h6>
        	<p class="mb-0">Số lượng: <?php echo $thongke->thongke_hoadon();?></p>
        	<p class="mb-0">Doanh thu: <?php echo $fm->canvert_vnd($thongke->thongke_doanhthu());?></p>
		</button>
	
	</div>
    





    </div>
    
  </div>
</div>

<?php include "inc/footer.php" ?>