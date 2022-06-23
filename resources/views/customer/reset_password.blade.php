@extends('welcome')
@section('content')
<div class="reset-password" style="padding-top: 125px">
    <div class="container">
        @if (session('message'))
        <div class="alert mb-20 alert__error" style="transition: 1.5s; margin-bottom: 10px; border: 1px solid #13bfa6; background: rgba(19,191,166, 0.1); padding: 8px 10px">
            <span class="text-success" style="font-size: 15px;">
                {{ session()->get('message') }}
            </span>
        </div>
        @endif
        @if (session('error_msg'))
        <div class="alert mb-20 alert__error" style="transition: 1.5s; margin-bottom: 10px; border: 1px solid rgb(252,42,104); background: rgba(252,42,104, 0.1); padding: 8px 10px">
            <span class="text-success" style="font-size: 15px;">
                {{ session()->get('error_msg') }}
            </span>
        </div>
        @endif
        <div class="title">
            Lấy lại thông tin mật khẩu
        </div>
        <form action="/send-to-email" method="POST">
            @csrf
            <input type="email" name="reset_password_email" id="" placeholder="Email của bạn">
            <button type = submit>Gửi email xác nhận </button>
        </form>
        <p>Lưu ý: <span>Nhập vào Email mà bạn mất thông tin mật khẩu, hệ thống sẽ gửi đường dẫn xác nhận cho bạn.</span></p>
    </div>
</div>

@endsection