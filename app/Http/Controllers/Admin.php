<?php

namespace App\Http\Controllers;

use App\Models\OrderDetailModel;
use App\Models\OrderItems;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Admin extends Controller
{
    public function admin_dashboard(){
        $count_user = User::all()->count();
        $count_product = ProductModel::all()->count();
        $count_order = OrderDetailModel::all()->count();
        $last_moth = idate("m") - 1;
        $month = idate("m");
        $order_paid = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', $month)->get();
        $order_paid_last_month = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', $last_moth)->get();
        $order_paid_month_1 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 1)->get();
        $order_paid_month_2 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 2)->get();
        $order_paid_month_3 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 3)->get();
        $order_paid_month_4 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 4)->get();
        $order_paid_month_5 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 5)->get();
        $order_paid_month_6 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 6)->get();
        $order_paid_month_7 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 7)->get();
        $order_paid_month_8 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 8)->get();
        $order_paid_month_9 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 9)->get();
        $order_paid_month_10 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 10)->get();
        $order_paid_month_11 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 11)->get();
        $order_paid_month_12 = OrderDetailModel::where('status', 'paid')->whereMonth('created_at', '=', 12)->get();
        $total_this_month = 0;
        $total_last_month = 0;
        $total_month_1 = 0;
        $total_month_2 = 0;
        $total_month_3 = 0;
        $total_month_4 = 0;
        $total_month_5 = 0;
        $total_month_6 = 0;
        $total_month_7 = 0;
        $total_month_8 = 0;
        $total_month_9 = 0;
        $total_month_10 = 0;
        $total_month_11 = 0;
        $total_month_12 = 0;
        
        $percent = 0;
        foreach($order_paid as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_this_month = $total_this_month + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_last_month as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_last_month = $total_last_month + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_1 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_1 = $total_month_1 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_2 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_2 = $total_month_2 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_3 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_3 = $total_month_3 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_4 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_4 = $total_month_4 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_5 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_5 = $total_month_5 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_6 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_6 = $total_month_6 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_7 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_7 = $total_month_7 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_8 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_8 = $total_month_8 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_9 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_9 = $total_month_9 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_10 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_10 = $total_month_10 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_11 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_11 = $total_month_11 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        foreach($order_paid_month_12 as $item){
            $order_item_price_paid = OrderItems::where('order_id', $item->id)->get();
            foreach($order_item_price_paid as $item_paid){
                $total_month_12 = $total_month_12 + ($item_paid->product_quantity * $item_paid->product->sale_price);
            }
        }

        if($total_last_month > 0){
            $percent = ($total_this_month - $total_last_month) / $total_last_month * 100;
        }

        $admin = User::where('role', 'admin')->get()->count();
        $user = User::where('role', 'customer')->get()->count();
        $paid = OrderDetailModel::where('status', 'paid')->get()->count();
        $cancel = OrderDetailModel::where('status', 'cancel')->get()->count();
        
        return view('admin.dashboard')->with('count_user', $count_user)->with('count_product', $count_product)->with('count_order', $count_order)->with('total_this_month', $total_this_month)->with('percent', $percent)->with('total_last_month', $total_last_month)->with('admin', $admin)->with('user', $user)->with('paid', $paid)->with('cancel', $cancel)->with('total_month_1', $total_month_1)->with('total_month_2', $total_month_2)->with('total_month_3', $total_month_3)->with('total_month_4', $total_month_4)->with('total_month_5', $total_month_5)->with('total_month_6', $total_month_6)->with('total_month_7', $total_month_7)->with('total_month_8', $total_month_8)->with('total_month_9', $total_month_9)->with('total_month_10', $total_month_10)->with('total_month_11', $total_month_11)->with('total_month_12', $total_month_12);
    }

    public function admin_login(){
        // if(session('cart_url')){
        //     Session::forget('cart_url');
        // }
        if(Auth::check() && Auth::user()->role == 'admin'){
            
            return redirect()->back();
        }
        return view('admin.admin_login');
    }

    public function admin_login_action(Request $request){
        // $validator = Validator::make($request->all(), [
        //     "admin_email" => "required",
        //     "admin_password" => "required",
            
        // ], [
        //     "admin_email.required" => "(* Vui lòng nhập email)",
        //     "admin_password.required" => "(* Vui lòng nhập password)",
        // ]);
        
        // $admin_email = $request->admin_email;
        // $admin_password = $request->admin_password;

        // $result = User::where('email', $admin_email)->where('password', $admin_password)->first();
        
        //     return dd($result);
        //     // return view('admin.admin_login');
        // }
        // else{
        //     return redirect()->back()->with('errors', 'Tài khoản mật khẩu không chính xác, vui lòng đăng nhập lại');
        // }

        //  if(Auth::attempt(['email' => $request->admin_email, 'password' => $request->admin_password])){
        //     $request->session()->regenerate();
        //     return redirect('/admin/dashboard');
        //  }
        // if(session('cart_url')){
        //     Session::forget('cart_url');
        // }

        $credentials = [
            'email' => $request['admin_email'],
            'password' => $request['admin_password'],
        ];

        // dd($credentials);

        if (Auth::attempt($credentials) && Auth::user()->role == 'admin') {
            // $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }
    
        // Dump data
        // dd($credentials);

        //  dd(Auth::attempt(['email' => $request->admin_email, 'password' => $request->admin_password]));
         return redirect('/admin/login')->with('errors', 'Tài khoản hoặc mật khẩu không đúng, vui lòng nhập lại');
    }

    public function admin_logout(Request $request){
        // if(session('cart_url')){
        //     Session::forget('cart_url');
        // }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
