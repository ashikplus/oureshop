@extends('layouts.front_layout.front_layout')
@section('css')
<style>
form.cmxform label.error, label.error {
	color: #a94442;
	background-color: #f2dede;
	border-color: #ebccd1;
	padding:1px 20px 1px 20px;
}
</style>
@endsection
@section('content')
<div class="span9">
	<ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Orders</li>
	</ul>
	<h3>Orders</h3>	
	<hr class="soft"/>

	<div class="row">
		<div class="span8">
			<table class="table table-bordered table-striped">
				<tr>
					<th>Order ID</th>
					<th>Order Products</th>
					<th>Payment Method</th>
					<th>Grand Total</th>
					<th>Created on</th>
					<th>Details</th>
				</tr>
				@foreach($orders as $order)
					<tr>
						<td><a href="{{ url('orders/'.$order['id']) }}">{{ $order['id'] }}</a></td>
						<td>
							@foreach($order['orders_products'] as $pro)
								{{ $pro['product_code'] }}<br>
							@endforeach
						</td>
						<td>{{ $order['payment_method'] }}</td>
						<td>Tk. {{ $order['grand_total'] }}</td>
						<td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
						<td><a href="{{ url('orders/'.$order['id']) }}">Details</a></td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>	
	
</div>
@endsection