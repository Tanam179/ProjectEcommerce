@extends('welcome')
@section('content')

<div class="product-detail">
    <div class="container">
        <div class="product-detail-img">
            <div class="product-detail-main-img">
                <img src="/upload/products/{{$product_detail->img}}" alt="">
            </div>
            <div class="product-detail-img-list">
                <img class="show" src="/upload/products/{{$product_detail->img}}" alt="">
                @foreach($product_detail_imgs_relate as $pro_img_relate)
                <img src="/upload/products/{{$pro_img_relate}}" alt="">
                @endforeach
            </div>
        </div>
        <div class="product-detail-content">
            <input type="hidden" value="{{$product_detail->id}}" class="pro_id_hidden">
            <div class="product-detail-name">
                <p>{{$product_detail->name}}</p>
            </div>
            <div class="product-detail-price" style="display: flex; align-items: flex-end">
                @if($product_detail->sale == 1)
                    <p class="price" style="font-size: 20px">{{number_format($product_detail->sale_price)}} <span>đ</span></p>
                    <p style="font-size: 14px; margin-left: 15px; text-decoration: line-through; color: #333" class="old-price">{{number_format($product_detail->price , 0 , ',' , ',' )}} đ</p>
                    <div class="sale-percent" style="font-size: 10px; margin-left: 30px; display: flex; align-items: center; padding: 5px 10px; border: 1px solid #ff3945">
                        <p style="margin-right: 5px">{{$product_detail->sale_percent}}%</p>
                        <p>OFF</p>
                    </div>
                @else
                {{-- <span style="font-size: 22px " class="old-price"></span> --}}
                    <p class="price" style="font-size: 20px">{{number_format($product_detail->price , 0 , ',' , ',' )}}<span>đ</span></p>
                @endif
               
            </div>
            <div class="product-detail-desc">
                <p>{{$product_detail->description}}</p>
            </div>
            <div class="hr"></div>
            <div class="product-detail-size">
                <label for="">Chọn size:</label>
                <div class="form-group">
                     <div class="sizes">
                        @foreach($product_detail_sizes as $size) 
                        <input type="radio" name="size" class="btn-check" id="size-{{$size}}" autocomplete="off" name="size" value="{{$size}}">
                        <label class="btn btn-outline-dark" for="size-{{$size}}">{{$size}}</label><br>
                        @endforeach
                    </div> 
                    {{-- <select name="size">
                        @foreach($product_detail_sizes as $size) 
                        <option value="{{$size}}">{{$size}}</option>
                        @endforeach
                    </select> --}}
                </div>
            </div>
            <div class="product-detail-quantity">
                <label>Số lượng: </label>
                <div class="count-quantity">
                    <button type="button" class="asc-quanti">
                        <i class="ph-plus"></i>
                    </button>
                    <input class="quantity" name="quantity" type="text" readonly min="1" max="5" value="1">
                    <button type="button" class="desc-quanti">
                        <i class="ph-minus"></i>
                    </button>
                </div>
            </div>
            <div class="product-category" style="display: flex; align-items: center; margin-top: 50px; margin-bottom: 10px;">
                <label style="font-weight: 600">Thương hiệu: </label>
                <p style="margin-left: 30px; text-transform: uppercase; font-weight: 600">{{$product_detail->cate->name}}</p>
            </div>
            <div class="hr2"></div>
            <div class="product-detail-add-cart">
                <button type="submit">
                    Thêm vào giỏ hàng
                </button>
            </div>
        </div>
    </div>
</div>
<div class="comments">
    <div class="container">
        <div class="title">
            <p>BÌNH LUẬN </p>
        </div>
        @if(Auth::user())
        <div class="post-comment" style="display: flex;">
            <img src="/upload/avatar/{{Auth::user()->avatar}}" alt="" width="55px" height="55px" style="border-radius: 50%; object-fit: cover; border: 1px solid rgba(0, 0, 0, 0.08)">
            <input type="text" name="message-upload" style="flex: 1; padding: 15px 0; margin: 0 30px" placeholder="Viết cảm nghĩ của bạn về sản phẩm" >
            <input type="hidden" name="hidden_comment_user_id" value="{{Auth::user()->id}}">
            <button style="padding: 0 50px; background: #ff3945; color: #fff; cursor: pointer;" type="submit">Gửi Bình Luận</button>
        </div>
        @else
        <div class="no-loggin" style="padding: 15px; background: #ff3945; color: #fff; margin-bottom: 20px;">
            <p>Bạn cần phải đăng nhập mới có thể viết bình luận</p>
        </div>
        @endif
        @if($hasComment)
        @foreach($comment as $comment)
        <div class="comment">
            <input type="hidden" value="{{$comment->id}}" name="hidden_comment_id">
            <div class="comment-avatar">
                <img src="/upload/avatar/{{$comment->user->avatar}}" alt="">
            </div>
            <div class="comment-title">
                <div class="comment-name-date">
                    <p>{{$comment->user->name}}</p>
                    <span>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                </div>
                <div class="comment-message">
                    <p>{{$comment->message}}</p>
                </div>
                <div class="reply">
                    <button style="cursor: pointer;" type="submit">Phản hồi</button>
                </div>
            </div>
        </div>
        @foreach(App\Models\ReplyModel::where('comment_id', $comment->id)->get() as $reply)
        <div class="replies">
            <div class="reply-avatar">
                <img src="/upload/avatar/{{$reply->user->avatar}}" alt="">
            </div>
            <div class="reply-title">
                <div class="reply-name-date">
                    <p>{{$reply->user->name}}</p>
                    <span>{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</span>
                </div>
                <div class="reply-message">
                    <p>{{$reply->message}}</p>
                </div>
                <div class="reply">
                    <button style="cursor: pointer;" type="submit">Phản hồi</button>
                </div>
            </div>
        </div>
        @endforeach
        @endforeach
        @else
            <div class="no-comment" style="text-align: center">
                <p>Tạm thời chưa có bình luận nào, bạn hãy để lại bình luận đầu tiên</p>
            </div>
        @endif
    </div>
</div>
<div class="product-relate">
    <div class="container">
        <div class="title">
            <p>có thể bạn sẽ quan tâm</p>
            <div class="line-through"></div>
        </div>
    </div>
    <div class="box">
        <div class="container">
            @foreach($product_relate as $pro_relate)
            <div class="box-container">
                <div class="relate-product-img">
                    <a href="/product-detail/{{$pro_relate->id}}">
                        <img src="/upload/products/{{$pro_relate->img}}" alt="">
                    </a>
                </div>
                <div class="relate-product-name">
                    <p>{{$pro_relate->name}}</p>
                </div>
                <div class="relate-product-price" style="display: flex; align-items: flex-end">
                    @if($pro_relate->sale == 1)
                    <p>{{number_format($pro_relate->sale_price)}} <span>đ</span></p>
                    <p style="font-size: 14px; margin-left: 15px; text-decoration: line-through; color: #333" class="old-price">{{number_format($pro_relate->price , 0 , ',' , ',' )}} đ</p>
                    <div class="sale-percent" style="font-size: 10px; margin-left: auto; display: flex; align-items: center; padding: 5px 10px; border: 1px solid #ff3945">
                        <p style="margin-right: 5px">{{$pro_relate->sale_percent}}%</p>
                        <p>OFF</p>
                    </div>
                    @else
                    <p>{{number_format($pro_relate->price , 0 , ',' , ',' )}}<span>đ</span></p>
                    @endif
                    {{-- <p>1230000<span>đ</span></p> --}}
                </div>
                <div class="add-to-cart-icon2">
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
            </div>
            @endforeach
            {{-- <div class="box-container">
                <div class="relate-product-img">
                    <a href="">
                        <img src="./images/3.jpg" alt="">
                    </a>
                </div>
                <div class="relate-product-name">
                    <p>Giày Nike Air Jordan New</p>
                </div>
                <div class="relate-product-price">
                    <p>1230000<span>đ</span></p>
                </div>
                <div class="add-to-cart-icon2">
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
            </div>
            <div class="box-container">
                <div class="relate-product-img">
                    <a href="">
                        <img src="./images/3.jpg" alt="">
                    </a>
                </div>
                <div class="relate-product-name">
                    <p>Giày Nike Air Jordan New</p>
                </div>
                <div class="relate-product-price">
                    <p>1230000<span>đ</span></p>
                </div>
                <div class="add-to-cart-icon2">
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
            </div>
            <div class="box-container">
                <div class="relate-product-img">
                    <a href="">
                        <img src="./images/1.jpg" alt="">
                    </a>
                </div>
                <div class="relate-product-name">
                    <p>Giày Nike Air Jordan New</p>
                </div>
                <div class="relate-product-price">
                    <p>1230000<span>đ</span></p>
                </div>
                <div class="add-to-cart-icon2">
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
            </div> --}}
            <!-- <div class="box-container">
                <div class="relate-product-img">
                    <a href="">
                        <img src="./images/3.jpg" alt="">
                    </a>
                </div>
                <div class="relate-product-name">
                    <p>Giày Nike Air Jordan New</p>
                </div>
                <div class="relate-product-price">
                    <p>1230000<span>đ</span></p>
                </div>
                <div class="add-to-cart-icon2">
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
            </div> -->
        </div>
    </div>
    
</div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/phosphor-icons"></script>	
    <script>
        'use-strict'
            //If your <ul> has the id "glasscase"
            $('.product-detail-img-list').slick({
                arrows: true,
                autoplay: true,
                autoplaySpeed: 2000,
                slidesToShow: 4,
                slidesToScroll: 1,
                prevArrow:"<button type='button' class='slick-prev pull-left'><i class='ph-arrow-left-light'></i></button>",
                nextArrow:"<button type='button' class='slick-next pull-right'><i class='ph-arrow-right-light'></i></button>",
                responsive: [
                    {
                        breakpoint: 1300,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },

                    
                ]
            });

            document.querySelectorAll('.product-detail-img-list img').forEach((el, ind) => {
                el.addEventListener('click', function() {
                    document.querySelectorAll('.product-detail-img-list img').forEach((el, ind) => {
                        el.classList.remove('show');
                    })
                    el.classList.add('show');
                    document.querySelector('.product-detail-main-img img').src = el.getAttribute('src');
                })
            });

            document.querySelector('.product-detail-main-img').addEventListener('mousemove', function(e){
                const x = e.clientX - e.target.offsetLeft;
                const y = e.clientY - e.target.offsetTop;
                // console.log(e.clientX, e.clientY, e.target.offsetLeft, e.target.offsetTop, x, y);
                this.style.cursor = 'zoom-in';
                document.querySelector('.product-detail-main-img img').style.transformOrigin = `${x}px ${y}px`;
                document.querySelector('.product-detail-main-img img').style.transform = 'scale(2.5)';
            })

            document.querySelector('.product-detail-main-img').addEventListener('mouseleave', function(e){
                // const x = e.clientX - e.target.offsetLeft;
                // const y = e.clientY - e.target.offsetTop;
                // console.log(e.clientX, e.clientY, e.target.offsetLeft, e.target.offsetTop, x, y);
                document.querySelector('.product-detail-main-img img').style.transformOrigin = 'center';
                document.querySelector('.product-detail-main-img img').style.transform = 'scale(1)';
            })

            document.querySelector('input[name="size"]').checked = true;

            document.querySelectorAll('input[name="size"]').forEach(el => {
                el.addEventListener('change', function(){
                    let selected = document.querySelector('input[name="size"]:checked');
                    console.log(selected.value);
                })
            })

            document.querySelector('.product-detail-add-cart button').addEventListener('click', function(e) {
                e.preventDefault();
                let proid = document.querySelector('input.pro_id_hidden').value;
                let quantity = document.querySelector('input[name="quantity"]').value;
                let size =  document.querySelector('input[name="size"]:checked').value;
                // let img = document.querySelector('.product-detail-main-img img').getAttribute('src');
                // let name = document.querySelector('.product-detail-name p').textContent;
                // let price = document.querySelector('.product-detail-price .price').textContent.replace(' đ', '').split(",").join();
                // console.log(price);
                // console.log(proid, quantity, size);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/add-to-cart',
                    type: "POST",
                    data: {
                        'proId': proid,
                        'quantity': quantity,
                        'size': size
                    },
                    
                    success:function(response) {
                        if(response.status == 'Login to Continue'){
                            window.location.href = response.redirect_url;
                        }
                        else if(response.status == 'Added To Cart') {
                            location.reload();
                            alert('Added To Cart');
                        }                        
                    }
                });
            });

            

            document.querySelector('.asc-quanti').addEventListener('click', function() {
                if(document.querySelector('input[name="quantity"]').value < document.querySelector('input[name="quantity"]').getAttribute('max')){
                    // document.querySelector('.asc-quanti').style.opacity = 1;
                    document.querySelector('input[name="quantity"]').value = Number(document.querySelector('input[name="quantity"]').value) + 1;
                }
                
            })
 
            document.querySelector('.desc-quanti').addEventListener('click', function() {
                if(document.querySelector('input[name="quantity"]').value > document.querySelector('input[name="quantity"]').getAttribute('min')){
                    document.querySelector('input[name="quantity"]').value = Number(document.querySelector('input[name="quantity"]').value) - 1;
                }
                
            })

            // console.log(document.querySelector('input[name="size"]'));

            document.querySelector('.post-comment button').addEventListener('click', function(e){
                e.preventDefault();
                let productId = document.querySelector('.pro_id_hidden').value;
                let message = document.querySelector('.post-comment input[name="message-upload"]').value;
                let userId = document.querySelector('.post-comment input[name="hidden_comment_user_id').value;
                console.log(productId, message, userId);
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/post-comment',
                    type: "POST",
                    data: {
                        'productId': productId,
                        'message': message,
                        'userId': userId
                    },
                    
                    success:function(response) {
                        console.log(response);
                        if(document.querySelector('.no-comment')){
                            document.querySelector('.no-comment').remove();
                        }
                        const html = `
                                        <div class="comment">
                                            <div class="comment-avatar">
                                                <img src="/upload/avatar/${response[1]}" alt="">
                                            </div>
                                            <div class="comment-title">
                                                <div class="comment-name-date">
                                                    <p>${response[2]}</p>
                                                    <span>${response[3]}</span>
                                                </div>
                                                <div class="comment-message">
                                                    <p>${response[0].message}</p>
                                                </div>
                                                <div class="reply">
                                                    <button style="cursor: pointer;" type="submit">Phản hồi</button>
                                                </div>
                                            </div>
                                        </div>    
                                                `;
                        document.querySelector('.post-comment').insertAdjacentHTML('afterend', html);
                        document.querySelector('.post-comment input[name="message-upload"]').value = '';
                    }
                });
            });

            document.querySelectorAll('.reply').forEach(el => {
                const avatar = document.querySelector('.post-comment img').getAttribute('src');
                el.addEventListener('click', function(){
                    const commentId = el.closest('.comment').firstElementChild.value;
                    console.log(commentId);
                    const html = `<div class="reply-comments" style="display: flex; margin-left: 80px; margin-bottom: 25px">
                                    <input type="hidden" value="${el.closest('.comment').firstElementChild.value}">
                                    <img src="${avatar}" alt="" width="55px" height="55px" style="border-radius: 50%; object-fit: cover; border: 1px solid rgba(0, 0, 0, 0.08)">
                                    <input type="text" name="message-reply" style="flex: 1; padding: 15px 0; margin: 0 30px" placeholder="Viết cảm nghĩ của bạn về sản phẩm" autofocus>
                                    <button class="reply-button" style="padding: 0 20px; background: #ff3945; color: #fff; cursor: pointer;" type="submit">Gửi Bình Luận</button>
                                </div>`;
                    this.closest('.comment').insertAdjacentHTML('afterend', html);
                    document.querySelector('input[name="message-reply"]').focus();
                    document.querySelector('input[name="message-reply"]').style.borderBottom = '1px solid rgba(255,57,69, 0.3)';
                });
            });

            document.addEventListener('click', function(e){
                if(e.target.classList.contains('reply-button')){
                    let idComment = e.target.parentElement.firstElementChild.value;
                    let message = e.target.previousElementSibling.value;
                    // console.log(idComment, message);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/send-reply',
                        type: "POST",
                        data: {
                            'idComment': idComment,
                            'message': message,
                        },
                        
                        success:function(response) {
                            const html = `
                                            <div class="replies">
                                                <div class="reply-avatar">
                                                    <img src="/upload/avatar/${response[1]}" alt="">
                                                </div>
                                                <div class="reply-title">
                                                    <div class="reply-name-date">
                                                        <p>${response[2]}</p>
                                                        <span>1 phút trước</span>
                                                    </div>
                                                    <div class="reply-message">
                                                        <p>${response[0].message}</p>
                                                    </div>
                                                    <div class="reply">
                                                        <button style="cursor: pointer;" type="submit">Phản hồi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        `;
                            e.target.parentElement.previousElementSibling.insertAdjacentHTML('afterend', html);
                            e.target.parentElement.remove();

                        }
                    });
                }
            })     
        
    </script>
@endsection