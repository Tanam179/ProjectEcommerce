@extends('welcome')
@section('content')
<div class="reset-new-password" style="padding-top: 100px">
    <div class="container">
        <div class="title">
            Lấy lại thông tin mật khẩu
        </div>
        <form action="/reset-password-action/" method="POST">
            @csrf
            <input type="hidden" value="{{$user->email}}" name="user_token">
            @error('reset_new_password')
                <span style="color: red; font-size: 14px; display: inline-block; margin-bottom: 10px">{{ $message }}</span>
            @enderror
            <input type="password" name="reset_new_password" id="" placeholder="Mật khẩu mới">
            @error('reset_new_password_confirm')
                <span style="color: red; font-size: 14px; display: inline-block; margin-bottom: 10px">{{ $message }}</span>
            @enderror
            <input type="password" name="reset_new_password_confirm" id="" placeholder="Xác nhận lại mật khẩu">
            <button type = submit>Thay đổi mật khẩu </button>
        </form>
    </div>
</div>

@endsection