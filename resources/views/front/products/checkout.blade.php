<?php use App\Product; ?>
@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
	<ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> CHECKOUT</li>
	</ul>
	<h3>  CHECKOUT [ <small><span class="totalCartItems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{ url('/cart') }}" class="btn btn-large pull-right"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Cart </a></h3>	
	<hr class="soft"/>
	@if(Session::has('success_message'))
	<div class="alert alert-success" role="alert">
		{{ Session::get('success_message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<?php Session::forget('success_message'); ?>
	</div>
	@endif
	@if(Session::has('error_message'))
	<div class="alert alert-danger" role="alert">
		{{ Session::get('error_message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<?php Session::forget('error_message'); ?>
	</div>
	@endif

	<form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">@csrf
		<table class="table table-bordered">
			<tr><td> <strong>DELIVERY ADDRESSES</strong> | <a class="btn" href="{{ url('add-edit-delivery-address') }}">Add</a> </td></tr>
			@foreach($deliveryAddresses as $address)
			<tr> 
				<td>
					<div class="control-group" style="float: left; margin-top: -2px; margin-right: 5px;">
						<input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}">
					</div>
					<div class="control-group">
						<label class="control-label">{{ $address['name'] }}, {{ $address['address'] }}, {{ $address['city'] }}, {{ $address['state'] }}, {{ $address['country'] }}</label>
					</div>
				</td>
				<td><a href="{{ url('/add-edit-delivery-address/'.$address['id']) }}">Edit</a> | <a href="{{ url('/delete-delivery-address/'.$address['id']) }}">Delete</a></td>
			</tr>
			@endforeach
		</table>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Product</th>
					<th colspan="2">Description</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Discount</th>
					<th>Sub Total</th>
				</tr>
			</thead>
			<tbody>
				<?php $total_price=0; ?>
				@foreach($userCartItems as $item)
				<?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>
				<tr>
					<td> <img width="60" src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt=""/></td>
					<td colspan="2">
						{{ $item['product']['product_name'] }} ({{ $item['product']['product_code'] }})<br/>
						Color : {{ $item['product']['product_color'] }}<br/>
						Size : {{ $item['size'] }}
					</td>
					<td>{{ $item['quantity'] }}</td>
					<td>Tk.{{ $attrPrice['product_price'] }}</td>
					<td>Tk.{{ $attrPrice['discount'] }}</td>
					<td>Tk.{{ $attrPrice['final_price'] * $item['quantity'] }}</td>
				</tr>
				<?php $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']); ?>
				@endforeach

				<tr>
					<td colspan="6" style="text-align:right">Sub Total:	</td>
					<td> Tk.{{ $total_price }}</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:right">Coupon Discount:	</td>
					<td class="couponDiscount">

					</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:right"><strong>GRAND TOTAL (Tk.{{ $total_price }} - <span class="cpndis">Tk.0</span>) =</strong></td>
					<td class="label label-important final_amount" style="display:block"> <strong class="grand_total"> Tk.{{ $total_price }} <?php Session::put('total_price',$total_price); ?> </strong></td>
				</tr>
			</tbody>
		</table>
		
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td> 
						<form id="ApplyCoupon" method="post" action="javascript:void(0)" class="form-horizontal" @if(Auth::check()) user="1" @endif>@csrf
							<div class="control-group">
								<label class="control-label"><strong> PAYMENT GATEWAY: </strong> </label>
								<div class="controls">
									<div>
										<input type="radio" name="payment_gateway" id="COD" value="COD">&nbsp;<b style="position: relative; top:3px;">COD</b>
										<input type="radio" name="payment_gateway" id="Paypal" value="Paypal">&nbsp;<b style="position: relative; top:3px;"> Paypal</b>
									</div>
								</div>
							</div>
						</form>
					</td>
				</tr>
				
			</tbody>
		</table>
		
		<a href="{{ url('/cart') }}" class="btn btn-large"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Cart </a>
		<button type="submit" class="btn btn-large pull-right">Place Order <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
	</form>
	
</div>
@endsection