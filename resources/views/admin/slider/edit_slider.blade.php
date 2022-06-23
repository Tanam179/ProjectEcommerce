@extends('admin_layout')
@section('admin_content')


    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid mt-6">

            <!-- PAGE-HEADER -->
            
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header badge-success-light text-gray-dark">
                            <h3 class="card-title">Cập nhật hình ảnh Slider</h3>
                        </div>
                        @foreach($result as $result)
                        <form action="{{URL::to('/admin/slider/update/'.$result->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (session('error_message'))
                            <div class="alert alert-danger mb-20 alert__error" style="transition: 15s">
                                <span style="font-size: 15px;">
                                    {{ session()->get('error_message') }}
                                </span>
                            </div>
                            @endif
                            <div class="card-body" style="display: flex; font-size: 16px">
                                <div class="form-group col-xl-6">
                                    <label for="cate_status">Hình ảnh slider</label>
                                    <input class="form-control cate-img-upload" type="file" id="slider_img_edit" name="slider_img_edit">
                                    <img class="img-temporary" style="margin-top: 10px;" src="/upload/sliders/{{$result->img}}" width="350px" alt="">
                                    <div class="img-preview-edit"></div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" name="update-category" style="width: 150px;" class="btn btn-success my-1">Cập nhật</button>
                                <a href="{{URL::to('admin/category/all')}}" style="width: 150px; margin-left: 10px;" class="btn btn-danger my-1">Hủy bỏ</a>
                            </div>
                            
                        </form>
                        @endforeach
                    </div>
                    
                </div>
            </div>
            <!-- ROW-1 CLOSED -->
        </div>
        <!--CONTAINER CLOSED -->

    </div>
<script type="text/javascript">
    document.querySelector('#slider_img_edit').addEventListener('change', function(e) {
        document.querySelector('.img-temporary').style.display = 'none';
        let reader = new FileReader();
        reader.onload = function(event) {
            document.querySelector('.img-preview-edit').textContent = '';
            const html = `<img src="${reader.result}" alt="" width="350px" style="margin-top: 10px">`
            document.querySelector('.img-preview-edit').insertAdjacentHTML('afterbegin', html);
        };
        reader.readAsDataURL(this.files[0]);
    })
</script>

@endsection

