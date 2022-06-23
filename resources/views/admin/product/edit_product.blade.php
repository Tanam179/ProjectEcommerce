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
                            <h3 class="card-title">Cập nhật sản phẩm</h3>
                        </div>
                        
                        
                        <form class="edit-product" name="{{$result->id}}" action="/admin/product/update/{{$result->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (session('error_message'))
                            <div class="alert alert-danger mb-20 alert__error" style="transition: 15s; margin-top: 10px; position: relative;">
                                <span style="font-size: 15px;">
                                    {{ session()->get('error_message') }}
                                </span>
                                <div class="close" style="position: absolute; top: 50%; right: 20px; transform: translateY(-40%); color: green; cursor: pointer;">
                                    <i class="ph-x"></i>
                                </div>
                            </div>
                            @endif
                            @if (session('message'))
                            <div class="alert mb-20 alert__error" style="transition: 1.5s; margin-top: 10px">
                                <span><i class="ph-check"></i></span>
                                <span class="text-success" style="font-size: 15px;">
                                    {{ session()->get('message') }}
                                </span>
                            </div>
                            @endif
                            <div class="card-body" style="font-size: 16px; display: flex; flex-wrap: wrap">
                                <div class="form-group col-xl-6">
                                    <label for="product_name">Tên sản phẩm</label>
                                    @error('product_name')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Tên sản phẩm" value="{{$result->name}}">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="product_price">Giá sản phẩm (VNĐ)</label>
                                    @error('product_price')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input type="number" name="product_price" class="form-control" id="product_price" placeholder="Giá sản phẩm" value="{{$result->price}}">
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="product_desc">Mô tả sản phẩm</label>
                                    @error('product_desc')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <textarea style="resize: none" name="product_desc" class="form-control" id="product_desc" rows="10" placeholder="Mô tả sản phẩm">{{$result->description}}</textarea>
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="formFile" class="form-label">Hình ảnh sản phẩm</label>
                                    @error('product_img')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input class="form-control image-upload-edit" type="file" id="formFile" name="product_img" value="{{ old('product_img') }}">
                                    <img class="img-temporary" style="margin-top: 10px;" src="/upload/products/{{$result->img}}" width="150px" height="150px" alt="">
                                    <div class="img-preview-edit"></div>
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="formFile2" class="form-label">Hình ảnh liên quan</label>
                                    {{-- @error('product_img_relate')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror --}}
                                    <input class="form-control image-relate-upload-edit" type="file" id="formFile2" name="product_img_relate[]" multiple>
                                    <div class="img-relate-preview-edit" style="display: flex; align-items: center">
                                        @foreach($imgs as $key => $img)
                                        <div style="position: relative; margin-top: 10px; margin-right: 10px; width: 150px; height: 150px; border-radius: 5px; overflow: hidden;">
                                            <img src="/upload/products/{{$img}}" width="150px" height="150px" alt="">
                                            <div class="delete-img-prev-edit" data-key="{{$key}}" data-name="{{$img}}" style="position: absolute; top: 10px; right: 10px">
                                                <i style="cursor:pointer; font-size: 20px; color: #f22a59" class="ph-x-square"></i>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="product_size">Kích thước sản phẩm</label>
                                    @error('product_size')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group" style="display: flex">
                                        @for($i = 36; $i <= 44; $i++)
                                            {{-- <label style="margin-right: 35px"><input type="checkbox" name="product_size[]" value="{{$i}}" {{in_array($i, $sizes) ? 'checked' : ''}}> {{$i}}</label> --}}
                                            <div class="check" style="margin-right: 20px">
                                                <input type="checkbox" class="btn-check" name="product_size[]" value="{{$i}}" {{in_array($i, $sizes) ? 'checked' : ''}}  id="btn-check-outlined {{$i}}" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="btn-check-outlined {{$i}}">{{$i}}</label><br>
                                            </div>
                                        @endfor
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group col-xl-6">
                                    <label for="product_sale">Là sản phẩm giảm giá</label>
                                    <select  style="cursor: pointer; position: relative;" name="product_sale" class="form-select sale" aria-label="Default select example">
                                        {{-- <i style="position: absolute; height: 100%; width: 35px; right: 0; top: 0; z-index: 100;" class="ph-caret-down"></i> --}}
                                        @if($result->sale == 0)
                                            <option style="cursor: pointer" value="{{$result->sale}}">Không</option>
                                            <option style="cursor: pointer" value="1">Đúng</option>
                                        @else
                                            <option style="cursor: pointer" value="{{$result->sale}}">Đúng</option>
                                            <option style="cursor: pointer" value="0">Không</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-xl-6 sale-percent-form" style="opacity: 0.7; pointer-events: none; transition: 0.5s">
                                    <label for="product_sale_percent">Mức giảm giá (%)</label>
                                    @error('product_sale_percent')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input type="number" value="{{$result->sale_percent}}" name="product_sale_percent" multiple class="form-control sale-percent" id="product_sale_percent" placeholder="Phần trăm giảm giá">
                                </div>
                                
                                <div class="form-group col-xl-6">
                                    <label for="product_status">Trạng thái sản phẩm</label>
                                    <select  style="cursor: pointer; position: relative;" name="product_status" class="form-select" aria-label="Default select example" id="product_status">
                                        {{-- <i style="position: absolute; height: 100%; width: 35px; right: 0; top: 0; z-index: 100;" class="ph-caret-down"></i> --}}
                                        <option style="cursor: pointer" value="1">Hiển thị</option>
                                        <option style="cursor: pointer" value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="product_cate">Thương hiệu sản phẩm</label>
                                    @error('product_category')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <select  style="cursor: pointer; position: relative;" name="product_category" class="form-select" aria-label="Default select example" id="product_cate">
                                        {{-- <option value="{{$result->cate_id}}">{{$result->cate->name}}</option> --}}
                                        @foreach($category as $cate)
                                        <option value="{{ $cate->id }}"
                                            @if (old('product_category', $result->cate_id) == $cate->id) selected @endif>{{ $cate->name }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" name="update-product" style="width: 150px;" class="btn btn-success my-1">Cập nhật sản phẩm</button>
                                <a href="{{URL::to('admin/category/all')}}" style="width: 150px; margin-left: 10px;" class="btn btn-danger my-1">Hùy bỏ</a>
                            </div>
                        </form>
                       
                    </div>
                    
                </div>
            </div>
            <!-- ROW-1 CLOSED -->
        </div>
        <!--CONTAINER CLOSED -->

    </div>
</div>
<script>
 document.querySelector('.sale').addEventListener('change', function() {
    if( document.querySelector('.sale').options[ document.querySelector('.sale').selectedIndex].value == 1){
        document.querySelector('.sale-percent-form').style.opacity = '1';
        document.querySelector('.sale-percent-form').style.pointerEvents = 'all';
    }
    else{
        // document.querySelector('.sale-percent-form').style.displeray = 'none';
        document.querySelector('.sale-percent-form').style.opacity = 0.7;
        document.querySelector('.sale-percent-form').style.pointerEvents = 'none';
        document.querySelector('.sale-percent').value = 0;
        document.querySelector('.sale-percent').setAttribute('placeholder', '0');
    }
});

window.addEventListener('load', function() {
    if( document.querySelector('.sale').options[ document.querySelector('.sale').selectedIndex].value == 1){
        document.querySelector('.sale-percent-form').style.opacity = '1';
        document.querySelector('.sale-percent-form').style.pointerEvents = 'all';
    }
    else{
        // document.querySelector('.sale-percent-form').style.displeray = 'none';
        document.querySelector('.sale-percent-form').style.opacity = 0.7;
        document.querySelector('.sale-percent-form').style.pointerEvents = 'none';
        document.querySelector('.sale-percent').value = 0;
        document.querySelector('.sale-percent').setAttribute('placeholder', '0');
    }
});



let imgInpEdit = document.querySelector('.image-upload-edit');
let imgRelateInpEdit = document.querySelector('.image-relate-upload-edit');
console.log(imgRelateInpEdit);
let imgRelatePrevEdit = document.querySelector('.img-relate-preview-edit')
const  dtf = new DataTransfer();

imgInpEdit.addEventListener('change', function(e) {
    let reader = new FileReader();
    reader.onload = function(event) {
        document.querySelector('.img-temporary').style.display = 'none';
        document.querySelector('.img-preview-edit').textContent = '';
        const html2 = `<img src="${reader.result}" alt="" width="150px" height="150px" style="margin-top: 10px">`;
        document.querySelector('.img-preview-edit').insertAdjacentHTML('afterbegin', html2);
    };
    reader.readAsDataURL(this.files[0]);
})

imgRelateInpEdit.addEventListener('change', function(event){
    for(let i = 0; i < this.files.length; i++){
        let itemName = imgRelateInpEdit.files.item(i).name;
        console.log(itemName);
        let reader = new FileReader();
        reader.onload = function(event) {
            const div = document.createElement('div');
            // div.setAttribute('name', itemName);
            div.style.position = 'relative';
            div.style.width = '150px';
            div.style.height = '150px';
            div.style.marginTop = '10px';
            div.style.marginRight = '10px';
            div.style.borderRadius = '5px';
            div.style.overflow = 'hidden';
            div.innerHTML= `
                            <img src="${reader.result}" alt="" width="150px" height="150px">
                            <p class="name">${itemName}</p>
                            <span class="delete-img-prev-last" style="position: absolute; top: 10px; right: 10px">
                                <i style="cursor:pointer; font-size: 20px; color: #f22a59" class="ph-x-square"></i>
                            </span>
                            `;
            imgRelatePrevEdit.appendChild(div);
        };
        reader.readAsDataURL(event.target.files[i]);
    }

    for(let file of this.files){
        dtf.items.add(file);
    }

    this.files = dtf.files;

    setTimeout(function() {
        $('.delete-img-prev-last').click(function(){
            let name = $(this).prev('p.name').text();
            $(this).parent().remove();
            for(let i = 0; i < dtf.items.length; i++){

                if(name === dtf.items[i].getAsFile().name){
                    dtf.items.remove(i);
                    continue;
                }
            }
            document.querySelector('.image-relate-upload-edit').files = dtf.files;
        });
    }, 500);
});


let prodId = document.querySelector('form.edit-product').getAttribute('name');
const allImgRelatePrev = document.querySelectorAll('.delete-img-prev-edit');
document.querySelectorAll('.delete-img-prev-edit').forEach((el, ind) => {
    el.addEventListener('click', function() {
       

        // Array.from(allImgRelatePrev).splice(ind, 1);
        // setTimeout("location.reload(true);", 100)
        this.parentElement.remove();

        let imgName = this.getAttribute('data-name');
        console.log(imgName);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        $.ajax({
            url: "/admin/product/delete-img-relate/"+prodId+"/"+imgName,
            type: "GET",
            data: imgName,
            success:function(response) {
                console.log(response);
            }
        });
        
    });
});

// document.querySelectorAll('.delete-img-prev-edit').forEach((el, ind) => {
//     el.addEventListener('click', function() {
//         this.parentElement.remove();

//         Array.from(allImgRelatePrev).splice(ind, 1);
//         setTimeout("location.reload(true);", 100)

        
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });

//         $.ajax({
//             url: "/admin/product/delete-img-relate/"+prodId+"/"+ind,
//             type: "GET",
//             data: ind,
//             success:function(response) {
//                 console.log(response);
//             }
//         });
        
//     });
// });



</script>
@endsection

