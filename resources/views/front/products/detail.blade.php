<?php use App\Product; ?>
@extends('layouts.front_layout.front_layout')
@section('css')
<link href="{{ url('css/front_css/jquery.exzoom.css') }}" rel="stylesheet"/>
<style>
	/*#exzoom{
		position: absolute;
		top: 50%;
		left: 25%;
		transform: translate(-50%,-50%);
		width: 400px;
	}*/
</style>
@endsection
@section('content')
<div class="span9">
	<ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li><a href="{{ url('/'.$productDetails['category']['url']) }}">{{ $productDetails['category']['category_name'] }}</a> <span class="divider">/</span></li>
		<li class="active">{{ $productDetails['product_name'] }}</li>
	</ul>

	<div class="row">
		<div class="span3">
			<div class="exzoom" id="exzoom">
			<!-- Images -->
			<div class="exzoom_img_box">
				<ul class='exzoom_img_ul'>
					<li><img src="{{ asset('images/product_images/small/'.$productDetails['main_image']) }}"/></li>
					@foreach($productDetails['images'] as $image)
						<li><img src="{{ asset('images/product_images/small/'.$image['image']) }}"/></li>
					@endforeach
				</ul>
			</div>
			<!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
			<div class="exzoom_nav"></div>
			<!-- Nav Buttons -->
			<p class="exzoom_btn">
				<a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
				<a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
			</p>
		</div>
			<!-- <a href="{{ asset('images/product_images/large/'.$productDetails['main_image']) }}" title="Blue Casual T-Shirt">
				<img src="{{ asset('images/product_images/small/'.$productDetails['main_image']) }}" style="width:100%" alt="Blue Casual T-Shirt"/>
			</a>
			<div id="differentview" class="moreOptopm carousel slide">
				<div class="carousel-inner">
					<div class="item active">
						@foreach($productDetails['images'] as $image)
						<a href="{{ asset('images/product_images/large/'.$image['image']) }}"> <img style="width:29%" src="{{ asset('images/product_images/small/'.$image['image']) }}" alt=""/></a>
						@endforeach
					</div>
				</div>


			</div>

			<div class="btn-toolbar">
				<div class="btn-group">


					<span class="btn"><i class="fa fa-envelope" aria-hidden="true"></i></span>
					<span class="btn"><i class="fa fa-print" aria-hidden="true"></i></span>

					<span class="btn"><i class="fa fa-search-plus" aria-hidden="true"></i></span>
					<span class="btn"><i class="fa fa-star" aria-hidden="true"></i></span>
					<span class="btn"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
					<span class="btn"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
				</div>
			</div> -->
		</div>

		<div class="span6">
			@if(Session::has('success_message'))
			<div class="alert alert-success" role="alert">
				{{ Session::get('success_message') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@if(Session::has('error_message'))
			<div class="alert alert-danger" role="alert">
				{{ Session::get('error_message') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			<h3>{{ $productDetails['product_name'] }}</h3>
			<small>- {{ $productDetails['brand']['name'] }}</small>
			<hr class="soft"/>
			<small>{{ $total_stock }} items in stock</small>
			<form action="{{ url('add-to-cart') }}" method="post" class="form-horizontal qtyFrm">@csrf
				<input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
				<div class="control-group">
					<?php $discounted_price = Product::getDiscountedPrice($productDetails['id']); ?>
					<h4 class="getAttrPrice">
						@if($discounted_price > 0)
						<del style="color:red" class="dell">Tk.{{ $productDetails['product_price'] }}</del> - <b class="bb" style="color:blue">(Tk.{{ $discounted_price }})</b>
						@else
						Tk.{{ $productDetails['product_price'] }}
						@endif
					</h4>
					<select name="size" id="getPrice" product-id="{{ $productDetails['id'] }}" class="span2 pull-left" required="">
						<option value="">Select Size</option>
						@foreach($productDetails['attributes'] as $attribute)
						<option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
						@endforeach
					</select>
					<input name="quantity" type="number" class="span1" placeholder="Qty." required="" />
					<button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
				</div>
			</div>
		</form>

		<hr class="soft clr"/>
		<p class="span6">
			{{ $productDetails['description'] }}
		</p>
		<a class="btn btn-small pull-right" href="#detail">More Details</a>
		<br class="clr"/>
		<a href="#" name="detail"></a>
		<hr class="soft"/>
	</div>

	<div class="span9">
		<ul id="productDetail" class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
			<li><a href="#profile" data-toggle="tab">Related Products</a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade active in" id="home">
				<h4>Product Information</h4>
				<table class="table table-bordered">
					<tbody>
						<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
						<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{ $productDetails['brand']['name'] }}</td></tr>
						<tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{ $productDetails['product_code'] }}</td></tr>
						<tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{ $productDetails['product_color'] }}</td></tr>
						@if($productDetails['fabric'])
						<tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{ $productDetails['fabric'] }}</td></tr>
						@endif
						@if($productDetails['pattern'])
						<tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{ $productDetails['pattern'] }}</td></tr>
						@endif
						@if($productDetails['sleeve'])
						<tr class="techSpecRow"><td class="techSpecTD1">Sleeve:</td><td class="techSpecTD2">{{ $productDetails['sleeve'] }}</td></tr>
						@endif
						@if($productDetails['fit'])
						<tr class="techSpecRow"><td class="techSpecTD1">Fit:</td><td class="techSpecTD2">{{ $productDetails['fit'] }}</td></tr>
						@endif
						@if($productDetails['occasion'])
						<tr class="techSpecRow"><td class="techSpecTD1">Occasion:</td><td class="techSpecTD2">{{ $productDetails['occasion'] }}</td></tr>
						@endif
					</tbody>
				</table>

				<h5>Washcare</h5>
				<p>{{ $productDetails['wash_care'] }}</p>
				<h5>Disclaimer</h5>
				<p>
					There may be a slight color variation between the image shown and original product.
				</p>
			</div>
			<div class="tab-pane fade" id="profile">
				<div id="myTab" class="pull-right">
					<a href="#listView" id="listview" data-toggle="tab" class="switcher btn btn-large"><i class="fa fa-list" aria-hidden="true"></i></a>
					<a class="switcher btn btn-large btn-primary active" href="#blockView" id="gridview" data-toggle="tab"><i class="fa fa-th-large" aria-hidden="true"></i></a>
				</div>
				<br class="clr"/>
				<hr class="soft"/>
				<div class="tab-content">
					<div class="tab-pane" id="listView">
						@foreach($relatedProducts as $product)
						<div class="row">
							<div class="span2">
								<a href="{{ url('product/'.$product['id']) }}">@if(isset($product['main_image']))
									<?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
									@else
									<?php $product_image_path = ''; ?>
									@endif
									<?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
									@if(!empty($product['main_image']) && file_exists($product_image_path))
									<img src="{{ asset($product_image_path) }}" alt="">
									@else
									<img src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
								@endif</a>
							</div>
							<div class="span4">
								<a href="{{ url('product/'.$product['id']) }}"><h3>{{ $product['product_name'] }}</h3></a>
								<hr class="soft"/>
								<h5>{{ $product['product_code'] }}</h5>
								<p>
									{{ $product['description'] }}
								</p>
								<a class="btn btn-small pull-right" href="{{ url('product/'.$product['id']) }}">View Details</a>
								<br class="clr"/>
							</div>
							<div class="span3 alignR">
								<form class="form-horizontal qtyFrm">
									<h3> Tk.{{ $product['product_price'] }}</h3>
									<label class="checkbox">
										<input type="checkbox">  Adds product to compair
									</label><br/>
									<div class="btn-group">
										<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
										<a href="product_details.html" class="btn btn-large"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
									</div>
								</form>
							</div>
						</div>
						<hr class="soft"/>
						@endforeach
					</div>
					<div class="tab-pane active" id="blockView">
						<ul class="thumbnails">
							@foreach($relatedProducts as $product)
							<li class="span3">
								<div class="thumbnail">
									<a href="{{ url('product/'.$product['id']) }}">@if(isset($product['main_image']))
										<?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
										@else
										<?php $product_image_path = ''; ?>
										@endif
										<?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
										@if(!empty($product['main_image']) && file_exists($product_image_path))
										<img src="{{ asset($product_image_path) }}" alt="">
										@else
										<img src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
									@endif</a>
									<div class="caption">
										<a href="{{ url('product/'.$product['id']) }}"><h5>{{ $product['product_name'] }}</h5></a>
										<p>
											{{ $product['product_code'] }}
										</p>
										<h4 style="text-align:center"><a class="btn" href="{{ url('product/'.$product['id']) }}"> <i class="fa fa-search-plus" aria-hidden="true"></i></a> <a class="btn" href="#">Add to <i class="fa fa-shopping-cart" aria-hidden="true"></i></a> <a class="btn btn-primary" href="#">Tk.{{ $product['product_price'] }}</a></h4>
									</div>
								</div>
							</li>
							@endforeach
						</ul>
						<hr class="soft"/>
					</div>
				</div>
				<br class="clr">
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('script')
<script src="{{ url('js/front_js/jquery.exzoom.js') }}"></script>
<script type="text/javascript">
	$(function(){

	  $("#exzoom").exzoom({
	    // options here
	  });

	});
</script>
@endsection