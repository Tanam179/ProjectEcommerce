<div style="width: 600px; margin: 0 auto; background: #f2f2f2; text-align: center; padding: 31px 15px 50px 15px">
    <h3 style="display: block">Xin chào {{$user->email}}</h3>
    <h3>Tôi là HappyShoe.vn</h3>
    <p>Email này để giúp bạn lấy lại mật khẩu</p>
    <p>Bạn hãy bẫm vào đường link dưới đây để lấy lại mật khẩu</p>
    <a style="display: inline-block; color: #fff; background: #ff3945; padding: 10px 0; border-radius: 5px; text-decoration: none; width: 335px; text-align: center; cursor: pointer" href="{{route('customer.reset', ['token' => $passwordReset->token])}}">Lấy lại mật khẩu</a>
</div>