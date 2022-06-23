<?php

namespace App\Http\Controllers;

use App\Enum\CartStatus;
use App\Enum\OrderStatus;
use App\Models\CartModel;
use App\Models\OrderDetailModel;
use App\Models\OrderItems;
use App\Models\ProductModel;
use App\Models\UserVariantModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Cart extends Controller
{
    public function add_to_cart(Request $request)
    {
        // $product_id = $request->product_id_hidden;
        if(Auth::check() && Auth::user()->role == 'customer'){
            if(CartModel::where('user_id', Auth::id())->where('product_id', $request->proId)->where('product_size', $request->size)->where('status', 'defaults')->exists()){
                $result = CartModel::where('user_id', Auth::id())->where('product_id', $request->proId)->first();
                $quantity = $result->product_quantity;
                CartModel::where('user_id', Auth::id())->where('product_id', $request->proId)->where('product_size', $request->size)->update([
                    'product_quantity' => $quantity + $request->quantity,
                ]);
                return response()->json(['status' => 'Added To Cart']);
            }
            else{
                CartModel::create([
                    'user_id' => Auth::id(),
                    'product_id' =>  $request->proId,
                    'product_quantity' => $request->quantity,
                    'product_size' => $request->size,
                    'status' => CartStatus::Default,
                ]);
                Session::forget('cart_url');
                return response()->json(['status' => 'Added To Cart']);
            }
        }
        else{
            return response()->json(['status'=>"Login to Continue","redirect_url"=>url('/login')]);
        }
    }

    public function delete_cart_item($cart_id){
        CartModel::where('id', $cart_id)->delete();
        return response()->json(['status' => 'Xóa sản phẩm trong giỏ hàng thành công']);
    }

    public function update_cart_item_quantity($cart_id){
        $cart_quantity = CartModel::where('id', $cart_id)->first()->product_quantity;
        CartModel::where('id', $cart_id)->update([
            'product_quantity' => $cart_quantity + 1,
        ]);
        return response()->json(['status' => 'Cập nhật số lượng sản phẩm trong giỏ hàng thành công']);

    }

    public function update_desc_cart_item_quantity($cart_id){
        $cart_quantity = CartModel::where('id', $cart_id)->first()->product_quantity;
        CartModel::where('id', $cart_id)->update([
            'product_quantity' => $cart_quantity - 1,
        ]);
        return response()->json(['status' => 'Cập nhật số lượng sản phẩm trong giỏ hàng thành công']);
    }

    public function update_cart_item_size(Request $request, $cart_id){
        $cart = CartModel::where('id', $cart_id)->first();
        $cart_quantity = $cart->product_quantity;
        if(CartModel::where('user_id', $request->userID)->where('product_id', $request->proID)->where('product_size', $request->newSize)->exists()){
            $item = CartModel::where('user_id', $request->userID)->where('product_id', $request->proID)->where('product_size', $request->newSize)->first()->product_quantity;
            CartModel::where('user_id', $request->userID)->where('product_id', $request->proID)->where('product_size', $request->newSize)->update([
                'product_quantity'  => $cart_quantity  + $item,
            ]);
            CartModel::where('id', $cart_id)->delete();
        }
        else{
            CartModel::where('id', $cart_id)->update([
                'product_size' => $request->newSize,
            ]);
        }
    }

    public function cart_checkout(){
        $user_id = Auth::id();
        $all_cart = CartModel::where('user_id', Auth::id())->where('status', 'defaults')->get();
        $cart_of_user_id = CartModel::where('user_id', $user_id)->where('status', 'defaults')->get();
        $ward = DB::table('dc_xaphuong')->get();
        $district = DB::table('dc_quanhuyen')->get();
        $city = DB::table('dc_thanhpho')->get();
        return view('pages.cart_checkout', ['hasCart' => CartModel::where('user_id', Auth::id())->where('status', 'defaults')->exists()])->with('cart_of_user_id', $cart_of_user_id)->with('all_cart', $all_cart)->with('ward', $ward)->with('district', $district)->with('city', $city);
    }

    public function select_district(Request $request){
        $thanhpho = $request->thanhPhoId;
        $result = DB::table('dc_quanhuyen')->where('tpid', $thanhpho)->get();
        return response()->json($result);
    }

    public function select_ward(Request $request){
        $quanhuyen = $request->districtId;
        $result = DB::table('dc_xaphuong')->where('qhid', $quanhuyen)->get();
        return response()->json($result);
    }

    public function cart_payment(Request $request){
        $validator = Validator::make($request->all(), [
            "user_cart_phone" => "required",
            "user_cart_address" => "required",
            "user_cart_ward" => "required",
            "user_cart_district" => "required",
            "user_cart_country" => "required",
        ], [
            "user_cart_phone.required" => "(* Vui lòng nhập số điện thoại)",
            "user_cart_address.required" => "(* Vui lòng nhập địa chỉ)",
            "user_cart_ward.required" => "(* Vui lòng nhập phường hiện tại",
            "user_cart_district.required" => "(* Vui lòng nhập quận hiện tại)",
            "user_cart_country.required" => "(* Vui lòng, nhập tỉnh thành hoặc thành phố)",
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput()->with('error_message', 'Có lỗi khi thanh toán, vui lòng nhập thông tin');/*->status(400)*/;
        }

        // UserVariantModel::create([
        //     'user_id' => Auth::id(),
        //     'phone_number' => $request->user_cart_phone,
        //     'address' => $request->user_cart_address,
        //     'ward' => $request->user_cart_ward,
        //     'district' => $request->user_cart_district,
        //     'country' => $request->user_cart_country
        // ]);



        $order = new OrderDetailModel();
        $order->user_id = Auth::id();
        $order->phone_number = $request->user_cart_phone;
        $order->address = $request->user_cart_address;
        $order->ward = $request->user_cart_ward;
        $order->district = DB::table('dc_quanhuyen')->where('id',$request->user_cart_district)->first()->name_quanhuyen;
        $order->country = DB::table('dc_thanhpho')->where('id',$request->user_cart_country)->first()->name_thanhpho;
        $order->save();
            // 'status' => OrderStatus::Progressing,
        

        $cart_items = CartModel::where('user_id', Auth::id())->where('status', 'defaults')->get();
        foreach($cart_items as $item){
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_size' => $item->product_size,
                'product_quantity' => $item->product_quantity,
                'status' => OrderStatus::Progressing,
            ]);
        };

        CartModel::where('user_id', Auth::id())->where('status', 'defaults')->update([
            'status' => CartStatus::Progressing,
        ]);


        return redirect('/');
    }
}
