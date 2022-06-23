@extends('admin_layout')
@section('admin_content')

    <div class="side-app">
        <div class="title" style="display: flex; align-items: center; justify-content: space-between">
            <h3>Danh sách sản phẩm</h3>
            <select class="form-select col-xl-3 all-product_select" style="cursor: pointer;">
                <option value="0">Tất cả sản phẩm</option>
                @foreach($all_category as $all_cate)
                <option style="text-transform: capitalize" value="{{$all_cate->id}}">{{$all_cate->name}}</option>
                @endforeach
            </select>
            <a style="font-size: 14px; display: block" href="{{ URL::to('/admin/product/add') }}"
                        class="btn btn-sm btn-success"><i class="ph-plus" style="margin-right: 10px; position: relative; top: 2px"
                            aria-hidden="true"></i>Thêm
                        sản phẩm</a>
        </div>
        @if (session('message'))
        <div class="alert mb-20" style="transition: 1.5s; margin-top: 10px">
            <span class="text-success" style="font-size: 15px;">
                {{ session()->get('message') }}
            </span>
        </div>
        @endif

        <!-- CONTAINER -->
        @if($hasProduct)
        <table class="table" style="text-align: center">
            <thead class="bg-default">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Giá</th>
                
                <th scope="col">Tùy chọn</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($all_product as $key => $val)
                <tr>
                    <th scope="row">
                        {{$key + 1}}
                    </th>
                    <td>{{$val->name}}</td>
                    <td>
                        <img src="/upload/products/{{$val->img}}" width="150px" height="150px" alt="">
                    </td>
                    <td>{{number_format($val->price , 0 , ',' , ',' )}} VNĐ</td>
                    <td style="font-size: 20px">
                        <a href="{{URL::to('/admin/product/edit/'.$val->id)}}"
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
                <div class="box-empty" >
                    <div class="iamge-error">
                        <img src="/upload/error/boxes.png" style="display: block; margin: 50px auto" width="200px" alt="">
                    </div>
                    <h3 style="display: flex; justify-content: center; margin-bottom: 20px;">Oops! Danh sách sản phẩm trống</h3>
                    <p style="display: flex; justify-content: center; margin-bottom: 100px; font-size: 20px">Hiện chưa có dữ liệu nào, hãy &quot;Thêm mới&quot; một sản phẩm</p>
                </div>
            @endif
        <!--CONTAINER CLOSED -->

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
    document.querySelector('select.all-product_select').addEventListener('change', function(){
        let value = document.querySelector('select.all-product_select').value;
        // alert(value);

        if(value > 0){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/product-by-cate/'+value,
                type: "POST",
                data: "",
                dataType: 'json',
                success:function(response) {
                    document.querySelector('tbody').innerHTML = '';
                    response.forEach((el, ind) => {
                        let html =  `<tr>
                                            <th scope="row">
                                                ${ind + 1}
                                            </th>
                                            <td>${el.name}</td>
                                            <td>
                                                <img src="/upload/products/${el.img}" width="150px" height="150px" alt="">
                                            </td>
                                            <td>{{number_format($val->price , 0 , ',' , ',' )}} VNĐ</td>
                                            <td style="font-size: 20px">
                                                <a href="/admin/product/edit/${el.id}"
                                                    class="active" ui-toggle-class=""><i style="color: #12b886;"
                                                        class="ph-note-pencil" aria-hidden="true"></i></a>
                                                <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                                                    style="margin-left: 10px"
                                                    href="/admin/product/delete/${el.id})"
                                                    class="active" ui-toggle-class=""><i style="color: #f03e3e;"
                                                    class="ph-trash-simple" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>`;
                        document.querySelector('tbody').insertAdjacentHTML('beforeend', html);
                    })
                }
            });
        }
        else if (value == '0'){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/product-all-ajax',
                type: "POST",
                data: "",
                dataType: 'json',
                success:function(response) {
                    console.log(response);
                    document.querySelector('tbody').innerHTML = '';
                    response.forEach((el, ind) => {
                        let html =  `<tr>
                                            <th scope="row">
                                                ${ind + 1}
                                            </th>
                                            <td>${el.name}</td>
                                            <td>
                                                <img src="/upload/products/${el.img}" width="150px" height="150px" alt="">
                                            </td>
                                            <td>{{number_format($val->price , 0 , ',' , ',' )}} VNĐ</td>
                                            <td style="font-size: 20px">
                                                <a href="/admin/product/edit/${el.id}"
                                                    class="active" ui-toggle-class=""><i style="color: #12b886;"
                                                        class="ph-note-pencil" aria-hidden="true"></i></a>
                                                <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                                                    style="margin-left: 10px"
                                                    href="/admin/product/delete/${el.id})"
                                                    class="active" ui-toggle-class=""><i style="color: #f03e3e;"
                                                    class="ph-trash-simple" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>`;
                        document.querySelector('tbody').insertAdjacentHTML('beforeend', html);
                    })
                }
            });
        }

    });
</script>

@endsection
