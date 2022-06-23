@extends('admin_layout')
@section('admin_content')

    <div class="side-app">
        <div class="title" style="text-align: left; text-transform: uppercase">
            <h3>Chi tiết đơn hàng</h3>
        </div>

        <!-- CONTAINER -->
        
        <div class="order-title" style="margin-top: 50px; padding: 10px 0; background: rgba(19,191,166, 0.05); border: 1px solid rgb(19,191,166); font-weight: 600; text-align: center; margin-bottom: 10px;">
            <span>THÔNG TIN KHÁCH HÀNG</span>
        </div>
        <table class="table" style="text-align: center">
            <thead class="bg-default">
              <tr>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Phường</th>
                <th scope="col">Quận</th>
                <th scope="col">Tỉnh thành</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($order_detail as $key => $val)
                <tr>
                    <td>{{$val->user->name}}</td>
                    <td>{{$val->phone_number}}</td>
                    <td>{{$val->address}}</td>
                    <td>{{$val->ward}}</td>
                    <td>{{$val->district}}</td>
                    <td>{{$val->country}}</td>
                    {{-- <td style="display: inline-block; color: #f03e3e; font-weight: 600">Đang chờ xử lý</td> --}}
                    
                    {{-- <td style="font-size: 20px">
                        <a href="{{URL::to('/admin/order-detail/'.$val->id)}}"
                            class="active" ui-toggle-class=""><i style="color: #12b886;"
                                class="ph-note-pencil" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                            style="margin-left: 10px"
                            href="{{URL::to('/admin/product/delete/'.$val->id)}}"
                            class="active" ui-toggle-class=""><i style="color: #f03e3e;"
                            class="ph-trash-simple" aria-hidden="true"></i></a>
                    </td> --}}
                </tr>
            @endforeach
            </tbody>
          </table>


          <div class="order-title" style="margin-top: 100px; padding: 10px 0; background: rgba(19,191,166, 0.05); border: 1px solid rgb(19,191,166); font-weight: 600; text-align: center; margin-bottom: 10px;">
            <span>THÔNG TIN ĐƠN HÀNG</span>
        </div>
        <table class="table" style="text-align: center">
            <thead class="bg-default">
              <tr>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Size</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach($cart_user_id_progressed as $key => $val)
                <tr>
                    <td style="display: inline-block; width: 200px; ">{{$val->product->name}}</td>
                    <td>
                        <img src="/upload/products/{{$val->product->img}}" alt="" width="120px">
                    </td>
                    <td>{{$val->product_size}}</td>
                    <td>{{$val->product_quantity}}</td>
                    <td>{{($val->product->sale_price * $val->product_quantity)}}</td>
                    
                    {{-- <td style="display: inline-block; color: #f03e3e; font-weight: 600">Đang chờ xử lý</td> --}}
                    
                    {{-- <td style="font-size: 20px">
                        <a href="{{URL::to('/admin/order-detail/'.$val->id)}}"
                            class="active" ui-toggle-class=""><i style="color: #12b886;"
                                class="ph-note-pencil" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                            style="margin-left: 10px"
                            href="{{URL::to('/admin/product/delete/'.$val->id)}}"
                            class="active" ui-toggle-class=""><i style="color: #f03e3e;"
                            class="ph-trash-simple" aria-hidden="true"></i></a>
                    </td> --}}
                </tr>
            @endforeach
            </tbody>
          </table>
          <div class="total-price" style="margin-top: 50px; display: flex; align-items: flex-start; justify-content: flex-end; font-size: 18px">
              <label>Tổng cộng:</label>
              <span style="margin-left: 20px">{{number_format($total , 0 , ',' , ',' )}}đ</span>
          </div>
          <div class="progess" style="margin-top: 50px; display: flex; justify-content: flex-end">
              <a style="display: inline-block; padding: 10px 0; border-radius: 5px; margin-bottom: 25px; width: 200px; text-align: center; background: #13bfa6; color: #fff" href="/admin/order/paid/{{$get_id->id}}">Xóa đon hàng</a>
              <a style="display: inline-block; padding: 10px 0; border-radius: 5px; margin-bottom: 25px; width: 200px; text-align: center; background: #f03e3e; color: #fff; margin-left: 25px;" href="">Quay về</a>
          </div>
            
        <!--CONTAINER CLOSED -->

    </div>
</div>

@endsection
