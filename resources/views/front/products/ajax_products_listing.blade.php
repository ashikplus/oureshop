<?php use App\Product; ?>
<div class="tab-pane  active" id="blockView">
	<ul class="thumbnails">
		@foreach($categoryProducts as $product)
		<li class="span3">
			<div class="thumbnail">
				<a href="{{ url('product/'.$product['id']) }}">
					@if(isset($product['main_image']))
					<?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
					@else
					<?php $product_image_path = ''; ?>
					@endif
					<?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
					@if(!empty($product['main_image']) && file_exists($product_image_path))
					<img src="{{ asset($product_image_path) }}" alt="">
					@else
					<img src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
					@endif
				</a>
				<div class="caption">
					<a href="{{ url('product/'.$product['id']) }}"><h5>{{ $product['product_name'] }}</h5></a>
					<p>
					<?php $discounted_price = Product::getDiscountedPrice($product['id']); ?>
					@if($discounted_price > 0)
					<del>Tk.{{ $product['product_price'] }}</del> - <b>(Tk.{{ $discounted_price }})</b>
					@else
					Tk.{{ $product['product_price'] }}
					@endif
					</p>
					<p>
						{{ $product['brand']['name'] }}
					</p>
					<h4 style="text-align:center"><a class="btn" href="{{ url('product'.$product['id']) }}"> <i class="fa fa-search-plus" aria-hidden="true"></i></a> <a class="btn" href="#">Add to <i class="fa fa-shopping-cart" aria-hidden="true"></i></a> 
						<!-- <a class="btn btn-primary" href="#">Tk.{{ $product['product_price'] }}</a> -->
					</h4>
					<!-- <p>{{ $product['fabric'] }}</p>
					<p>{{ $product['sleeve'] }}</p>
					<p>{{ $product['pattern'] }}</p>
					<p>{{ $product['fit'] }}</p>
					<p>{{ $product['occasion'] }}</p> -->
				</div>
			</div>
		</li>
		@endforeach
	</ul>
	<hr class="soft"/>
</div>