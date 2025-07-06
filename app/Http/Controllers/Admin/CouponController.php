<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Coupon;
use App\Section;
use App\User;
use Session;

class CouponController extends Controller
{
    public function coupons(){
        Session::put('page','coupons');
        $coupons = Coupon::get()->toArray();
        return view('admin.coupons.coupons')->with(compact('coupons'));
    }

    public function updateCouponStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=='Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Coupon::where('id',$data['coupon_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'coupon_id'=>$data['coupon_id']]);
        }
    }

    public function addEditCoupon(Request $request,$id=null){
        if($id==""){
            $coupon = new Coupon;
            $selCats = array();
            $selUsers = array();
            $title = "Add Coupon";
            $message = "Coupon added successfully!";
        }else{
            $coupon = Coupon::find($id);
            $selCats = explode(',',$coupon['categories']);
            $selUsers = explode(',',$coupon['users']);
            $title = "Edit Coupon";
            $message = "Coupon updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'categories' => 'required',
                'coupon_option' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'required|numeric',
                'expiry_date' => 'required'
            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'coupon_option.required' => 'Coupon option is required',
                'coupon_type.required' => 'Coupon type is required',
                'amount_type.required' => 'Amount type is required',
                'amount.required' => 'Amount is required',
                'amount.nemeric' => 'Enter valid amount',
                'expiry_date.required' => 'Expiry date is required'
            ];
            $this->validate($request,$rules,$customMessages);
            // echo "<pre>"; print_r($data); die;
            if(isset($data['users'])){
                $users = implode(',', $data['users']);
            }else{
                $users = "";
            }
            if(isset($data['categories'])){
                $categories = implode(',', $data['categories']);
            }
            if($data['coupon_option']=="Automatic"){
                $coupon_code = Str::random(8);
            }else{
                $coupon_code = $data['coupon_code'];
            }
            // echo $coupon_code; die;
            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories = $categories;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = 1;
            $coupon->save();
            session::flash('success_message',$message);
            return redirect('admin/coupons');
        }

        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories),true);
        $users = User::select('email')->where('status',1)->get()->toArray();

        return view('admin.coupons.add_edit_coupon')->with(compact('title','coupon','categories','users','selCats','selUsers'));
    }

    public function deleteCoupon($id){
        Coupon::where('id',$id)->delete();
        $message = 'Coupon has been deleted successfully!';
        Session::flash('success_message',$message);
        return redirect()->back();
    }
}
