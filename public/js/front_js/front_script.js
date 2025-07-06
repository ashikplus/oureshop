$(document).ready(function(){
	// $("#sort").on('change',function(){
	// 	this.form.submit();
	// });
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$("#sort").on('change',function(){
		var sort = $(this).val();
		var fabric = get_filter("fabric");
		var sleeve = get_filter("sleeve");
		var pattern = get_filter("pattern");
		var fit = get_filter("fit");
		var occasion = get_filter("occasion");
		var url = $("#url").val();
		$.ajax({
			url:url,
			method:"post",
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(data){
				$('.filter_products').html(data);
			}
		})
	});

	$(".fabric").on('click',function(){
		var fabric = get_filter("fabric");
		var sleeve = get_filter("sleeve");
		var pattern = get_filter("pattern");
		var fit = get_filter("fit");
		var occasion = get_filter("occasion");
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url:url,
			method:"post",
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(data){
				$('.filter_products').html(data);
			}
		})
	});

	$(".sleeve").on('click',function(){
		var fabric = get_filter("fabric");
		var sleeve = get_filter("sleeve");
		var pattern = get_filter("pattern");
		var fit = get_filter("fit");
		var occasion = get_filter("occasion");
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url:url,
			method:"post",
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(data){
				$('.filter_products').html(data);
			}
		})
	});

	$(".pattern").on('click',function(){
		var fabric = get_filter("fabric");
		var sleeve = get_filter("sleeve");
		var pattern = get_filter("pattern");
		var fit = get_filter("fit");
		var occasion = get_filter("occasion");
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url:url,
			method:"post",
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(data){
				$('.filter_products').html(data);
			}
		})
	});

	$(".fit").on('click',function(){
		var fabric = get_filter("fabric");
		var sleeve = get_filter("sleeve");
		var pattern = get_filter("pattern");
		var fit = get_filter("fit");
		var occasion = get_filter("occasion");
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url:url,
			method:"post",
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(data){
				$('.filter_products').html(data);
			}
		})
	});

	$(".occasion").on('click',function(){
		var fabric = get_filter("fabric");
		var sleeve = get_filter("sleeve");
		var pattern = get_filter("pattern");
		var fit = get_filter("fit");
		var occasion = get_filter("occasion");
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url:url,
			method:"post",
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(data){
				$('.filter_products').html(data);
			}
		})
	});

	function get_filter(class_name){
		var filter = [];
		$('.'+class_name+':checked').each(function(){
			filter.push($(this).val());
		});
		return filter;
	}

	$("#getPrice").change(function(){
		var size = $(this).val();
		if(size == ""){
			alert("Please Select a Size");
			return false;
		}
		var product_id = $(this).attr("product-id");
		// alert(product_id);
		$.ajax({
			url:'/ecom/public/get-product-price',
			data:{size:size,product_id:product_id},
			type:'post',
			success:function(resp){
				if(resp['discount']>0){
					$(".dell").html("Tk."+resp['product_price']);
					$(".bb").html("Tk.("+resp['final_price']+")");
					// $(".getAttrPrice").html("<del>Tk. "+resp['product_price']+"</del> Tk."+resp['discounted_price']);
					// $('.getAttrPrice').addClass('red');
				}else{
					$(".getAttrPrice").html("Tk."+resp['product_price']);
				}
			},error:function(){
				alert("Error");
			}
		});
	});

	// active class on listview or blockview
	$(".switcher").on('click',function(){
		var theid = $(this).attr("id");
      // var theproducts = $("ul#products");
      var classNames = $(this).attr('class').split(' ');
      // console.log(classNames);
      if ($(this).hasClass("active btn-primary")) {
      	return false;
      } else {
      	if (theid == "gridview") {
      		$(this).addClass("active btn-primary");
      		$("#listview").removeClass("active btn-primary");
          // $("#listview").children("img").attr("src", "images/list-view.png");
          // var theimg = $(this).children("img");
          // theimg.attr("src", "images/grid-view-active.png");
          // theproducts.removeClass("list");
          // theproducts.addClass("grid");
        } else if (theid == "listview") {
        	$(this).addClass("active btn-primary");
        	$("#gridview").removeClass("active btn-primary");
          // $("#gridview").children("img").attr("src", "images/grid-view.png");
          // var theimg = $(this).children("img");
          // theimg.attr("src", "images/list-view-active.png");
          // theproducts.removeClass("grid")
          // theproducts.addClass("list");
        }
      }
    });

	// Update Cart Item
	$(document).on('click','.btnItemUpdate',function(){
		if($(this).hasClass('qtyMinus')){
			var quantity = $(this).prev().val();
			if(quantity == 1){
				return false;
			}else{
				new_qty = parseInt(quantity)-1;
			}
		}
		if($(this).hasClass('qtyPlus')){
			var quantity = $(this).prev().prev().val();
			new_qty = parseInt(quantity)+1;
		}
    	// alert(new_qty);
    	var cartid = $(this).data('cartid');
    	// alert(cartid);
    	$.ajax({
    		data:{"cartid":cartid,"qty":new_qty},
    		url:'/ecom/public/update-cart-item-qty',
    		type:'post',
    		success:function(resp){
    			if(resp.status==false){
    				alert(resp.message);
    			}
    			$(".totalCartItems").html(resp.totalCartItems);
    			$("#AppendCartItems").html(resp.view);
    		},error:function(){
    			alert("Error");
    		}
    	});
    });

	// Delete Cart Item
	$(document).on('click','.btnItemDelete',function(){
		var cartid = $(this).data('cartid');
		$result = confirm("Are you sure want to Delete this item?");
		if($result){
			$.ajax({
				data:{"cartid":cartid},
				url:'/ecom/public/delete-cart-item',
				type:'post',
				success:function(resp){
					$(".totalCartItems").html(resp.totalCartItems);
					$("#AppendCartItems").html(resp.view);
				},error:function(){
					alert("Error");
				}
			});
		}
	});

	// validate signin form on keyup and submit
	$("#registerForm").validate({
		rules: {
			name: "required",
			mobile: {
				required: true,
				minlength: 11,
				maxlength: 11,
				digits: true
			},
			email: {
				required: true,
				email: true,
				remote: "check-email"
			},
			password: {
				required: true,
				minlength: 6
			}
		},
		messages: {
			name: "Please enter your name",
			mobile: {
				required: "Please enter a mobile number",
				minlength: "Mobile number must consist of 11 digits",
				maxlength: "Mobile number must consist of 11 digits",
				digits: "Please enter valid mobile number"
			},
			email: {
				required: "Please enter a email",
				email: "Please enter a valid email address",
				remote: "Email already exists"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 6 digits"
			}
		}
	});

	// validate signup form on keyup and submit
	$("#loginForm").validate({
		rules: {
			email: {
				required: true,
				email: true,
				// remote: "check-email"
			},
			password: {
				required: true,
				minlength: 6
			}
		},
		messages: {
			email: {
				required: "Please enter a email",
				email: "Please enter a valid email address"
				// remote: "Email already exists"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 6 digits"
			}
		}
	});

	// validate account form on keyup and submit
	$("#accountForm").validate({
		rules: {
			name: "required",
			mobile: {
				required: true,
				minlength: 11,
				maxlength: 11,
				digits: true
			}
		},
		messages: {
			name: "Please enter your name",
			mobile: {
				required: "Please enter a mobile number",
				minlength: "Mobile number must consist of 11 digits",
				maxlength: "Mobile number must consist of 11 digits",
				digits: "Please enter valid mobile number"
			}
		}
	});

	// Coupon functionality
	$("#ApplyCoupon").submit(function(){
		var user = $(this).attr("user");
		if(user==1){

		}else{
			alert("Please login to apply coupon");
			return false;
		}
		var code = $("#code").val();
		$.ajax({
			type:'post',
			data:{code:code},
			url:'/ecom/public/apply-coupon',
			success:function(resp){
				if(resp.message!=""){
					alert(resp.message);
				}
				$(".totalCartItems").html(resp.totalCartItems);
    	  $("#AppendCartItems").html(resp.view);
    	  $(".couponDiscount").text("Tk. "+resp.couponAmount);
    	  if(resp.couponAmount > 0){
    	  	$(".final_amount").text("Tk. "+resp.total_amount);
    	  }
    	  $(".cpndis").text("Tk. "+resp.couponAmount);
			},error:function(){
				alert("Error");
			}
		})
	});


});