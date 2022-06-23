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
                            <h3 class="card-title">Thêm mới sản phẩm</h3>
                        </div>
                        <form action="/admin/product/save" method="POST" enctype="multipart/form-data">
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
                            <div class="card-body" style="font-size: 16px; display: flex; flex-wrap: wrap">
                                <div class="form-group col-xl-6">
                                    <label for="product_name">Tên sản phẩm</label>
                                    @error('product_name')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Tên sản phẩm" value="{{ old('product_name') }}">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="product_price">Giá sản phẩm (VNĐ)</label>
                                    @error('product_price')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input type="number" name="product_price" class="form-control" id="product_price" placeholder="Giá sản phẩm" value="{{ old('product_price') }}">
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="product_desc">Mô tả sản phẩm</label>
                                    @error('product_desc')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <textarea value="{{ old('product_desc') }}" style="resize: none" name="product_desc" class="form-control" id="product_desc" rows="10" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="formFile" class="form-label">Hình ảnh sản phẩm</label>
                                    @error('product_img')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input class="form-control image-upload" type="file" id="formFile" name="product_img" value="{{ old('product_img') }}">
                                    <div class="img-preview"></div>
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="formFile2" class="form-label">Hình ảnh liên quan</label>
                                    @error('product_img_relate')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input class="form-control image-relate-upload" type="file" id="formFile2" name="product_img_relate[]" multiple>
                                    <div class="img-relate-preview" style="display: flex; align-items: center">
                                        
                                    </div>
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="product_size">Kích thước sản phẩm</label>
                                    @error('product_size')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    {{-- <input type="text" name="product_size" class="form-control" id="product_size" placeholder="Thêm nhiều size dùng dấu ' , ' . VD: 39, 40, 41" value="{{ old('product_size') }}"> --}}
                                    <div class="form-group" style="display: flex; flex-wrap: wrap; margin-top: 15px;">

                                        {{-- <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">1</label>
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox2">1</label> --}}
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="36"  id="btn-check-outlined 36" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 36">36</label><br>
                                        </div>
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="37" id="btn-check-outlined 37" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 37">37</label><br>
                                        </div>
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="38"  id="btn-check-outlined 38" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 38">38</label><br>
                                        </div>
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="39"  id="btn-check-outlined 39" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 39">39</label><br>
                                        </div>
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="40"  id="btn-check-outlined 40" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 40">40</label><br>
                                        </div>
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="41" id="btn-check-outlined 41" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 41">41</label><br>
                                        </div>
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="42"  id="btn-check-outlined 42" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 42">42</label><br>
                                        </div>
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="43"  id="btn-check-outlined 43" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 43">43</label><br>
                                        </div>
                                        <div class="check" style="margin-right: 20px">
                                            <input type="checkbox" class="btn-check" name="product_size[]" value="44"  id="btn-check-outlined 44" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btn-check-outlined 44">44</label><br>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-xl-6">
                                    <label for="product_sale">Là sản phẩm giảm giá</label>
                                    <select  style="cursor: pointer; position: relative;" name="product_sale" class="form-select sale" aria-label="Default select example">
                                        {{-- <i style="position: absolute; height: 100%; width: 35px; right: 0; top: 0; z-index: 100;" class="ph-caret-down"></i> --}}
                                        <option style="cursor: pointer" {{old('product_sale') == 0 ? 'selected' : ''}}  value="0">Không</option>
                                        <option style="cursor: pointer" {{old('product_sale') == 1 ? 'selected' : ''}} value="1">Đúng</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-6 sale-percent-form" style="opacity: 0.7; pointer-events: none; transition: 0.5s">
                                    <label for="product_sale_percent">Mức giảm giá (%)</label>
                                    @error('product_sale_percent')
                                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px;">{{ $message }}</span>
                                    @enderror
                                    <input type="number" value="0" name="product_sale_percent" multiple class="form-control sale-percent" id="product_sale_percent" placeholder="Phần trăm giảm giá">
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
                                        @foreach($product_category as $all_pro_cate)
                                            <option value="{{$all_pro_cate->id}}">{{$all_pro_cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" name="save-product" style="width: 150px;" class="btn btn-success my-1">Thêm sản phẩm</button>
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
const saleSelect = document.querySelector('.sale');
saleSelect.addEventListener('change', function() {
    if(saleSelect.options[saleSelect.selectedIndex].value == 1){
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
    if(saleSelect.options[saleSelect.selectedIndex].value == 1){
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
})

let imgInp = document.querySelector('.image-upload');
let imgRelateInp = document.querySelector('.image-relate-upload');
let imgRelatePrev = document.querySelector('.img-relate-preview');
const dataTransfer = new DataTransfer();
        
imgInp.addEventListener('change', function(e) {
    let reader = new FileReader();
    reader.onload = function(event) {
        document.querySelector('.img-preview').textContent = '';
        const html = `<img src="${reader.result}" alt="" width="150px" height="150px" style="margin-top: 10px">`
        document.querySelector('.img-preview').insertAdjacentHTML('afterbegin', html);
    };
    reader.readAsDataURL(this.files[0]);
})

imgRelateInp.addEventListener('change', function(event){
    for(let i = 0; i < this.files.length; i++){
        console.log(this.files);
        let nameItem = imgRelateInp.files.item(i).name;
        console.log(nameItem);
        let reader = new FileReader();
        reader.onload = function(event) {
            const div = document.createElement('div');
            // div.setAttribute('name', nameItem);
            div.style.position = 'relative';
            div.style.width = '150px';
            div.style.height = '150px';
            div.style.marginTop = '10px';
            div.style.marginRight = '10px';
            div.style.borderRadius = '5px';
            div.style.overflow = 'hidden';
            div.innerHTML= `
                            <img src="${reader.result}" alt="" width="150px" height="150px">
                            <p class="name">${nameItem}</p>
                            <span class="delete-img-prev" style="position: absolute; top: 10px; right: 10px">
                                <i style="cursor:pointer; font-size: 20px; color: #f22a59" class="ph-x-square"></i>
                            </span>
                            `;
            imgRelatePrev.appendChild(div);
        };
        reader.readAsDataURL(event.target.files[i]);
    }

    for(let file of this.files){
        dataTransfer.items.add(file);
    }

    this.files = dataTransfer.files;

    setTimeout(function() {
        $('.delete-img-prev').click(function(){
            let name = $(this).prev('p.name').text();
            $(this).parent().remove();
            for(let i = 0; i < dataTransfer.items.length; i++){

                if(name === dataTransfer.items[i].getAsFile().name){

                    dataTransfer.items.remove(i);
                    continue;
                }
            }
            document.querySelector('.image-relate-upload').files = dataTransfer.files;
        });
    }, 1000);
});


</script>

@endsection

