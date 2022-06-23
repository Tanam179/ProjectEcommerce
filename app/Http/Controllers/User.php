<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\CartModel;
use App\Models\OrderDetailModel;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;

class User extends Controller
{
    public function register() {
        // $path = Redirect::setIntendedUrl(url()->previous());
        
        
        // session(['url.intended' => url()->previous()]);
        
        return view('customer.register');
    }

    public function register_action(Request $request){
        $validator = Validator::make($request->all(), [
            "regis_username" => "required",
            "regis_email" => "required|email|unique:users,email",
            "regis_password" => "required",
            "regis_confirm_password" => "required|same:regis_password",
            
        ], [
            "regis_username.required" => "(* Vui lòng nhập tên user)",
            "regis_email.required" => "(* Vui lòng nhập email)",
            "regis_email.unique" => "(* Email đã tồn tài)",
            "regis_password.required" => "(* Vui lòng nhập password)",
            "regis_confirm_password.required" => "(* Vui lòng nhập email)",
            "regis_confirm_password.same" => "(* Mật khẩu không khớp, hãy thử lại)",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag())->withInput()->with('error_message', 'Có lỗi khi thêm user, vui lòng thêm lại');/*->status(400)*/;
        }

        $result = ModelsUser::create([
            'name' => $request->regis_username,
            'email' => $request->regis_email,
            'password' => Hash::make($request->regis_password),
            'role' => UserRole::Customer,
        ]);
        
        return view('customer.login');
    }

    public function login() {
        if(Auth::check() && Auth::user()->role == 'customer'){
            
            return redirect('/user-information');
        }
        // $path = Redirect::setIntendedUrl(url()->previous());
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('customer.login');
    }


    public function login_action(Request $request){
        $validator = Validator::make($request->all(), [
            "customer_email" => "required|email",
            "customer_password" => "required",
        ], [
    
            "customer_email.required" => "(* Vui lòng nhập email)",
            "customer_pasword.required" => "(* Vui lòng nhập password)",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag())->withInput()->with('error_message', 'Có lỗi khi thêm user, vui lòng thêm lại');/*->status(400)*/;
        }

       

        // dd($credentials);

        if (Auth::attempt(array('email' => $request->customer_email, 'password' => $request->customer_password)) && Auth::user()->role == 'customer') {
            // $request->session()->regenerate();
            
                // if(session('cart_url')){
                //     return redirect(session('cart_url'));
                // }
                // else{
                //     return redirect()->intended('/');
                // }
            return redirect()->intended('/');
        }
        else if((Auth::attempt(array('email' => $request->customer_email, 'password' => $request->customer_password)) && Auth::user()->role == 'admin')){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
    
        // Dump data
        // dd($credentials);

        //  dd(Auth::attempt(['email' => $request->admin_email, 'password' => $request->admin_password]));
         return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng, vui lòng nhập lại');
    }

    public function login_check() {
        dd(Auth::user());
    }

    public function user_information(){
        $all_cart = CartModel::where('user_id', Auth::id())->where('status', 'defaults')->get();
        $order_progressing = OrderDetailModel::where('user_id', Auth::id())->where('status', 'progressing')->get();
        $order_progressed = OrderDetailModel::where('user_id', Auth::id())->where('status', 'progressed')->get();
        $order_paid = OrderDetailModel::where('user_id', Auth::id())->where('status', 'paid')->get();
        return view('customer.user_information', ['hasCart' => CartModel::where('user_id', Auth::id())->where('status', 'defaults')->exists()])->with('all_cart', $all_cart)->with('order_progressing', $order_progressing)->with('order_progressed', $order_progressed)->with('order_paid', $order_paid);
    }


    public function update_avatar(Request $request, $user_id){
        // $new_img = Auth::user()->avatar;
        if($get_img = $request->avatar){
            $get_name_img = md5(rand(100, 10000));
            $new_img = $get_name_img . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('upload/avatar', $new_img);
        
            ModelsUser::where('id', $user_id)->update([
                'avatar' => $new_img,
            ]);
        }
        
        
        // $user = ModelsUser::where('id', $user_id)->first();
        
        return response()->json(['status' => 'Cập nhật hình ảnh thành công']);
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function change_password(){
        $all_cart = CartModel::where('user_id', Auth::id())->where('status', 'defaults')->get();
        // $user = ModelsUser::where('id', $user_id)->first();
        return view('customer.change_password',['hasCart' => CartModel::where('user_id', Auth::id())->where('status', 'defaults')->exists()])->with('all_cart', $all_cart);
    }

    public function change_password_action(Request $request, $user_id){
        $validator = Validator::make($request->all(), [
            "change_password" => "required",
            "change_confirm_password" => "required|same:change_password",
            
        ], [
            "change_password.required" => "(* Vui lòng nhập password)",
            "change_confirm_password.required" => "(* Vui lòng nhập mật khẩu xác thực)",
            "change_confirm_password.same" => "(* Mật khẩu không khớp, hãy thử lại)",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag())->withInput()->with('error_message', 'Có lỗi khi đổi mật khẩu user, vui lòng đổi lại')/*->status(400)*/;
        }

        else{
            ModelsUser::where('id', $user_id)->update([
                'password' => Hash::make($request->change_password),
            ]);
    
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
        // return view('pages.home');
    }

    public function reset_password(){
        return view('customer.reset_password', ['hasCart' => CartModel::where('user_id', Auth::id())->where('status', 'defaults')->exists()]);
    }

    public function send_to_email(Request $request){
        $user = ModelsUser::where('email', $request->reset_password_email)->first();
        if($user){
            $token = strtoupper(Str::random(10));
            $passwordReset = PasswordReset::updateOrCreate([
                'email' => $user->email,
            ], [
                'token' => Str::random(60),
            ]);
    
            Mail::send('email.email_forget', compact('user', 'passwordReset'), function($email) use ($user){
                $email->subject('Happy Shoes - Lấy lại thông tin mật khẩu');
                $email->to($user->email, $user->name);
            });
    
            return redirect()->back()->with('message', 'Chúng tối vừa gửi đường dẫn đổi mật khẩu vào gmail, bạn hãy kiểm tra thử');
        }
        else{
            return redirect()->back()->with('error_msg', 'Chúng tối không tìm thấy tài khoản email này, hãy thử lại');
        }
        

    }

    public function reset_password_from_gmail(Request $request){
        $user = PasswordReset::where('token', $request->query('token'))->first();
        return view('email.reset_from_email')->with('user', $user);
    }

    public function reset_password_action(Request $request){
        $validator = Validator::make($request->all(), [
            "reset_new_password" => "required",
            "reset_new_password_confirm" => "required|same:reset_new_password",
        ], [
    
            "reset_new_password.required" => "(* Vui lòng nhập mật khẩu)",
            "reset_new_password_confirm.required" => "(* Vui lòng nhập xác nhận mật khẩu)",
            "reset_new_password_confirm.same" => "(* Mật khẩu không khớp, hãy nhập lại)",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag())->withInput();/*->status(400)*/;
        }
        $user = ModelsUser::where('email', $request->user_token)->update([
            'password' => Hash::make($request->reset_new_password),
        ]);

        return redirect('/');
    }

    public function all_user(){
        $all_user = ModelsUser::all();
        // return dd($all_user->role);
        return view('admin.user.all_user')->with('all_user', $all_user);
    }

    public function authorize_admin($id){
        $user = ModelsUser::where('id', $id)->update([
            'role' => UserRole::Admin,
        ]);

        return redirect()->back()->with('message', 'Cập nhật User thành công');
    }

    public function authorize_customer($id){
        $user = ModelsUser::where('id', $id)->update([
            'role' => UserRole::Customer,
        ]);

        return redirect()->back()->with('message', 'Cập nhật User thành công');
    }

    public function delete_user($id){
        ModelsUser::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Xóa User thành công');
    }

    
}
