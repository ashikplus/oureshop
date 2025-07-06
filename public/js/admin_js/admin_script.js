$(document).ready(function(){
	$("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		
		$.ajax({
			// console.log("coming");
   			type:'post',
			url:'/ecom/public/admin/check-current-pwd',
			data:{current_pwd:current_pwd},
			// console.log("coming2");
			success:function(resp){
				// alert(resp);
				if(resp=="false"){
					$("#chkCurrentPwd").html("<font color=red>Current Password is incorrect</font>");
				}else if(resp=="true"){
					$("#chkCurrentPwd").html("<font color=green>Current Password is correct</font>");
				}
			},
			error:function(){
				alert("Error");
			}
		});
	});

	$(document).on("click",".updateSectionStatus",function(){
		var status = $(this).children("i").attr("status");
		var section_id = $(this).attr("section_id");
		$.ajax({
			type:'post',
			url:'/ecom/public/admin/update-section-status',
			data:{status:status,section_id:section_id},
			success:function(resp){
				if(resp['status']==0){
					$("#section-"+section_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>")
				}
				else if(resp['status']==1){
					$("#section-"+section_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
				}
			},error:function(){
				alert("Error");
			}
		});
 	});
	// Update Brand Status
 	$(document).on("click",".updateBrandStatus",function(){
		var status = $(this).children("i").attr("status");
		var brand_id = $(this).attr("brand_id");
		$.ajax({
			type:'post',
			url:'/ecom/public/admin/update-brand-status',
			data:{status:status,brand_id:brand_id},
			success:function(resp){
				if(resp['status']==0){
					$("#brand-"+brand_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>")
				}
				else if(resp['status']==1){
					$("#brand-"+brand_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
				}
			},error:function(){
				alert("Error");
			}
		});
 	});


	// Update Category Status
 	$(document).on("click",".updateCategoryStatus",function(){
		var status = $(this).children("i").attr("status");
		var category_id = $(this).attr("category_id");
		$.ajax({
			type:'post',
			url:'/ecom/public/admin/update-category-status',
			data:{status:status,category_id:category_id},
			success:function(resp){
				if(resp['status']==0){
					$("#category-"+category_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>")
				}
				else if(resp['status']==1){
					$("#category-"+category_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
				}
			},error:function(){
				alert("Error");
			}
		});
 	});
 	// Update Product Status
 	$(document).on("click",".updateProductStatus",function(){
		var status = $(this).children("i").attr("status");
		var product_id = $(this).attr("product_id");
		$.ajax({
			type:'post',
			url:'/ecom/public/admin/update-product-status',
			data:{status:status,product_id:product_id},
			success:function(resp){
				if(resp['status']==0){
					$("#product-"+product_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>")
				}
				else if(resp['status']==1){
					$("#product-"+product_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
				}
			},error:function(){
				alert("Error");
			}
		});
 	});
 	// Update Attribute Status
 	$(document).on("click",".updateAttributeStatus",function(){
		var status = $(this).text();
		var attribute_id = $(this).attr("attribute_id");
		$.ajax({
			type:'post',
			url:'/ecom/public/admin/update-attribute-status',
			data:{status:status,attribute_id:attribute_id},
			success:function(resp){
				if(resp['status']==0){
					$("#attribute-"+attribute_id).html("Inactive")
				}
				else if(resp['status']==1){
					$("#attribute-"+attribute_id).html("Active")
				}
			},error:function(){
				alert("Error");
			}
		});
 	});

 	// Update Image Status
 	$(document).on("click",".updateImageStatus",function(){
		var status = $(this).text();
		var image_id = $(this).attr("image_id");
		$.ajax({
			type:'post',
			url:'/ecom/public/admin/update-image-status',
			data:{status:status,image_id:image_id},
			success:function(resp){
				if(resp['status']==0){
					$("#image-"+image_id).html("Inactive")
				}
				else if(resp['status']==1){
					$("#image-"+image_id).html("Active")
				}
			},error:function(){
				alert("Error");
			}
		});
 	});

 	// Append Categories Level
 	$('#section_id').change(function(){
 		var section_id = $(this).val();
 		$.ajax({
 			type:'post',
 			url:'/ecom/public/admin/append-categories-level',
 			data:{section_id:section_id},
 			success:function(resp){
 				$("#appendCategoriesLevel").html(resp);
 			},error:function(){
 				alert("Error");
 			}
 		});
 	});

 	// Update Banner Status
 	$(document).on("click",".updateBannerStatus",function(){
		var status = $(this).children("i").attr("status");
		var banner_id = $(this).attr("banner_id");
		$.ajax({
			type:'post',
			url:'/ecom/public/admin/update-banner-status',
			data:{status:status,banner_id:banner_id},
			success:function(resp){
				if(resp['status']==0){
					$("#banner-"+banner_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>")
				}
				else if(resp['status']==1){
					$("#banner-"+banner_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
				}
			},error:function(){
				alert("Error");
			}
		});
 	});

 	// Update Coupon Status
 	$(document).on("click",".updateCouponStatus",function(){
		var status = $(this).children("i").attr("status");
		var coupon_id = $(this).attr("coupon_id");
		$.ajax({
			type:'post',
			url:'/ecom/public/admin/update-coupon-status',
			data:{status:status,coupon_id:coupon_id},
			success:function(resp){
				if(resp['status']==0){
					$("#coupon-"+coupon_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>")
				}
				else if(resp['status']==1){
					$("#coupon-"+coupon_id).html("<i class='fas fa-toggle-on' status='Active'></i>")
				}
			},error:function(){
				alert("Error");
			}
		});
 	});

 	// Show Hide Coupon Field for Manual or Automatic

 	$("#ManualCoupon").click(function(){
 		$("#couponField").show();
 	});
 	$("#AutomaticCoupon").click(function(){
 		$("#couponField").hide();
 	});

 	//Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    // Show Courier Name and Traking Number in case of Shipped Order Status
    $("#courier_name").hide();
    $("#tracking_number").hide();
    $("#order_status").on("change",function(){
    	if(this.value=="Shipped"){
    		$("#courier_name").show();
    		$("#tracking_number").show();
    	}else{
    		$("#courier_name").hide();
    		$("#tracking_number").hide();
    	}
    });

 	// Confirm Deletion of Record
 	// $(".confirmDelete").click(function(){
 	// 	var name = $(this).attr("name");
 	// 	if(confirm("Are you sure to delete this"+name+"?")){
 	// 		return true;
 	// 	}
 	// 	return false;
 	// });

 	// Confirm Deletion with SweetAlert
 		$(document).on("click",".confirmDelete",function(){
 		var record = $(this).attr("record");
 		var recordid = $(this).attr("recordid");
 		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.isConfirmed) {
		    window.location.href="/ecom/public/admin/delete-"+record+"/"+recordid;
		  }
		});
		// return false;
 	});
});

// Product Images Add/Remove Scripts
var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="height=10px; margin-bottom:5px;"><div style="height=10px"></div><input type="text" name="size[]" placeholder="size" style="width:120px"/>&nbsp;<input type="text" name="sku[]" placeholder="sku" style="width:120px"/>&nbsp;<input type="text" name="price[]" placeholder="price" style="width:120px"/>&nbsp;<input type="text" name="stock[]" placeholder="stock" style="width:120px"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });