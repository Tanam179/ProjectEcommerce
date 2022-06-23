@extends('welcome')
@section('content')
<div class="product-by-cate">
    <div class="container">
        <div class="product-by-cate-top">
            <div class="title">
                <p>DANH SÁCH SẢN PHẨM <span data-id="{{$all_product_by_cate_name->id}}">{{$all_product_by_cate_name->name}}</span></p>
            </div>
            <div class="filter">
                <i class="ph-funnel icon-filter"></i>
                <div class="select-filter">
                    <label for="filter-prod">Lọc sản phẩm theo: </label>
                    <select name="filter_product" id="filter-prod">
                        <option value="all" selected>Tất cả</option>
                        <option value="desc">Sắp xếp theo thứ tự giá giảm dần</option>
                        <option value="asc">Sắp xếp theo thứ tự giá tăng dần</option>
                    </select>
                </div>
            </div>
            <div class="line-through"></div>
        </div>
        <div class="box">
            @foreach($all_product_by_cate as $all_pro_cate)
            <div class="box-container">
                <div class="product-by-cate-img">
                    <a href="/product-detail/{{$all_pro_cate->id}}"><img src="/upload/products/{{$all_pro_cate->img}}" alt=""></a>
                </div>
                <div class="product-by-cate-name">
                    <p>{{$all_pro_cate->name}}</p>
                </div>
                <div class="product-by-cate-price" style="display: flex">
                    @if($all_pro_cate->sale == 1)
                        <p style="font-size: 18px">{{number_format($all_pro_cate->sale_price , 0 , ',' , ',' )}}<span>đ</span></p>
                        <p style="font-size: 14px; margin-left: 15px; text-decoration: line-through; color: #333" class="old-price">{{number_format($all_pro_cate->price , 0 , ',' , ',' )}}<span>đ</span></p>
                    @else
                    {{-- <span style="font-size: 22px " class="old-price"></span> --}}
                        <p style="font-size: 18px">{{number_format($all_pro_cate->price , 0 , ',' , ',' )}}<span>đ</span></p>
                    @endif
                </div>
                <div class="product-by-cate-add-cart">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 15.223 15.06">
                        <g id="pc-cart-icon" transform="translate(0 0)">
                            <path id="Path_573" data-name="Path 573" d="M-1242.161,1296.776h-7.982a.9.9,0,0,1-.667-.294.9.9,0,0,1-.232-.69l.963-10.557a.9.9,0,0,1,.9-.821h9.839a.9.9,0,0,1,.9.818l.356,3.77a.6.6,0,0,1-.536.648.6.6,0,0,1-.648-.536l-.331-3.51h-9.316l-.91,9.984h7.668a.6.6,0,0,1,.595.595A.594.594,0,0,1-1242.161,1296.776Z" transform="translate(1251.046 -1281.716)"/>
                            <path id="Path_574" data-name="Path 574" d="M-1230.336,1276.959a.6.6,0,0,1-.595-.595v-.34a1.56,1.56,0,0,0-.617-1.3,2.491,2.491,0,0,0-1.5-.465,1.9,1.9,0,0,0-2.117,1.764v.34a.6.6,0,0,1-.595.595.6.6,0,0,1-.595-.595v-.34a3.055,3.055,0,0,1,3.307-2.953,3.055,3.055,0,0,1,3.306,2.953v.34A.594.594,0,0,1-1230.336,1276.959Z" transform="translate(1239.849 -1273.071)"/>
                            <g id="Group_1693" data-name="Group 1693" transform="translate(9.509 9.347)">
                            <path id="Path_575" data-name="Path 575" d="M-1200.966,1318.078a.6.6,0,0,1-.595-.595v-4.524a.6.6,0,0,1,.595-.595.6.6,0,0,1,.595.595v4.524A.6.6,0,0,1-1200.966,1318.078Z" transform="translate(1203.823 -1312.364)"/>
                            <path id="Path_576" data-name="Path 576" d="M-1205.951,1323.063h-4.524a.594.594,0,0,1-.595-.594.6.6,0,0,1,.595-.595h4.524a.6.6,0,0,1,.595.595A.594.594,0,0,1-1205.951,1323.063Z" transform="translate(1211.07 -1319.612)"/>
                            </g>
                        </g>
                    </svg>
                </div>
                @if($all_pro_cate->sale == 1)
                <div class="product-by-cate-title">
                    <p>{{$all_pro_cate->sale_percent}}%</p>
                    <p>off</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">

    document.querySelector('select[name="filter_product"]').addEventListener('change', function() {
        let cate_id = document.querySelector('.product-by-cate-top .title p span').getAttribute('data-id');
        console.log(cate_id);
        if(this.value == 'desc') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/product-price-desc/'+cate_id,
                type: "GET",
                data: "",
                dataType: 'json',
                success:function(response) {
                    console.log(response);
                    document.querySelector(".product-by-cate .container .box").innerHTML = '';
                    response.forEach((el, ind) => {
                        const html =  `<div class="box-container">
                                            <div class="product-by-cate-img">
                                                <a href="/product-detail/${el.id}"><img src="/upload/products/${el.img}" alt=""></a>
                                            </div>
                                            <div class="product-by-cate-name">
                                                <p>${el.name}</p>
                                            </div>
                                            <div class="product-by-cate-price" style="display: flex">
                                                
                                            </div>
                                            <div class="product-by-cate-add-cart">
                                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 15.223 15.06">
                                                    <g id="pc-cart-icon" transform="translate(0 0)">
                                                        <path id="Path_573" data-name="Path 573" d="M-1242.161,1296.776h-7.982a.9.9,0,0,1-.667-.294.9.9,0,0,1-.232-.69l.963-10.557a.9.9,0,0,1,.9-.821h9.839a.9.9,0,0,1,.9.818l.356,3.77a.6.6,0,0,1-.536.648.6.6,0,0,1-.648-.536l-.331-3.51h-9.316l-.91,9.984h7.668a.6.6,0,0,1,.595.595A.594.594,0,0,1-1242.161,1296.776Z" transform="translate(1251.046 -1281.716)"/>
                                                        <path id="Path_574" data-name="Path 574" d="M-1230.336,1276.959a.6.6,0,0,1-.595-.595v-.34a1.56,1.56,0,0,0-.617-1.3,2.491,2.491,0,0,0-1.5-.465,1.9,1.9,0,0,0-2.117,1.764v.34a.6.6,0,0,1-.595.595.6.6,0,0,1-.595-.595v-.34a3.055,3.055,0,0,1,3.307-2.953,3.055,3.055,0,0,1,3.306,2.953v.34A.594.594,0,0,1-1230.336,1276.959Z" transform="translate(1239.849 -1273.071)"/>
                                                        <g id="Group_1693" data-name="Group 1693" transform="translate(9.509 9.347)">
                                                        <path id="Path_575" data-name="Path 575" d="M-1200.966,1318.078a.6.6,0,0,1-.595-.595v-4.524a.6.6,0,0,1,.595-.595.6.6,0,0,1,.595.595v4.524A.6.6,0,0,1-1200.966,1318.078Z" transform="translate(1203.823 -1312.364)"/>
                                                        <path id="Path_576" data-name="Path 576" d="M-1205.951,1323.063h-4.524a.594.594,0,0,1-.595-.594.6.6,0,0,1,.595-.595h4.524a.6.6,0,0,1,.595.595A.594.594,0,0,1-1205.951,1323.063Z" transform="translate(1211.07 -1319.612)"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>`;
                        
                        document.querySelector('.product-by-cate .container .box').insertAdjacentHTML('beforeend', html);
                        let featureProd =  document.querySelectorAll('.product-by-cate .container .box .box-container');
                        if(el.sale == 1){
                            const html2 = `<p style="font-size: 18px">${new Intl.NumberFormat('en-EN').format(el.sale_price)}<span>VND</span></p>
                                            <p style="font-size: 14px; margin-left: 15px; text-decoration: line-through; color: #333" class="old-price">${new Intl.NumberFormat('en-EN').format(el.price)}<span>VND</span></p>`;
                            featureProd[ind].querySelector('.product-by-cate-price').insertAdjacentHTML('afterbegin', html2);
                            featureProd[ind].insertAdjacentHTML('beforeend',  `<div class="product-by-cate-title">
                                                                                    <p>${el.sale_percent}%</p>
                                                                                    <p>off</p>
                                                                                </div>`);
                        }
                        
                        else{
                            const html3 = `<p style="font-size: 18px">${new Intl.NumberFormat('en-EN').format(el.price)}<span>đ</span></p>`;
                            featureProd[ind].querySelector('.product-by-cate-price').insertAdjacentHTML('beforeend', html3);
                        }
                    })
                }
            });
        }
        else if(this.value == 'asc'){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/product-price-asc/'+cate_id,
                type: "GET",
                data: "",
                dataType: 'json',
                success:function(response) {
                    console.log(response);
                    document.querySelector(".product-by-cate .container .box").innerHTML = '';
                    response.forEach((el, ind) => {
                        const html =  `<div class="box-container">
                                            <div class="product-by-cate-img">
                                                <a href="/product-detail/${el.id}"><img src="/upload/products/${el.img}" alt=""></a>
                                            </div>
                                            <div class="product-by-cate-name">
                                                <p>${el.name}</p>
                                            </div>
                                            <div class="product-by-cate-price" style="display: flex">
                                                
                                            </div>
                                            <div class="product-by-cate-add-cart">
                                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 15.223 15.06">
                                                    <g id="pc-cart-icon" transform="translate(0 0)">
                                                        <path id="Path_573" data-name="Path 573" d="M-1242.161,1296.776h-7.982a.9.9,0,0,1-.667-.294.9.9,0,0,1-.232-.69l.963-10.557a.9.9,0,0,1,.9-.821h9.839a.9.9,0,0,1,.9.818l.356,3.77a.6.6,0,0,1-.536.648.6.6,0,0,1-.648-.536l-.331-3.51h-9.316l-.91,9.984h7.668a.6.6,0,0,1,.595.595A.594.594,0,0,1-1242.161,1296.776Z" transform="translate(1251.046 -1281.716)"/>
                                                        <path id="Path_574" data-name="Path 574" d="M-1230.336,1276.959a.6.6,0,0,1-.595-.595v-.34a1.56,1.56,0,0,0-.617-1.3,2.491,2.491,0,0,0-1.5-.465,1.9,1.9,0,0,0-2.117,1.764v.34a.6.6,0,0,1-.595.595.6.6,0,0,1-.595-.595v-.34a3.055,3.055,0,0,1,3.307-2.953,3.055,3.055,0,0,1,3.306,2.953v.34A.594.594,0,0,1-1230.336,1276.959Z" transform="translate(1239.849 -1273.071)"/>
                                                        <g id="Group_1693" data-name="Group 1693" transform="translate(9.509 9.347)">
                                                        <path id="Path_575" data-name="Path 575" d="M-1200.966,1318.078a.6.6,0,0,1-.595-.595v-4.524a.6.6,0,0,1,.595-.595.6.6,0,0,1,.595.595v4.524A.6.6,0,0,1-1200.966,1318.078Z" transform="translate(1203.823 -1312.364)"/>
                                                        <path id="Path_576" data-name="Path 576" d="M-1205.951,1323.063h-4.524a.594.594,0,0,1-.595-.594.6.6,0,0,1,.595-.595h4.524a.6.6,0,0,1,.595.595A.594.594,0,0,1-1205.951,1323.063Z" transform="translate(1211.07 -1319.612)"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>`;
                        
                        document.querySelector('.product-by-cate .container .box').insertAdjacentHTML('beforeend', html);
                        let featureProd =  document.querySelectorAll('.product-by-cate .container .box .box-container');
                        if(el.sale == 1){
                            const html2 = `<p style="font-size: 18px">${new Intl.NumberFormat('en-EN').format(el.sale_price)}<span>VND</span></p>
                                            <p style="font-size: 14px; margin-left: 15px; text-decoration: line-through; color: #333" class="old-price">${new Intl.NumberFormat('en-EN').format(el.price)}<span>VND</span></p>`;
                            featureProd[ind].querySelector('.product-by-cate-price').insertAdjacentHTML('afterbegin', html2);
                            featureProd[ind].insertAdjacentHTML('beforeend',  `<div class="product-by-cate-title">
                                                                                    <p>${el.sale_percent}%</p>
                                                                                    <p>off</p>
                                                                                </div>`);
                        }
                        
                        else{
                            const html3 = `<p style="font-size: 18px">${new Intl.NumberFormat('en-EN').format(el.price)}<span>đ</span></p>`;
                            featureProd[ind].querySelector('.product-by-cate-price').insertAdjacentHTML('beforeend', html3);
                        }
                    })
                }
            });
        }

        else{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/product-price-all/'+cate_id,
                type: "GET",
                data: "",
                dataType: 'json',
                success:function(response) {
                    console.log(response);
                    document.querySelector(".product-by-cate .container .box").innerHTML = '';
                    response.forEach((el, ind) => {
                        const html =  `<div class="box-container">
                                            <div class="product-by-cate-img">
                                                <a href="/product-detail/${el.id}"><img src="/upload/products/${el.img}" alt=""></a>
                                            </div>
                                            <div class="product-by-cate-name">
                                                <p>${el.name}</p>
                                            </div>
                                            <div class="product-by-cate-price" style="display: flex">
                                                
                                            </div>
                                            <div class="product-by-cate-add-cart">
                                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 15.223 15.06">
                                                    <g id="pc-cart-icon" transform="translate(0 0)">
                                                        <path id="Path_573" data-name="Path 573" d="M-1242.161,1296.776h-7.982a.9.9,0,0,1-.667-.294.9.9,0,0,1-.232-.69l.963-10.557a.9.9,0,0,1,.9-.821h9.839a.9.9,0,0,1,.9.818l.356,3.77a.6.6,0,0,1-.536.648.6.6,0,0,1-.648-.536l-.331-3.51h-9.316l-.91,9.984h7.668a.6.6,0,0,1,.595.595A.594.594,0,0,1-1242.161,1296.776Z" transform="translate(1251.046 -1281.716)"/>
                                                        <path id="Path_574" data-name="Path 574" d="M-1230.336,1276.959a.6.6,0,0,1-.595-.595v-.34a1.56,1.56,0,0,0-.617-1.3,2.491,2.491,0,0,0-1.5-.465,1.9,1.9,0,0,0-2.117,1.764v.34a.6.6,0,0,1-.595.595.6.6,0,0,1-.595-.595v-.34a3.055,3.055,0,0,1,3.307-2.953,3.055,3.055,0,0,1,3.306,2.953v.34A.594.594,0,0,1-1230.336,1276.959Z" transform="translate(1239.849 -1273.071)"/>
                                                        <g id="Group_1693" data-name="Group 1693" transform="translate(9.509 9.347)">
                                                        <path id="Path_575" data-name="Path 575" d="M-1200.966,1318.078a.6.6,0,0,1-.595-.595v-4.524a.6.6,0,0,1,.595-.595.6.6,0,0,1,.595.595v4.524A.6.6,0,0,1-1200.966,1318.078Z" transform="translate(1203.823 -1312.364)"/>
                                                        <path id="Path_576" data-name="Path 576" d="M-1205.951,1323.063h-4.524a.594.594,0,0,1-.595-.594.6.6,0,0,1,.595-.595h4.524a.6.6,0,0,1,.595.595A.594.594,0,0,1-1205.951,1323.063Z" transform="translate(1211.07 -1319.612)"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>`;
                        
                        document.querySelector('.product-by-cate .container .box').insertAdjacentHTML('beforeend', html);
                        let featureProd =  document.querySelectorAll('.product-by-cate .container .box .box-container');
                        if(el.sale == 1){
                            const html2 = `<p style="font-size: 18px">${new Intl.NumberFormat('en-EN').format(el.sale_price)}<span>VND</span></p>
                                            <p style="font-size: 14px; margin-left: 15px; text-decoration: line-through; color: #333" class="old-price">${new Intl.NumberFormat('en-EN').format(el.price)}<span>VND</span></p>`;
                            featureProd[ind].querySelector('.product-by-cate-price').insertAdjacentHTML('afterbegin', html2);
                            featureProd[ind].insertAdjacentHTML('beforeend',  `<div class="product-by-cate-title">
                                                                                    <p>${el.sale_percent}%</p>
                                                                                    <p>off</p>
                                                                                </div>`);
                        }
                        
                        else{
                            const html3 = `<p style="font-size: 18px">${new Intl.NumberFormat('en-EN').format(el.price)}<span>đ</span></p>`;
                            featureProd[ind].querySelector('.product-by-cate-price').insertAdjacentHTML('beforeend', html3);
                        }
                    })
                }
            });
        }
    })
    
</script>
@endsection