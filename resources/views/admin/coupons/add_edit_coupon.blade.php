@extends('layouts.admin_layout.admin_layout');
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Catalogues</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Coupon</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			@if ($errors->any())
			<div class="alert alert-danger" style="margin-top: 10px;">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(Session::has('success_message'))
			<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
				{{ Session::get('success_message') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			<form name="couponForm" id="couponForm" @if(empty($coupondata['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/'.$coupondata['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
				<div class="card card-default">
					<div class="card-header">
						<h3 class="card-title">{{ $title }}</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">

						<div class="row">
							<div class="col-12 col-sm-6">
								@if(empty($coupon['coupon_code']))
								<div class="form-group">
									<label for="coupon_option">Coupon Option</label><br>
									<span><input id="AutomaticCoupon" type="radio" name="coupon_option" value="Automatic">&nbsp;Automatic</span>&nbsp;&nbsp;
									<span><input id="ManualCoupon" type="radio" name="coupon_option" value="Manual">&nbsp;Manual</span>&nbsp;&nbsp;
								</div>

								<div class="form-group" style="display: none;" id="couponField">
									<label for="coupon_code">Coupon Code</label>
									<input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Enter Coupon Code">
								</div>
								@else
								<div class="form-group">
									<input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
									<input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">
									<label for="coupon_code">Coupon Code: </label>
									<span>{{ $coupon['coupon_code'] }}</span>
								</div>
								@endif
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="categories">Select Categories</label>
									<select name="categories[]" id="categorie" multiple="" class="form-control select2" style="width: 100%;">
										<option value="">Select</option>
										@foreach($categories as $section)
										<optgroup label="{{ $section['name'] }}"></optgroup>
										@foreach($section['categories'] as $category)
										<option value="{{ $category['id'] }}" @if(in_array($category['id'],$selCats)) selected="" @endif>&nbsp;&nbsp;&nbsp;--{{ $category['category_name'] }}</option>
										@foreach($category['subcategories'] as $subcategory)
										<option value="{{ $subcategory['id'] }}" @if(in_array($subcategory['id'],$selCats)) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--{{ $subcategory['category_name'] }}</option>
										@endforeach
										@endforeach
										@endforeach
									</select>
								</div>

								<div class="form-group">
									<label for="users">Select Users</label>
									<select name="users[]" multiple="" class="form-control select2" style="width: 100%;">
										<option value="">Select</option>
										@foreach($users as $user)
											<option value="{{ $user['email'] }}" @if(in_array($user['email'],$selUsers)) selected="" @endif>{{ $user['email'] }}</option>
										@endforeach
									</select>
								</div>

							</div>

							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="coupon_type">Coupon Type</label><br>
									<span><input type="radio" name="coupon_type" value="Multiple Times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Multiple Times") checked="" @endif>&nbsp;Multiple Times</span>&nbsp;&nbsp;
									<span><input type="radio" name="coupon_type" value="Single Times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Single Times") checked="" @endif>&nbsp;Single Times</span>&nbsp;&nbsp;
								</div>

								<div class="form-group">
									<label for="amount_type">Amount Type</label><br>
									<span><input type="radio" name="amount_type" value="Percentage" @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Percentage") checked="" @endif>&nbsp;Percentage</span>&nbsp;(in %)&nbsp;
									<span><input type="radio" name="amount_type" value="Fixed" @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Fixed") checked="" @endif>&nbsp;Fixed</span>&nbsp;(in Tk)&nbsp;
								</div>

							</div>

							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="expiry_date">Expiry Date</label><br>
									<input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="Enter Expiry Date" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask @if(isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @endif>
								</div>

								<div class="form-group">
									<label for="amount">Amount</label><br>
									<input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount" @if(isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @endif>
								</div>

							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</section>
	<!-- /.content -->
</div>

@endsection