@extends('admin_layout')
@section('admin_content')

    <div class="side-app">
        <div class="title" style="text-align: left; text-transform: uppercase">
            <h3>Danh sách tất cả các đơn hàng</h3>
        </div>
        @if (session('message'))
        <div class="alert mb-20" style="transition: 1.5s; margin-top: 10px">
            <span class="text-success" style="font-size: 15px;">
                {{ session()->get('message') }}
            </span>
        </div>
        @endif

        <!-- CONTAINER -->
        
        @if($hasOrderProgressing)
        <div class="order-title" style="margin-top: 50px; padding: 10px 0; background: rgba(19,191,166, 0.05); border: 1px solid rgb(19,191,166); font-weight: 600; text-align: center; margin-bottom: 10px;">
            <span>DANH SÁCH CÁC ĐƠN HÀNG CHỜ XỬ LÝ</span>
        </div>
        <table class="table" style="text-align: center">
            <thead class="bg-default">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Tình trạng</th>
                <th scope="col">Tùy chọn</th>
              </tr>
            </thead>
            <tbody>
            @foreach($all_progressing_order as $key => $val)
                <tr class="cart-progressing">
                    <th scope="row">
                        {{$key + 1}}
                    </th>
                    <td>{{$val->user->name}}</td>
                    <td>{{$val->phone_number}}</td>
                    <td style="display: inline-block; color: #f03e3e; font-weight: 600">Đang chờ xử lý</td>
                    
                    <td style="font-size: 20px">
                        <a href="{{URL::to('/admin/order-detail/'.$val->id)}}"
                            class="active" ui-toggle-class=""><i style="color: #12b886;"
                                class="ph-note-pencil" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                            style="margin-left: 10px"
                            href="{{URL::to('/admin/product/delete/'.$val->id)}}"
                            class="active" ui-toggle-class=""><i style="color: #f03e3e;"
                            class="ph-trash-simple" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach
           
            </tbody>
          </table>
          @else
            <div class="order-title" style="margin-top: 50px; padding: 10px 0; background: rgba(19,191,166, 0.05); border: 1px solid rgb(19,191,166); font-weight: 600; text-align: center;">
                <span>DANH SÁCH CÁC ĐƠN HÀNG CHỜ XỬ LÝ</span>
            </div>
            <div class="title">
                <span style="display: block; text-align: center; font-size: 18px; text-transform: uppercase">Tạm thời bạn chưa có đơn hàng nào mới</span>
          </div>
      @endif
            
        <!--CONTAINER CLOSED -->
        <div class="order-title" style="margin-top: 50px; padding: 10px 0; background: rgba(19,191,166, 0.05); border: 1px solid rgb(19,191,166); font-weight: 600; text-align: center; margin-bottom: 10px;">
            <span>DANH SÁCH CÁC ĐƠN HÀNG ĐÃ XỬ LÝ</span>
        </div>
        <table class="table" style="text-align: center">
            <thead class="bg-default">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Tình trạng</th>
                <th scope="col">Tùy chọn</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach($all_progressed_order as $key => $val)
                <tr class="cart-progressed">
                <th scope="row">
                    {{$key + 1}}
                </th>
                <td>{{$val->user->name}}</td>
                <td>{{$val->phone_number}}</td>
                <td style="display: inline-block; color: #12b886; font-weight: 600">Đã xử lý</td>
                
                <td style="font-size: 20px">
                    <a href="{{URL::to('/admin/order-detail/progressed/'.$val->id)}}"
                        class="active" ui-toggle-class=""><i style="color: #12b886;"
                            class="ph-note-pencil" aria-hidden="true"></i></a>
                    <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                        style="margin-left: 10px"
                        href="{{URL::to('/admin/product/delete/'.$val->id)}}"
                        class="active" ui-toggle-class=""><i style="color: #f03e3e;"
                        class="ph-trash-simple" aria-hidden="true"></i></a>
                </td>
            </tr>
            {{-- @foreach(App\Models\OrderItems::where('order_id', $val->id)->get() as $nak)
            <p>{{$nak->product_id}}</p>
            @endforeach --}}
        @endforeach
        </tbody>
        </table>

        <div class="order-title" style="margin-top: 50px; padding: 10px 0; background: rgba(19,191,166, 0.05); border: 1px solid rgb(19,191,166); font-weight: 600; text-align: center; margin-bottom: 10px;">
            <span>DANH SÁCH CÁC ĐƠN HÀNG ĐÃ THANH TOÁN</span>
        </div>
        <table class="table" style="text-align: center">
            <thead class="bg-default">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Tình trạng</th>
                <th scope="col">Tùy chọn</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach($all_paid_order as $key => $val)
                <tr class="cart-progressed">
                <th scope="row">
                    {{$key + 1}}
                </th>
                <td>{{$val->user->name}}</td>
                <td>{{$val->phone_number}}</td>
                <td style="display: inline-block; color: purple; font-weight: 600">Đã thanh toán</td>
                
                <td style="font-size: 20px">
                    <a href="{{URL::to('/admin/order-detail/paid/'.$val->id)}}"
                        class="active" ui-toggle-class=""><i style="color: #12b886;"
                            class="ph-note-pencil" aria-hidden="true"></i></a>
                    <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                        style="margin-left: 10px"
                        href="{{URL::to('/admin/product/delete/'.$val->id)}}"
                        class="active" ui-toggle-class=""><i style="color: #f03e3e;"
                        class="ph-trash-simple" aria-hidden="true"></i></a>
                </td>
            </tr>
            {{-- @foreach(App\Models\OrderItems::where('order_id', $val->id)->get() as $nak)
            <p>{{$nak->product_id}}</p>
            @endforeach --}}
        @endforeach
        </tbody>
        </table>


          <div class="order-title" style="margin-top: 50px; padding: 10px 0; background: rgba(19,191,166, 0.05); border: 1px solid rgb(19,191,166); font-weight: 600; text-align: center; margin-bottom: 10px;">
            <span>DANH SÁCH CÁC ĐƠN HÀNG ĐÃ HỦY</span>
        </div>
        <table class="table" style="text-align: center">
            <thead class="bg-default">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Tình trạng</th>
                <th scope="col">Tùy chọn</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach($all_cancel_order as $key => $val)
                <tr class="cart-progressed">
                <th scope="row">
                    {{$key + 1}}
                </th>
                <td>{{$val->user->name}}</td>
                <td>{{$val->phone_number}}</td>
                <td style="display: inline-block; color: #f03e3e; font-weight: 600">Đã hủy</td>
                
                <td style="font-size: 20px">
                    <a href="{{URL::to('/admin/order-detail/cancel/'.$val->id)}}"
                        class="active" ui-toggle-class=""><i style="color: #12b886;"
                            class="ph-note-pencil" aria-hidden="true"></i></a>
                    <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                        style="margin-left: 10px"
                        href="{{URL::to('/admin/product/delete/'.$val->id)}}"
                        class="active" ui-toggle-class=""><i style="color: #f03e3e;"
                        class="ph-trash-simple" aria-hidden="true"></i></a>
                </td>
            </tr>
            {{-- @foreach(App\Models\OrderItems::where('order_id', $val->id)->get() as $nak)
            <p>{{$nak->product_id}}</p>
            @endforeach --}}
        @endforeach
        </tbody>
      </table>
    </div>
</div>

@endsection
