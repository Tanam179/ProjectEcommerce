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
                            <h3 class="card-title">Thêm slider</h3>
                        </div>
                        <form action="/admin/slider/save" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (session('error_message'))
                            <div class="alert alert-danger mb-20 alert__error" style="transition: 1.5s; margin-top: 10px; position: relative;">
                                <span style="font-size: 15px;">
                                    {{ session()->get('error_message') }}
                                </span>
                                
                            </div>
                            @endif
                            <div class="card-body" style="font-size: 16px; display: flex">
                                <div class="form-group col-xl-12">
                                    <label for="cate_image">Hình ảnh slider</label>
                                    <input class="form-control cate-image" type="file" id="slider_img" name="slider_img">
                                    <div class="img-preview"></div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" name="save-slider" style="width: 150px;" class="btn btn-success my-1">Thêm hình ảnh</button>
                                <a href="{{URL::to('admin/slider/all')}}" style="width: 150px; margin-left: 10px;" class="btn btn-danger my-1">Hùy bỏ</a>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <!-- ROW-1 CLOSED -->
        </div>
        <!--CONTAINER CLOSED -->

    </div>

    <script type="text/javascript">
        document.querySelector('#slider_img').addEventListener('change', function(e) {
            let reader = new FileReader();
            reader.onload = function(event) {
                document.querySelector('.img-preview').textContent = '';
                const html = `<img src="${reader.result}" alt="" width="350px" style="margin-top: 10px">`
                document.querySelector('.img-preview').insertAdjacentHTML('afterbegin', html);
            };
            reader.readAsDataURL(this.files[0]);
        })
    </script>
    


@endsection

