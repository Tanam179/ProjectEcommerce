@extends('welcome')
@section('content')
<div class="information">
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
    <div class="container">
        <form method="POST" enctype="multipart/form-data" id="user_form" >
        @csrf
        <div class="user-information">
            <div class="avatar">
                <label style="background: url('/upload/avatar/{{Auth::user()->avatar}}'); background-position: center; background-size: cover" for="avatar">
                    <div class="img">
                        <img src="https://happyhow.me/1428355432291766272/d/images/heraldic.svg" alt="">
                    </div></label>
                <input type="file" id="avatar" name="avatar">
                
            </div>
            <div class="user-name">
                <p>{{Auth::user()->name}}</p>
                <p>{{Auth::user()->email}}</p>
            </div>
            <div class="change-information">
                <a href="/change-password">Thay đổi mật khẩu </a>
            </div>
            <div class="user-logout">
                <a href="/log-out">
                    <i class="ph-sign-out-bold"></i>
                    <p>Đăng xuất</p>
                </a>
            </div>
            <!-- <button></button> -->
        </div>
        </form>
        <div class="order-information">
            <div class="title">
                <p>Thông tin đơn hàng</p>
            </div>
            <div class="order-top">
                <div class="order-type order-type-active">
                    <p>Chờ xử lý</p>
                </div>
                <div class="order-type">
                    <p>Đã xử lý</p>
                </div>
                <div class="order-type">
                    <p>Đã thanh toán</p>
                </div>
            </div>
            <div class="order-position">
                <div class="order-bottom order-bottom-show">
                    @foreach($order_progressing as $progressing)
                        @foreach(App\Models\OrderItems::where('order_id', $progressing->id)->get() as $result)
                        <div class="order-content">
                            <div class="order-image">
                                <img src="/upload/products/{{$result->product->img}}" alt="" width="150px" height="120px">
                            </div>
                            <div class="order-variant">
                                <div class="order-name">
                                    <p>{{$result->product->name}}</p>
                                </div>
                                <div class="order-size">
                                    <p>{{$result->product_size}}</p>
                                </div>
                                <div class="order-quantity-price">
                                    <p>{{$result->product_quantity}}</p>
                                    <p>x</p>
                                    <p>{{$result->product->sale_price}}</p>

                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                    <div class="cancel-order" style="display: flex; justify-content: flex-end; margin-top: 20px;">
                        <a href="/cancel-orders/{{Auth::id()}}">Hủy đơn hàng</a>
                    </div>
                    {{-- <div class="order-content">
                        <div class="order-image">
                            <img src="./images/1.jpg" alt="" width="150px" height="120px">
                        </div>
                        <div class="order-variant">
                            <div class="order-name">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis, facere.</p>
                            </div>
                            <div class="order-size">
                                <p>38</p>
                            </div>
                            <div class="order-quantity-price">
                                <p>2</p>
                                <p>x</p>
                                <p>155000</p>
                            </div>
                        </div>
                    </div> --}}
                    
                </div>
                <div class="order-bottom">
                    @foreach($order_progressed as $progressed)
                        @foreach(App\Models\OrderItems::where('order_id', $progressed->id)->get() as $result)
                        <div class="order-content">
                            <div class="order-image">
                                <img src="/upload/products/{{$result->product->img}}" alt="" width="150px" height="120px">
                            </div>
                            <div class="order-variant">
                                <div class="order-name">
                                    <p>{{$result->product->name}}</p>
                                </div>
                                <div class="order-size">
                                    <p>{{$result->product_size}}</p>
                                </div>
                                <div class="order-quantity-price">
                                    <p>{{$result->product_quantity}}</p>
                                    <p>x</p>
                                    <p>{{$result->product->sale_price}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="order-bottom">
                    @foreach($order_paid as $paid)
                        @foreach(App\Models\OrderItems::where('order_id', $paid->id)->get() as $result)
                        <div class="order-content">
                            <div class="order-image">
                                <img src="/upload/products/{{$result->product->img}}" alt="" width="150px" height="120px">
                            </div>
                            <div class="order-variant">
                                <div class="order-name">
                                    <p>{{$result->product->name}}</p>
                                </div>
                                <div class="order-size">
                                    <p>{{$result->product_size}}</p>
                                </div>
                                <div class="order-quantity-price">
                                    <p>{{$result->product_quantity}}</p>
                                    <p>x</p>
                                    <p>{{$result->product->sale_price}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector('.user-information .avatar input').addEventListener('change', function() {
        let myform = document.querySelector('#user_form');
        let formData = new FormData(myform);
        let userId = document.querySelector('input[name="user_id"]').value;
        // let imgValue = this.value;
        // let _token = document.querySelector('input[name="_token"]').value;
        // console.log(imgValue);
        let reader = new FileReader();
        reader.onload = function(event) {
            // console.log(document.querySelector('.user-information .avatar label'));
            document.querySelector('.user-information .avatar label').style.background = `url(${reader.result})`;
            document.querySelector('.user-information .avatar label').style.backgroundPosition= 'center';
            document.querySelector('.user-information .avatar label').style.backgroundSize = 'cover';
            // console.log(reader.result);
            // const html = `<img src="${reader.result}" alt="" width="150px" height="150px" style="margin-top: 10px">`
            // document.querySelector('.img-preview').insertAdjacentHTML('afterbegin', html);
        };
        reader.readAsDataURL(this.files[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/update-avatar/'+userId,
            type: 'POST',
            contentType: false,
            data: formData,
            dataType: 'JSON',
            cache: false,
            processData: false,
            
            success:function(response) {
                alert(response.status);
            }
        });
    })

    document.querySelectorAll('.order-type').forEach((el, ind) => {
        el.addEventListener('click', function() {
            document.querySelectorAll('.order-type').forEach(el =>{
                el.classList.remove('order-type-active');
            });
            document.querySelectorAll('.order-bottom').forEach(el => {
                el.classList.remove('order-bottom-show');
            });
            document.querySelectorAll('.order-bottom')[ind].classList.add('order-bottom-show');
            el.classList.add('order-type-active');
        })
    })

    const firstOrder =  document.querySelectorAll('.order-bottom')[0];

    if(firstOrder.querySelectorAll('.order-content').length == 0){
        firstOrder.querySelector('.cancel-order').style.display = 'none';
    }
    else if(firstOrder.querySelectorAll('.order-content').length >= 1){
        firstOrder.querySelector('.cancel-order').style.display = 'flex';
    }
    console.log(firstOrder.querySelectorAll('.order-content').length);
</script>
@endsection