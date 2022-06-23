@extends('admin_layout')
@section('admin_content')

    <div class="side-app">
        <div class="title" style="display: flex; align-items: center; justify-content: space-between">
            <h3>Danh sách slider</h3>
            <a style="font-size: 14px; display: block" href="{{ URL::to('/admin/slider/add') }}"
                        class="btn btn-sm btn-success"><i class="ph-plus" style="margin-right: 10px; position: relative; top: 2px"
                            aria-hidden="true"></i>Thêm
                        mới slider</a>
        </div>
        @if (session('message'))
        <div class="alert mb-20 alert__error" style="transition: 1.5s; margin-top: 10px">
            <span><i class="ph-check"></i></span>
            <span class="text-success" style="font-size: 15px;">
                {{ session()->get('message') }}
            </span>
        </div>
        @endif

        <!-- CONTAINER -->
        @if(true)
        <table class="table" style="text-align: center">
            <thead class="bg-default">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Tùy chọn</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($all_slider as $key => $val)
                <tr>
                    <th scope="row">
                        {{$key + 1}}
                    </th>
                    <td style="display: flex; justify-content: center">{{-- {{$val->status}} --}}
                        <img src="/upload/sliders/{{$val->img}}" width="200px"  alt="">
                    </td>
                    <td style="font-size: 20px">
                        <a href="{{URL::to('/admin/slider/edit/'.$val->id)}}"
                            class="active" ui-toggle-class=""><i style="color: #12b886;"
                                class="ph-note-pencil" aria-hidden="true"></i></a>
                        <a 
                            style="margin-left: 10px"
                            href="{{URL::to('/admin/slider/delete/'.$val->id)}}"
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
                    <h3 style="display: flex; justify-content: center; margin-bottom: 20px;">Oops! Danh mục sản phẩm trống</h3>
                    <p style="display: flex; justify-content: center; margin-bottom: 100px; font-size: 20px">Hiện chưa có dữ liệu nào, hãy &quot;Thêm mới&quot; một danh mục</p>
                </div>
            @endif
        <!--CONTAINER CLOSED -->

    </div>
</div>

<script type="text/javascript">
    const toggle = document.querySelectorAll('.toggle');
    const indicator = document.querySelectorAll('.indicator');
    // toggle.forEach(el => {
    //     el.addEventListener('click', function(e) {

    //         let cateId = this.getAttribute('data-id')
            
            
    //         if(el.classList.contains('active')){
                
    //             // alert(cateId);
    //             $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             });

    //             $.ajax({
    //                 url: "/admin/category/unactive-status/"+cateId,
    //                 type: "GET",
    //                 data: "",
    //                 success:function(response) {
    //                     setTimeout(() => {
    //                         alert('Cập nhật ẩn danh mục thành công');
    //                     }, 1000);
    //                 }
    //             });
    //             el.classList.remove('active');
    //         }
    //         else{
    //             $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             });
                
    //             $.ajax({
    //                 url: "/admin/category/active-status/"+cateId,
    //                 type: "GET",
    //                 data: "",
    //                 success:function(response) {
    //                     setTimeout(() => {
    //                         alert('Cập nhật hiển thị danh mục thành công');
    //                     }, 1000);
    //                 }
    //             });
    //             el.classList.add('active');
    //         }
    //     })
    // })

    // document.querySelectorAll('.delete-img-prev-edit').forEach((el, ind) => {
    // let index = 0;
    
    
    // el.addEventListener('click', function() {
    //     index = ind;    
        
    //     this.parentElement.remove();

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         url: "/admin/product/delete-img-relate/"+prodId+"/"+index,
    //         type: "GET",
    //         data: index,
    //         success:function(response) {
    //             alert('Xóa ảnh thành công');
    //         }
    //     });
    // });
// });
</script>




@endsection
