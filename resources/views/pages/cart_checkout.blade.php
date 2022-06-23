@extends('welcome')
@section('content')

<div class="cart-checkout">
    <div class="container">
        <form class="infor-contact" action="/cart-payment" method="POST">
        @csrf
        <div class="cart-checkout-left">
            @if (session('error_message'))
            <div class="container" style="margin-bottom: 25px;">
                <div class="alert" style="background: rgba(242,42,89,0.2); padding: 10px 25px; border: 1px solid #f22a59; color: #000">
                    <span style="font-size: 15px;">
                        {{ session()->get('error_message') }}
                    </span>
                </div>
                </div>
            @endif
            <div class="title">
                <p>thông tin liên lạc</p>
                <div class="line-through"></div>
            </div>
            <input type="text" name="user_cart_name" placeholder="Họ tên" value="{{Auth::user()->name}}" readonly>
            <input type="email" name="user_cart_email" placeholder="Email" value="{{Auth::user()->email}}" readonly>
            <input type="text" name="user_cart_phone" placeholder="Số điện thoại">
            
            {{-- <input type="text" name="" placeholder="Phường">
            <input type="text" name="" placeholder="Quận huyện"> --}}
            {{-- <input type="text" name="" placeholder="Tỉnh thành"> --}}
            <div class="address-select">
                <select name="user_cart_country" id="">
                    <option value="">---Tỉnh thành---</option>
                    @foreach($city as $city)
                    <option value="{{$city->id}}">{{$city->name_thanhpho}}</option>
                    @endforeach
                </select>
                <select name="user_cart_district" id="">
                    <option value="">---Quận/Huyện---</option>
                    {{-- @foreach($district as $district)
                    <option value="{{$district->tpid}}">{{$district->name_quanhuyen}}</option>
                    @endforeach --}}
                </select>
                <select name="user_cart_ward" id="">
                    <option value="">---Phường/Xã---</option>
                    {{-- @foreach($ward as $ward)
                    <option value="{{$ward->qhid}}">{{$ward->name_xaphuong}}</option>
                    @endforeach --}}
                </select>
            </div>
            <input type="text" name="user_cart_address" placeholder="Địa chỉ">
            
            <div class="separate-line separate-line--gradient"></div>
            <div class="payments-method">
                <div class="payment-method-title">
                    <img src="https://happyhow.me/1428355432291766272/d/images/checkout-2.svg" alt="">
                    <p>Phương thức thanh toán</p>
                </div>
                <div class="payment">
                    <div class="payment-left">
                        <img src="https://happyhow.me/1428355432291766272/images/desk/payments/1464144515332837376.svg" alt="">
                        <p>Tiền mặt</p>
                    </div>
                    <div class="payment-radio"></div>
                </div>
                <div class="attention">
                    <p>Tiền mặt: <span>Bạn sẽ thanh toán bằng tiền mặt cho nhân viên giao hàng khi thanh toán. Vui lòng kiểm tra tình trạng sản phẩm và hóa đơn khi thanh toán.</span></p>
                </div>
            </div>
            <!-- <div class="note">
                <div class="note-top">
                    <i class="ph-notepad-light"></i>
                    <p>ghi chú</p>
                </div>
                <textarea name="note_cart" rows="10" placeholder="Lời nhắn của bạn"></textarea>
            </div> -->
        </div>
        <div class="cart-checkout-right">
            <div class="title">
                <p>thông tin đơn hàng</p>
                <div class="line-through"></div>
            </div>
            <div class="carts-checkout">
                @foreach($cart_of_user_id as $cart)
                <div class="cart">
                    <div class="cart-checkout-img">
                        <img src="/upload/products/{{$cart->product->img}}" alt="">
                    </div>
                    <div class="cart-checkout-variant">
                        <div class="cart-checkout-name">
                            <p>{{$cart->product->name}}</p>
                        </div>
                        <div class="cart-checkout-quantity-price">
                            <span class="quantity-checkout">{{$cart->product_quantity}}</span>
                            <span class="minus">x</span>
                            <span class="price-checkout">{{$cart->product->sale_price}}<span>đ</span></span>
                        </div>
                        <div class="cart-checkout-size">
                            <span class="size-checkout">{{$cart->product_size}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="cart-checkout-fee">
                <div class="total">
                    <p>tổng cộng</p>
                    <span>3000000<span>đ</span></span>
                </div>
                <div class="endow">
                    <p>ưu đãi</p>
                    <span>0<span>đ</span></span>
                </div>
                <div class="payment-fee">
                    <p>Phí giao hàng</p>
                    <span>0<span>đ</span></span>
                </div>
            </div>
            <div class="real-total">
                <p>Tổng thanh toán</p>
                <span>3000000<span>đ</span></span>
            </div>
            <div class="order">
                <button type="submit">Tiến hành đặt hàng</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    let total = 0; 
    document.querySelectorAll('.carts-checkout .cart').forEach(el => {
        document.querySelector('.cart-checkout-fee .total span').textContent
        el.querySelector('.price-checkout').textContent = `${(new Intl.NumberFormat('en-EN').format(el.querySelector('.price-checkout').textContent.replace('đ', '')))}đ`;
        total = `${Number(total) + Number(el.querySelector('.price-checkout').textContent.replace('đ', '').split(',').join('')) * Number(el.querySelector('.quantity-checkout').textContent)}`;
        console.log(total);
        document.querySelector('.cart-checkout-fee .total span').textContent = `${new Intl.NumberFormat('en-EN').format(total)}đ`;
    })

    let realTotal = `${Number(document.querySelector('.cart-checkout-fee .total span').textContent.replace('đ', '').split(',').join('')) - Number(document.querySelector('.endow span').textContent.replace('đ', '')) + Number( document.querySelector('.payment-fee span').textContent.replace('đ', ''))}`
    document.querySelector('.real-total span').textContent = `${new Intl.NumberFormat('en-EN').format(realTotal)}đ`;



    document.querySelector('select[name="user_cart_country"]').addEventListener('change', function(){
        let thanhPhoId = this.value;
        let ward =  document.querySelector('select[name="user_cart_ward"]');
        ward.innerHTML = '';
        let html1 = `<option value="">---Phường/Xã---</option>`;
        ward.insertAdjacentHTML('afterbegin', html1);
        let district =  document.querySelector('select[name="user_cart_district"]');
        district.innerHTML = '';
        let html2 = `<option value="">---Quận/Huyện---</option>`;
        district.insertAdjacentHTML('afterbegin', html2);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/select-district',
            type: "POST",
            data: {
                "thanhPhoId": thanhPhoId,
            },
            dataType: 'json',
            success:function(response) {
                let district =  document.querySelector('select[name="user_cart_district"]');
                // district.innerHTML = '';
                response.forEach(el => {
                    const html = `<option value="${el.id}">${el.name_quanhuyen}</option>`;
                    district.insertAdjacentHTML('beforeend', html);
                })
            }
        });
    });

    document.querySelector('select[name="user_cart_district"]').addEventListener('change', function(){
        let districtId = this.value;
        let ward =  document.querySelector('select[name="user_cart_ward"]');
        ward.innerHTML = '';
        let html1 = `<option value="">---Phường/Xã---</option>`;
        ward.insertAdjacentHTML('afterbegin', html1);
        console.log(this.value);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/select-ward',
            type: "POST",
            data: {
                "districtId": districtId,
            },
            dataType: 'json',
            success:function(response) {
                let ward =  document.querySelector('select[name="user_cart_ward"]');
                // ward.innerHTML = '';
                response.forEach(el => {
                    const html = `<option value="${el.name_xaphuong}">${el.name_xaphuong}</option>`;
                    ward.insertAdjacentHTML('beforeend', html);
                })
                // console.log(response);
            }
        });
    });
</script>
@endsection