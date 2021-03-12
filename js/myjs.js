$(document).ready(function(){
	add_cat();
	load_cat();
	

});


   function add_cat(){
	$('#add-cat').on('click',function(){
		var catName = $('#catName').val();
		
		if(catName == ''){
			$('#message').css({"color":"red"}).html("input not empty");
		}
		else{
			$.ajax({
				url: 'model/ajax_cat.php',
				method: 'post',
				data:{catName:catName},
				success:function(data){
				 $('#message').css({"color":"blue"}).html("success!!!!");
				 $('form').trigger('reset');
				 load_cat();
				}

			})

		}
	})

	$('#close_cat').on('click',function(){
	  $('form').trigger('reset');
	  $('#message').html("");
   });
}


//edit cat
// $(document).on('click', '.edit_cat', function(){
// 	var catid = $(this).attr('id');
// 	console.log(catid);
// 	$.ajax({
// 		url: "model/category.php",
// 		method: "post",
// 		data:{catid:catid},
// 		success:function(data){
// 			$('#info_cat_update').html(data);
// 			$(document).on('click', '#update_cat', function(){
			
// 		     $.ajax({
// 				url: "model/category.php",
// 				method: "post",
// 				data:$("#info_cat_update").serialize(),
// 				success:function(data){
					
// 		        $("#edit_cat").modal('hide');
// 		        load_cat();
					
// 				}
// 			})
// 			})
				
			
// 		}
// 	})

// })

	




function load_cat(){
	$.ajax({
		url: "model/ajax_cat.php",
		method: "post",
		success:function(data){
			$("#data-cat").html(data);
		}
	})
}