<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Cart;
use App\Country;
use Auth;
use Session;
use Twilio\Rest\Client;

class UsersController extends Controller
{
    public function loginRegister(){
        return view('front.users.login_register');
    }

    public function registerUser(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $userCount = User::where('email',$data['email'])->count();
            if($userCount>0){
                $message = "Email already exists!";
                session::flash('error_message',$message);
                return redirect()->back();
            }else{
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;

                // Send sms to user with twilio api
                if($user->save()){
                    $sid = config('services.twilio.sid');
                    $token = config('services.twilio.token');

                    $client = new Client($sid,$token);

                    $message = $client->messages->create(
                        '+8801821174867',array(
                            'from'=>'+14092300389',
                            'body'=>'You register your account successfully!'
                        )
                    );
                }

                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    // echo "<pre>"; print_r(Auth::user()); die;
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                    }
                    return redirect('cart');
                }
            }
        }
    }

    public function checkEmail(Request $request){
        $data = $request->all();
        $emailCount = User::where('email',$data['email'])->count();
        if($emailCount>0){
            return false;
        }else{
            return "true";
        }
    }

    public function loginUser(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                // Update User cart with user id
                if(!empty(Session::get('session_id'))){
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                }
                return redirect('/cart');
            }else{
                $message = "Invalid Username or Password";
                Session::flash('error_message',$message);
                return redirect()->back();
            }
        }
    }

    public function logoutUser(){
        Auth::logout();
        return redirect('/');
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();
        $countries = Country::where('status',1)->get()->toArray();

        if($request->isMethod('post')){
            $data = $request->all();
            Session::forget('error_message');
            Session::forget('success_message');
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric'
            ];
            $customMessages = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid Name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required'
            ];
            $this->validate($request,$rules,$customMessages);

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            $message = "Your account details has been updated successfully!";
            Session::put('success_message',$message);
            // Session::forget('error_message');
            return redirect()->back();
        }
        return view('front.users.account')->with(compact('userDetails','countries'));
    }
    
}
