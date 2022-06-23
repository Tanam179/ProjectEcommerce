<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic Page Needs -->
<meta charset="utf-8">
<title>Xpoge</title>

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

{{-- AJAX --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<link type="image/x-icon" href="assets/images/fav-icon.png" rel="icon">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>
<body>
	<div class="pre-loader">
        <img src="{{asset('assets/images/pre_load.gif')}}" alt="">
    </div>

    <div class="header">
        <div class="container">
            <div class="logo">
                <a href="/">HAPPY SHOE</a>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="#">Về chúng tôi</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            <div class="user">
                <div class="search-ic">
                    <i class="ph-magnifying-glass-light"></i>
                    <form action="#">
                        <input type="text" name="search_product" class="search_product" placeholder="Nhập tên sản phẩm cần tìm">
                        <div class="drop-down-list">
                            {{-- <div class="drop-down-item">
                                <a href="#">
                                    <div class="product-search-img">
                                        <img src="/upload/products/3-1.jpg" alt="">
                                    </div>
                                    <div class="product-search-name">
                                        <p>Giày Bóng Rổ Nike Air Max Impact CI1396-004 Màu Đen Trắng</p>
                                    </div>
                                </a>
                            </div>
                            <div class="drop-down-item">
                                <a href="#">
                                    <div class="product-search-img">
                                        <img src="/upload/products/3-1.jpg" alt="">
                                    </div>
                                    <div class="product-search-name">
                                        <p>Giày Bóng Rổ Nike Air Max Impact CI1396-004 Màu Đen Trắng</p>
                                    </div>
                                </a>
                            </div>
                            <div class="drop-down-item">
                                <a href="#">
                                    <div class="product-search-img">
                                        <img src="/upload/products/3-1.jpg" alt="">
                                    </div>
                                    <div class="product-search-name">
                                        <p>Giày Bóng Rổ Nike Air Max Impact CI1396-004 Màu Đen Trắng</p>
                                    </div>
                                </a>
                            </div> --}}
                        </div>
                        <button class="search_product_btn" type="submit">Tìm kiếm</button>
                    </form>
                </div>
                <div class="account-ic">
                    <a href="{{URL::to('login')}}"><i class="ph-user-light"></i></a>
                </div>
                <div class="cart-ic">
                    <i class="ph-shopping-cart-simple-light"></i>
                    <p>3</p>
                </div>
            </div>
        </div>
        <div class="cart-session">
            <div class="title">
                <p>giỏ hàng của bạn: <span>( 3 sản phẩm )</span></p>
                <i class="ph-x close-cart-session"></i>
            </div>
            <div class="cart-items" style="position: relative">
                @if(Auth::user() && Auth::user()->role == 'customer')
                    @if($hasCart)
                    @foreach($all_cart as $all_cart)
                    <div class="cart-item">
                        <input type="hidden" value="{{$all_cart->id}}" class="cart_item_hidden_id">
                        <input type="hidden" value="{{Auth::id()}}" class="cart_item_hidden_user_id">
                        <input type="hidden" value="{{$all_cart->product_id}}" class="cart_item_hidden_product_id">
                        <input type="hidden" value="{{$all_cart->product_size}}" class="cart_item_hidden_size">
                        <div class="cart-item-img">
                            <img src="/upload/products/{{$all_cart->product->img}}" alt="">
                        </div>
                        <div class="cart-item-variant">
                            <div class="cart-item-name">
                                <p>{{$all_cart->product->name}}</p>
                            </div>
                            <div class="cart-item-price">
                                <span class="price">{{($all_cart->product->sale_price)}}</span>
                                <span class="currency">đ</span>
                            </div>
                            <div class="cart-item-options">
                                <div class="cart-item-size">
                                    <span>Size: </span>
                                    <select style="font-size: 12px ;margin-left: 10px ;width: 60px; padding: 5px 1px; border: 1px solid rgba(0,0,0,0.08); color: #666" name="change_size_cart" class="change_size_cart">
                                        @foreach(explode('|', $all_cart->product->size) as $size)
                                        <option value="{{$size}}" @if($all_cart->product_size == $size) selected @endif>{{$size}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <span>{{$all_cart->product->size}}</span> --}}
                                    {{-- <span>{{$all_cart->product_size}}</span> --}}
                                </div>
                                <div class="cart-item-quantity">
                                    <button class="asc-quantity">+</button>
                                    <input class="quantity" type="number" readonly name="" min="1" value="{{$all_cart->product_quantity}}" max="5">
                                    <button class="desc-quantity">-</button>
                                </div>
                            </div>
                        </div>
                        <div class="delete-cart-item">
                            <i class="ph-x"></i>
                        </div>
                    </div>
                    {{-- <div class="cart-item">
                        <div class="cart-item-img">
                            <img src="{{asset('assets/images/product-8.jpg')}}" alt="">
                        </div>
                        <div class="cart-item-variant">
                            <div class="cart-item-name">
                                <p>Giày Nike Nam sang trọng</p>
                            </div>
                            <div class="cart-item-price">
                                <span class="price">100</span>
                                <span class="currency">đ</span>
                            </div>
                            <div class="cart-item-options">
                                <div class="cart-item-size">
                                    <span>Size: </span>
                                    <span>42</span>
                                </div>
                                <div class="cart-item-quantity">
                                    <button class="asc-quantity">+</button>
                                    <input class="quantity" type="number" readonly name="" min="1" value="1" max="5">
                                    <button class="desc-quantity">-</button>
                                </div>
                            </div>
                        </div>
                        <div class="delete-cart-item">
                            <i class="ph-x"></i>
                        </div>
                    </div>
                    <div class="cart-item">
                        <div class="cart-item-img">
                            <img src="{{asset('assets/images/product-9.jpg')}}" alt="">
                        </div>
                        <div class="cart-item-variant">
                            <div class="cart-item-name">
                                <p>Giày Nike Nam sang trọng</p>
                            </div>
                            <div class="cart-item-price">
                                <span class="price">100</span>
                                <span class="currency">đ</span>
                            </div>
                            <div class="cart-item-options">
                                <div class="cart-item-size">
                                    <span>Size: </span>
                                    <span>42</span>
                                </div>
                                <div class="cart-item-quantity">
                                    <button class="asc-quantity">+</button>
                                    <input class="quantity" type="number" readonly name="" min="1" value="1" max="5">
                                    <button class="desc-quantity">-</button>
                                </div>
                            </div>
                        </div>
                        <div class="delete-cart-item">
                            <i class="ph-x"></i>
                        </div>
                    </div>
                    <div class="cart-item">
                        <div class="cart-item-img">
                            <img src="{{asset('assets/images/product-9.jpg')}}" alt="">
                        </div>
                        <div class="cart-item-variant">
                            <div class="cart-item-name">
                                <p>Giày Nike Nam sang trọng</p>
                            </div>
                            <div class="cart-item-price">
                                <span class="price">100</span>
                                <span class="currency">đ</span>
                            </div>
                            <div class="cart-item-options">
                                <div class="cart-item-size">
                                    <span>Size: </span>
                                    <span>42</span>
                                </div>
                                <div class="cart-item-quantity">
                                    <button class="asc-quantity">+</button>
                                    <input class="quantity" type="number" readonly name="" min="1" value="1" max="5">
                                    <button class="desc-quantity">-</button>
                                </div>
                            </div>
                        </div>
                        <div class="delete-cart-item">
                            <i class="ph-x"></i>
                        </div>
                    </div> --}}
                    @endforeach
                    @else

                        <div class="empty-cart" style="position: absolute; top: 0%; left: 0%; width: 100%; height: 100%; background: url('/upload/error/empty_cart.png'); background-position: center; background-size: contain; background-repeat: no-repeat;">
                            <p style="position: absolute; bottom: 15%; left: 50%; transform: translateX(-50%); text-transform: capitalize; width: 100%; text-align: center">giỏ hàng của bạn đang trống</p>
                        </div>
                    @endif
                @else
                <div class="have-to-login" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; line-height: 1.5; font-size: 18px; opacity: 0.8;">
                    <p>Bạn cần phải đăng nhập để thêm sản phẩm vào giỏ hàng</p>
                </div>
                @endif
            </div>
            <div class="check-out-cart">
                <div class="cart-price">
                    <p>Tổng thanh toán:</p>
                    <p class="price">3,200,000<span>đ</span></p>
                </div>
                <div class="cart-checkout">
                    <a href="/cart-checkout">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
    
    
    @yield('content')

    <div class="footer">
        <div class="container">
            <div class="box-container">
                <h4 class="footer-title">HAPPY SHOE</h4>
                <div class="map">
                    <i class="ph-map-pin"></i>
                    <p>Số 2D đường 3 tháng 2, P.12, Q.10</p>
                </div>
                <p>Tư vấn mua hàng(8:00 - 17:00):</p>
                <div class="phone">
                    <i class="ph-phone"></i>
                    <p>0934 003 403</p>
                </div>
                <p>Chăm sóc khách hàng</p>
                <div class="phone-2">
                    <i class="ph-phone"></i>
                    <p>0916 12 17 19</p>
                </div>
                <div class="mail">
                    <i class="ph-envelope-simple"></i>
                    <p>online@happyshoe.com.vn</p>
                </div>
                <div class="globe">
                    <i class="ph-globe-hemisphere-west"></i>
                    <p>shoe.happyshoe.com</p>
                </div>
            </div>
            <div class="box-container">
                <h4 class="footer-title">THÔNG TIN</h4>
                <p>Liên hệ</p>
                <p>Giới thiệu</p>
                <p>Lịch sử hình thành</p>
                <p>Tầm nhìn sứ mệnh</p>
                <p>Website Shoe</p>
            </div>
            <div class="box-container">
                <h4 class="footer-title">HỖ TRỢ</h4>
                <p>Hướng dẫn thanh toán</p>
                <p>Hướng dẫn đổi trã hàng</p>
                <p>Hướng dẫn tìm cửa hàng</p>
                <p>Hướng dẫn mua hàng online</p>
                <p>Chính sách khách hàng thân thiến</p>
            </div>
            <div class="box-container">
                <h4 class="footer-title">CHÍNH SÁCH</h4>
                <p>Quy định đổi trả</p>
                <p>Quy định bảo hành</p>
                <p>Trung tâm bảo hành</p>
                <p>Điều khoản dịch vụ</p>
                <p>Chính sách bảo mật</p>
                <div class="social">
                    <i class="ph-facebook-logo-light"></i>
                    <i class="ph-youtube-logo-light"></i> 
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/phosphor-icons"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
		
	
</body>

</html>
