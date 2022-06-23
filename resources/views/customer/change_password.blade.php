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
        <div class="user-change-account">
            <div class="title">
                <p>Thông tin khách hàng</p>
            </div>
            @if (session('error_message'))
            <div class="alert alert-danger mb-20 alert__error" style="transition: 0.5s; margin-top: 10px; display: flex; align-items: center; margin-bottom: 10px; background: rgba(252,42,104, 0.2); border: 1px solid rgb(252,42,104); padding: 8px 10px">
                <span style="margin-top: 6px"><i class="ph-warning"></i></span>
                <span style="font-size: 15px; margin-left: 10px;">
                    {{ session()->get('error_message') }}
                </span>
            </div>
            @endif
            <form action="/change-password-action/{{Auth::id()}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" value="{{Auth::user()->name}}" readonly>
                </div>
                @error('change_password')
                    <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px; margin-bottom: 20px;">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    
                    <input type="password" name="change_password" placeholder=" ">
                    <label class="form-label password">New Password</label>
                    <div class="eyes">
                        <i class="ph-eye"></i>
                    </div>
                    <div class="eyes-slash">
                        <i class="ph-eye-slash"></i>
                    </div>
                </div>
                @error('change_confirm_password')
                    <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px; margin-bottom: 20px;">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <input type="password" name="change_confirm_password" placeholder=" ">
                    <label class="form-label password">Confirm Password</label>
                    <div class="eyes">
                        <i class="ph-eye"></i>
                    </div>
                    <div class="eyes-slash">
                        <i class="ph-eye-slash"></i>
                    </div>
                </div>
                <p class="attent">Lưu ý: <span>Sau khi đổi mật khẩu, hệ thống sẽ đăng xuất tài khoản và bạn sẽ phải đăng nhập lại</span></p>
                <button type="submit">Thay đổi</button>
            </form>
        </div>
    </div>
</div>
<script>
    // document.querySelector('.user-information .avatar input').addEventListener('change', function() {
    //     let myform = document.querySelector('#user_form');
    //     let formData = new FormData(myform);
    //     let userId = document.querySelector('input[name="user_id"]').value;
    //     // let imgValue = this.value;
    //     // let _token = document.querySelector('input[name="_token"]').value;
    //     // console.log(imgValue);
    //     let reader = new FileReader();
    //     reader.onload = function(event) {
    //         // console.log(document.querySelector('.user-information .avatar label'));
    //         document.querySelector('.user-information .avatar label').style.background = `url(${reader.result})`;
    //         document.querySelector('.user-information .avatar label').style.backgroundPosition= 'center';
    //         document.querySelector('.user-information .avatar label').style.backgroundSize = 'cover';
    //         // console.log(reader.result);
    //         // const html = `<img src="${reader.result}" alt="" width="150px" height="150px" style="margin-top: 10px">`
    //         // document.querySelector('.img-preview').insertAdjacentHTML('afterbegin', html);
    //     };
    //     reader.readAsDataURL(this.files[0]);

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         url: '/update-avatar/'+userId,
    //         type: 'POST',
    //         contentType: false,
    //         data: formData,
    //         dataType: 'JSON',
    //         cache: false,
    //         processData: false,
            
    //         success:function(response) {
    //             alert(response.status);
    //         }
    //     });
    // })

    document.querySelectorAll('.eyes')[0].addEventListener('click', function() {
        document.querySelector('[name="change_password"]').setAttribute('type', 'text');
        document.querySelectorAll('.eyes')[0].style.display = 'none';
        document.querySelectorAll('.eyes-slash')[0].style.display = 'flex';
    });

    document.querySelectorAll('.eyes')[1].addEventListener('click', function() {
        document.querySelector('[name="change_confirm_password"]').setAttribute('type', 'text');
        document.querySelectorAll('.eyes')[1].style.display = 'none';
        document.querySelectorAll('.eyes-slash')[1].style.display = 'flex';
    });

    document.querySelectorAll('.eyes-slash')[0].addEventListener('click', function() {
        document.querySelector('[name="change_password"]').setAttribute('type', 'password');
        document.querySelectorAll('.eyes')[0].style.display = 'flex';
        document.querySelectorAll('.eyes-slash')[0].style.display = 'none';
    });

    document.querySelectorAll('.eyes-slash')[1].addEventListener('click', function() {
        document.querySelector('[name="change_confirm_password"]').setAttribute('type', 'password');
        document.querySelectorAll('.eyes')[1].style.display = 'flex';
        document.querySelectorAll('.eyes-slash')[1].style.display = 'none';
    });
</script>
@endsection