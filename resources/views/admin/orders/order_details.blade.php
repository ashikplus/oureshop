<?php use App\Product; ?>
@extends('layouts.admin_layout.admin_layout');
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
          {{ Session::get('success_message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{ Session::forget('success_message') }}
        @endif
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1>Catelogues</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Order #{{ $orderDetails['id'] }} Detail</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>Order Date</td>
                    <td>{{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}</td>
                  </tr>
                  <tr>
                    <td>Order Status</td>
                    <td>{{ $orderDetails['order_status'] }}</td>
                  </tr>
                  <tr>
                    <td>Order Total</td>
                    <td>{{ $orderDetails['grand_total'] }}</td>
                  </tr>
                  <tr>
                    <td>Shipping Charges</td>
                    <td>Tk. {{ $orderDetails['shipping_charges'] }}</td>
                  </tr>
                  <tr>
                    <td>Coupon Code</td>
                    <td>{{ $orderDetails['coupon_code'] }}</td>
                  </tr>
                  <tr>
                    <td>Coupon Amount</td>
                    <td>{{ $orderDetails['coupon_amount'] }}</td>
                  </tr>
                  <tr>
                    <td>Payment Method</td>
                    <td>{{ $orderDetails['payment_method'] }}</td>
                  </tr>
                  <tr>
                    <td>Payment Gateway</td>
                    <td>{{ $orderDetails['payment_gateway'] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Delivery Address</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-sm">
                <tbody>
                  <tr>
                    <td>Name</td>
                    <td>{{ $orderDetails['name'] }}</td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td>{{ $orderDetails['address'] }}</td>
                  </tr>
                  <tr>
                    <td>City</td>
                    <td>{{ $orderDetails['city'] }}</td>
                  </tr>
                  <tr>
                    <td>State</td>
                    <td>{{ $orderDetails['state'] }}</td>
                  </tr>
                  <tr>
                    <td>Country</td>
                    <td>{{ $orderDetails['country'] }}</td>
                  </tr>
                  <tr>
                    <td>Pincode</td>
                    <td>{{ $orderDetails['pincode'] }}</td>
                  </tr>
                  <tr>
                    <td>Mobile</td>
                    <td>{{ $orderDetails['mobile'] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Customer Details</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-sm">
                <tbody>
                  <tr>
                    <td>Name</td>
                    <td>{{ $userDetails['name'] }}</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>{{ $userDetails['email'] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Billing Address</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-sm">
                <tbody>
                  <tr>
                    <td>Name</td>
                    <td>{{ $userDetails['name'] }}</td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td>{{ $userDetails['address'] }}</td>
                  </tr>
                  <tr>
                    <td>City</td>
                    <td>{{ $userDetails['city'] }}</td>
                  </tr>
                  <tr>
                    <td>State</td>
                    <td>{{ $userDetails['state'] }}</td>
                  </tr>
                  <tr>
                    <td>Country</td>
                    <td>{{ $userDetails['country'] }}</td>
                  </tr>
                  <tr>
                    <td>Pincode</td>
                    <td>{{ $userDetails['pincode'] }}</td>
                  </tr>
                  <tr>
                    <td>Mobile</td>
                    <td>{{ $userDetails['mobile'] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Update Order Status</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-sm">
                <tbody>
                  <tr>
                    <td colspan="2">
                      <form action="{{ url('admin/update-order-status') }}" method="post">@csrf
                        <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                        <select name="order_status" id="order_status" required="">
                          <option>Select</option>
                          @foreach($orderStatuses as $status)
                          <option value="{{ $status['name'] }}" @if(isset($orderDetails['order_status']) && $orderDetails['order_status']==$status['name']) selected="" @endif>{{ $status['name'] }}</option>
                          @endforeach
                        </select>&nbsp;&nbsp;
                        <input type="text" name="courier_name" placeholder="Courier Name" style="width:120px;" @if(empty($orderDetails['courier_name'])) id="courier_name" @endif value="{{ $orderDetails['courier_name'] }}">
                        <input type="text" name="tracking_number" placeholder="Tracking Number" style="width:120px;" @if(empty($orderDetails['tracking_number'])) id="tracking_number" @endif value="{{ $orderDetails['tracking_number'] }}">
                        <button type="submit">Update</button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ordered Products</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Product Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Size</th>
                    <th>Product Color</th>
                    <th>Product Qty</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orderDetails['orders_products'] as $product)
                  <tr>
                    <td>
                      <?php $getProductImage = Product::getProductImage($product['product_id']) ?>
                      <a target="_blank" href="{{ url('product/'.$product['product_id']) }}"><img style="width:80px;" src="{{ asset('images/product_images/small/'.$getProductImage) }}"></a>
                    </td>
                    <td>{{ $product['product_code'] }}</td>
                    <td>{{ $product['product_name'] }}</td>
                    <td>{{ $product['product_size'] }}</td>
                    <td>{{ $product['product_color'] }}</td>
                    <td>{{ $product['product_qty'] }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection