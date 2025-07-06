<?php use App\Product; ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Product</th>
			<th colspan="2">Description</th>
			<th>Quantity/Update</th>
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
			<td>
				<div class="input-append">
					<input class="span1" style="max-width:34px" value="{{ $item['quantity'] }}" id="appendedInputButtons" size="16" type="text">
					<button class="btn btnItemUpdate qtyMinus" type="button" data-cartid="{{ $item['id'] }}"><i class="fa fa-minus" aria-hidden="true"></i></button>
					<button class="btn btnItemUpdate qtyPlus" type="button" data-cartid="{{ $item['id'] }}"><i class="fa fa-plus" aria-hidden="true"></i></button>
					<button class="btn btn-danger btnItemDelete" type="button" data-cartid="{{ $item['id'] }}"><i class="fa fa-times" aria-hidden="true"></i></button>				
				</div>
			</td>
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
			<td class="label label-important final_amount" style="display:block"> <strong> Tk.{{ $total_price }} </strong></td>
		</tr>
	</tbody>
</table>