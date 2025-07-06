@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
	<ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> THANKS</li>
	</ul>
	<h3>  THANKS</h3>	
	<hr class="soft"/>
	
	<div align="center">
		<h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY</h3>
		<p>Your order number is {{ Session::get('order_id') }} and grand total is Tk {{ Session::get('total_price') }}</p>
	</div>

</div>
@endsection

<?php
Session::forget('total_price');
Session::forget('order_id');
?>