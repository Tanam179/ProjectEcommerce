@extends('welcome')
@section('content')

    <div class="slider">
        @foreach($all_slider as $value)
        <img src="/upload/sliders/{{$value->img}}" alt="">
        @endforeach
    </div>
    <div class="slogan">
        <div class="container">
            <div class="genuine">
                <img src="{{asset('assets/images/icon_genuine.png')}}" alt="">
                <div class="genuine-title">
                    <p>Chính hãng 100%</p>
                    <span>Nhà phân phối ủy quyền</span>
                </div>
            </div>
            <div class="freeship">
                <img src="{{asset('assets/images/icon_freeship.png')}}" alt="">
                <div class="freeship-title">
                    <p>Giao hàng toàn quốc</p>
                    <span>Freeship với bất kỳ đơn hàng nào</span>
                </div>
            </div>
            <div class="insurance">
                <img src="{{asset('assets/images/icon_insurance.png')}}" alt="">
                <div class="insurance-title">
                    <p>Bảo hành chính hãng</p>
                    <span>Bảo hành các loại giày 5 năm </span>
                </div>
            </div>
        </div>
    </div>
    <div class="all-category">
        <div class="container">
            <div class="title">
                <p>danh mục sản phẩm</p>
                <div class="line-through"></div>
            </div>
            <div class="box">
                @foreach($all_category as $cate)
                <div class="box-container">
                    <div class="all-category-img">
                        <img src="upload/products/{{$cate->image}}" alt="">
                    </div>
                    <div class="all-category-name">
                        <p>{{$cate->name}}</p>
                    </div>
                    <div class="all-category-watch-more">
                        <a href="/product/{{$cate->id}}">xem thêm</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="new-product">
        <div class="container">
            <div class="title">
                <p>sản phẩm mới</p>
                <div class="line-through"></div>
            </div>
            <div class="box">
                @foreach($new_product as $new_pro)
                <div class="box-container">
                    <div class="new-product-img">
                        <a href="/product-detail/{{$new_pro->id}}"><img src="/upload/products/{{$new_pro->img}}" alt=""></a>
                    </div>
                    <div class="new-product-name">
                        <p>{{$new_pro->name}}</p>
                    </div>
                    <div class="new-product-price" style="display: flex; align-items: flex-end">
                        @if($new_pro->sale == 1)
                        <p>{{number_format($new_pro->sale_price)}} <span>đ</span></p>
                        <p style="font-size: 14px; margin-left: 15px; text-decoration: line-through; color: #333" class="old-price">{{number_format($new_pro->price , 0 , ',' , ',' )}} đ</p>
                        <div class="sale-percent" style="font-size: 10px; margin-left: auto; display: flex; align-items: center; padding: 5px 10px; border: 1px solid #ff3945;">
                            <p style="margin-right: 5px">{{$new_pro->sale_percent}}%</p>
                            <p>OFF</p>
                        </div>
                        @else
                        <p>{{number_format($new_pro->price , 0 , ',' , ',' )}}<span>đ</span></p>
                        @endif
                    </div>
                    <div class="new-product-add-cart">
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
                    <div class="new-product-title">
                        <p>new</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="sale-product">
        <div class="container">
            <div class="title">
                <p>sản phẩm giảm giá</p>
                <div class="line-through"></div>
            </div>
            <div class="box">
                @foreach($product_sale as $pro_sale)
                <div class="box-container">
                    <div class="sale-product-img">
                        <a href="/product-detail/{{$pro_sale->id}}"><img src="/upload/products/{{$pro_sale->img}}" alt=""></a>
                    </div>
                    <div class="sale-product-name">
                        <p>{{$pro_sale->name}}</p>
                    </div>
                    <div class="sale-product-price">
                        <p>{{number_format($pro_sale->sale_price)}} <span>đ</span></p>
                        <p class="old-price">{{number_format($pro_sale->price , 0 , ',' , ',' )}}<span>đ</span></p>
                    </div>
                    <div class="sale-product-add-cart">
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
                    <div class="sale-product-title">
                        <p>{{$pro_sale->sale_percent}}%</p>
                        <p>OFF</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="stylish">
        <div class="title">
            <p>Phong cách sản phẩm chúng tôi</p>
        </div>
        <div class="container">
            <div class="fashion">
                <div class="stylish-img">
                    <img src="{{asset('assets/images/fashion.jpg')}}" alt="">
                </div>
                <div class="fashion-content">
                    <p>TRẺ TRUNG</p>
                </div>
            </div>
            <div class="sport">
                <div class="stylish-img">
                    <img src="{{asset('assets/images/sporgt.jpg')}}" alt="">
                </div>
                <div class="sport-content">
                    <p>THỂ THAO</p>
                </div>
            </div>
            <div class="modern">
                <div class="stylish-img">
                    <img src="{{asset('assets/images/modern2.jpg')}}" alt="">
                </div>
                <div class="fashion-content">
                    <p>NĂNG ĐỘNG</p>
                </div>
            </div>
        </div>
    </div>

    <div class="contact">
        <div class="container">
            <div class="contact-left">
                <div class="contact-left-image">
                    <img src="{{asset('assets/images/image_email.png')}}" alt="">
                </div>
                <div class="contact-left-title">
                    <h4>Đăng ký nhận tin</h4>
                    <p>Hãy để lại email để nhận ưu đãi nhiều hơn</p>
                </div>
            </div>
            <div class="contact-right">
                <input type="text" placeholder="Nhập địa chỉ email">
                <button>Đăng ký</button>
            </div>
        </div>
    </div>


{{-- <script>
    // const tabs = document.querySelectorAll('#tabs li a');
    
    // for(let i = 0; i < tabs.length; i++){
    //     tabs[i].addEventListener('click', function() {
    //         for(let j = 0; j < tabs.length; j++){
    //             tabs[j].classList.remove('active');
    //         }
    //         tabs[i].classList.add('active');
    //     })
    // };

    // tabs[0].addEventListener('click', function() {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //             url: '/product-all/',
    //             type: "GET",
    //             data: "",
    //             dataType: 'json',
    //             success:function(response) {
    //                 console.log(response);
    //                 document.querySelector('#all').innerHTML = "";
    //                 response.forEach((el, ind) => {
    //                     const html = `<div class="featured-product mb-25">
    //                                     <div class="product-img transition mb-15">
    //                                         <a href="/product-detail/${el.id}">
    //                                             <img src="/upload/products/${el.img}" alt="product" class="transition">
    //                                         </a>
                                            
    //                                         <div class="sale-label">
                                                
    //                                         </div>;
                                            
    //                                         <div class="product-details-btn text-uppercase text-center transition">
    //                                             <a href="product-quick-view.html" class="quick-popup">Quick View</a>
    //                                         </div>
    //                                     </div>
    //                                     <div class="product-desc">
    //                                         <a style="display: block; font-size: 16px; margin-top: 10px; text-align: center" href="product-detail.html" class="product-name text-uppercase">${el.name}</a>
    //                                         <div class="product-desc-price" style="text-align: center">
    //                                         </div>
    //                                     </div>
    //                                 </div>`;
    //                     bduct-desc .product-desc-price').innerHTML = `
    //                             <span style="display: inline-block; font-size: 16px; margin-top: 10px; color: #333; font-weight: 500; text-decoration: line-through; padding-right: 5px;" class="old-price">${new Intl.NumberFormat('en-EN').format(el.price)} VNĐ</span>
    //                             <span style="display: inline-block; font-size: 16px; margin-top: 10px; color: #f22a59; font-weight: 500; padding-left: 5px;" class="new-price">${new Intl.NumberFormat('en-EN').format(el.price - (el.price * el.sale_percent / 100))} VNĐ</span>`

    //                     }
    //                     else{
    //                         let featureProd =  document.querySelectorAll('.featured-product');
    //                         featureProd[ind].querySelector('.product-desc .product-desc-price').innerHTML = `
    //                             <span style="display: inline-block; font-size: 16px; margin-top: 10px; color: #f22a59; font-weight: 500;" class="old-price">${new Intl.NumberFormat('en-EN').format(el.price)} VNĐ</span>`;
    //                     }


    //                 })
    //             }
    //         });
    //     });
    // });
    
</script> --}}
@endsection