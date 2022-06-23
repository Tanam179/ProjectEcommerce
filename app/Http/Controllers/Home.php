<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\ProductModel;
use App\Models\ReplyModel;
use App\Models\SliderModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
    public function index() {
        // if(session('cart_url')){
        //     Session::forget('cart_url');
        // }
        $all_category = CategoryModel::all();
        $new_product = ProductModel::orderBy('id', 'desc')->get()->take(4);
        $product_sale = ProductModel::where('sale', 1)->get();
        $all_cart = CartModel::where('user_id', Auth::id())->where('status', 'defaults')->get();
        $all_slider = SliderModel::all();
        // $all_size = '';
        // foreach($all_cart as $cart){
        //     print($cart->product_id);
        // };
        // dd($all_size);

        return view("pages.home", ['hasCart' => CartModel::where('user_id', Auth::id())->where('status', 'defaults')->exists()])->with('product_sale', $product_sale)->with('all_category', $all_category)->with('new_product', $new_product)->with('all_cart', $all_cart)->with('all_slider', $all_slider);
    }

    public function product_all() {
        // if(session('cart_url')){
        //     Session::forget('cart_url');
        // }
        $all_product = ProductModel::all();
        return response()->json($all_product);
    }

    public function product_detail(Request $request, $product_id){
        // Session::put('cart_url', $request->fullUrl());
        $product_detail = ProductModel::where('id', $product_id)->first();
        $comment_id = $request->hidden_comment_id;
        $comment = CommentModel::where('product_id', $product_id)->orderBy('created_at', 'desc')->get();
        $reply = ReplyModel::where('comment_id', $comment_id)->get();
        $product_detail_imgs_relate = explode("|", $product_detail->img_relate);
        $product_detail_sizes = explode("|", $product_detail->size);
        $product_relate = ProductModel::where('cate_id', $product_detail->cate_id)->whereNotIn('id', [$product_detail->id])->get();
        $all_cart = CartModel::where('user_id', Auth::id())->where('status', 'defaults')->get();
        

        // dd($product_relate);
        return view("pages.product_detail", ['hasCart' => CartModel::where('user_id', Auth::id())->where('status', 'defaults')->exists()], ['hasComment' => CommentModel::where('product_id', $product_detail->id)->exists()])->with('product_detail', $product_detail)->with('product_detail_imgs_relate', $product_detail_imgs_relate)->with('product_detail_sizes', $product_detail_sizes)->with('product_relate', $product_relate)->with('all_cart', $all_cart)->with('comment', $comment)->with('reply', $reply);
    }

    public function product_by_cate($cate_id) {
        $all_product_by_cate = ProductModel::where('cate_id', $cate_id)->orderBy('id', 'desc')->get();
        $all_product_by_cate_name = CategoryModel::where('id', $cate_id)->first();
        // return dd($all_product_by_cate);
        $all_cart = CartModel::where('user_id', Auth::id())->where('status', 'defaults')->get();
        

        return view('pages.product_by_cateid', ['hasCart' => CartModel::where('user_id', Auth::id())->where('status', 'defaults')->exists()])->with('all_product_by_cate', $all_product_by_cate)->with('all_product_by_cate_name', $all_product_by_cate_name)->with('all_cart', $all_cart);
    }

    public function product_price_desc($cate_id){
        $pro_cate_desc = ProductModel::where('cate_id', $cate_id)->orderBy('sale_price', 'desc')->get();
        return response()->json($pro_cate_desc);
    }

    public function product_price_asc($cate_id){
        $pro_cate_asc = ProductModel::where('cate_id', $cate_id)->orderBy('sale_price', 'asc')->get();
        return response()->json($pro_cate_asc);
    }

    public function product_price_all($cate_id){
        $pro_cate_all = ProductModel::where('cate_id', $cate_id)->orderBy('id', 'desc')->get();
        return response()->json($pro_cate_all);
    }

    public function find_product_name(Request $request){
        $result = ProductModel::where('name','like', '%'.$request->proName.'%')->get();
        return response()->json($result);
    }

    public function post_comment(Request $request){
        $avatar = Auth::user()->avatar;
        $name = Auth::user()->name;
        $result = CommentModel::create([
            'product_id' => $request->productId,
            'user_id' => $request->userId,
            'message' => $request->message,
        ]);

        $different = Carbon::parse($result->posted_at)->diffForHumans();


        // $result

        return response()->json([$result, $avatar, $name, $different]);
    }

    public function send_reply(Request $request){
        $avatar = Auth::user()->avatar;
        $name = Auth::user()->name;
        // $result = CommentModel::create([
        //     'product_id' => $request->productId,
        //     'user_id' => $request->userId,
        //     'message' => $request->message,
        // ]);

        // $different = Carbon::parse($result->posted_at)->diffForHumans();


        // // $result

        $result = ReplyModel::create([
                'comment_id' => $request->idComment,
                'user_id' => Auth::user()->id,
                'message' => $request->message,
        ]);
        return response()->json([$result, $avatar, $name]);

    }
}
