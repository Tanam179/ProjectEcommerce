<?php

namespace App\Http\Controllers;

use App\Enum\CartStatus;
use App\Enum\OrderStatus;
use App\Models\CartModel;
use App\Models\OrderDetailModel;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class Order extends Controller
{
    public function all_order() {
        $all_progressing_order = OrderDetailModel::where('status', 'progressing')->get();
        // $all_progressing_order =  '';
        // foreach($order_detail as $detail){
        //     $all_progressed_order = $detail->id;
        // }
        $all_progressed_order = OrderDetailModel::where('status', 'progressed')->get();
        $all_cancel_order = OrderDetailModel::where('status', 'cancel')->get();
        $all_paid_order = OrderDetailModel::where('status', 'paid')->get();
        return view('admin.order.all_order', ['hasOrderProgressing' => OrderDetailModel::where('status', 'progressing')->exists()])->with('all_progressing_order', $all_progressing_order)->with('all_progressed_order', $all_progressed_order)->with('all_cancel_order', $all_cancel_order)->with('all_paid_order', $all_paid_order);
    }

    public function order_detail_progressing($id){
        $order_detail = OrderDetailModel::where('id', $id)->get();
        $get_id = OrderDetailModel::where('id', $id)->first()->id;
        $order_item = OrderItems::where('order_id', $get_id)->get();
        $total = 0;
        foreach($order_item as $item){
            $total = $total + ($item->product_quantity * $item->product->sale_price);
        }
        // $oder_detail_user_id = OrderDetailModel::where('id', $id)->first();
        // $cart_user_id = CartModel::where('user_id', $oder_detail_user_id->user_id)->where('status', 'progressing')->get();
        // $cart_user_id_progressed = CartModel::where('user_id', $oder_detail_user_id)->where('status', 'progressed')->get();
        return view('admin.order.order_detail')->with('order_detail', $order_detail)->with('order_item', $order_item)->with('get_id', $get_id)->with('total', $total);
    }

    public function order_progressed($id){
        OrderDetailModel::where('id', $id)->update([
            'status' => OrderStatus::Progressed,
        ]);
        $oder_detail_user_id = OrderDetailModel::where('id', $id)->first();
        $cart_user_id = CartModel::where('user_id', $oder_detail_user_id->user_id)->where('status', 'progressing')->update([
            'status' => CartStatus::Progressed,
        ]);
        
        return redirect('/admin/order/all')->with('message', 'Phê Duyệt Đơn Hàng Thành Công ');
    }

    public function order_detail_progressed($id){
        $order_detail = OrderDetailModel::where('id', $id)->get();
        $get_id = OrderDetailModel::where('id', $id)->first();
        // $oder_detail_user_id = OrderDetailModel::where('id', $id)->first()->user_id;
        $cart_user_id_progressed = OrderItems::where('order_id', $get_id->id)->get();
        $total = 0;
        foreach($cart_user_id_progressed as $item){
            $total = $total + ($item->product_quantity * $item->product->sale_price);
        }
        return view('admin.order.order_detail_progressed')->with('order_detail', $order_detail)->with('get_id', $get_id)->with('cart_user_id_progressed', $cart_user_id_progressed)->with('total', $total);
    }

    public function cancel_orders($id){
        $cart_cancel = OrderDetailModel::where('user_id', $id)->where('status', 'progressing')->update([
            'status' => OrderStatus::Cancel,
        ]);
        // CartModel::where('user_id', $id)->where('status', 'progressing')->update([
        //     'status' => CartStatus::Default
        // ]);
        return redirect()->back();
    }

    public function order_paid($id){
        OrderDetailModel::where('id', $id)->where('status', 'progressed')->update([
            'status' => OrderStatus::Paid,
        ]);
        $oder_detail_user_id = OrderDetailModel::where('id', $id)->first();
        $cart_user_id = CartModel::where('user_id', $oder_detail_user_id->user_id)->where('status', 'progressed')->update([
            'status' => CartStatus::Paid,
        ]);
        return redirect('/admin/order/all')->with('message', 'Phê Duyệt Đơn Hàng Thành Công ');
    }

    public function order_detail_paid($id){
        $order_detail = OrderDetailModel::where('id', $id)->get();
        $get_id = OrderDetailModel::where('id', $id)->first();
        // $oder_detail_user_id = OrderDetailModel::where('id', $id)->first()->user_id;
        $cart_user_id_progressed = OrderItems::where('order_id', $get_id->id)->get();
        $total = 0;
        foreach($cart_user_id_progressed as $item){
            $total = $total + ($item->product_quantity * $item->product->sale_price);
        }
        return view('admin.order.order_detail_paid')->with('order_detail', $order_detail)->with('get_id', $get_id)->with('cart_user_id_progressed', $cart_user_id_progressed)->with('total', $total);
    }

    public function order_detail_cancel($id){
        $order_detail = OrderDetailModel::where('id', $id)->get();
        $get_id = OrderDetailModel::where('id', $id)->first();
        // $oder_detail_user_id = OrderDetailModel::where('id', $id)->first()->user_id;
        $cart_user_id_progressed = OrderItems::where('order_id', $get_id->id)->get();
        $total = 0;
        foreach($cart_user_id_progressed as $item){
            $total = $total + ($item->product_quantity * $item->product->sale_price);
        }
        return view('admin.order.order_detail_cancel')->with('order_detail', $order_detail)->with('get_id', $get_id)->with('cart_user_id_progressed', $cart_user_id_progressed)->with('total', $total);
    }
}
