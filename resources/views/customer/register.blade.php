<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/phosphor-icons"></script>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>Document</title>
</head>
    <div class="wrapper-register">
        <div class="register">
            <div class="register-form-left">
                <div class="register-title">
                    <h3>HAPPY SHOE</h3>
                    <p>Đăng Ký</p>
                </div>
                <form class="register-form" action="/register-action" method="POST">
                    @csrf
                    @error('regis_email')
                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px; margin-bottom: 8px;">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <input type="email" name="regis_email" placeholder=" ">
                        <label class="form-label">Email</label>
                    </div>
                    @error('regis_username')
                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px; margin-bottom: 8px;">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" name="regis_username" placeholder=" ">
                        <label class="form-label">User Name</label>
                    </div>
                    @error('regis_password')
                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px; margin-bottom: 8px;">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <input type="password" name="regis_password" placeholder=" ">
                        <label class="form-label password">Password</label>
                        <div class="eyes">
                            <i class="ph-eye"></i>
                        </div>
                        <div class="eyes-slash">
                            <i class="ph-eye-slash"></i>
                        </div>
                    </div>
                    @error('regis_confirm_password')
                        <span style="color: red; font-size: 14px; display: inline-block ; margin-left: 5px; margin-bottom: 8px;">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <input type="password" name="regis_confirm_password" placeholder=" ">
                        <label class="form-label password">Confirm Password</label>
                        <div class="eyes">
                            <i class="ph-eye"></i>
                        </div>
                        <div class="eyes-slash">
                            <i class="ph-eye-slash"></i>
                        </div>
                    </div>
                    <button class="register-btn" type="submit">ĐĂNG KÝ</button>
                    <div class="no-account">
                        <span>Ban đã có tài khoản?  </span>
                        <a href="/login">Đăng nhập ngay</a>
                    </div>
                </form>
            </div>
            <div class="register-form-right"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">

        document.querySelectorAll('.eyes')[0].addEventListener('click', function() {
            document.querySelector('[name="regis_user_password"]').setAttribute('type', 'text');
            document.querySelectorAll('.eyes')[0].style.display = 'none';
            document.querySelectorAll('.eyes-slash')[0].style.display = 'flex';
        });

        document.querySelectorAll('.eyes')[1].addEventListener('click', function() {
            document.querySelector('[name="regis_user_confirm_password"]').setAttribute('type', 'text');
            document.querySelectorAll('.eyes')[1].style.display = 'none';
            document.querySelectorAll('.eyes-slash')[1].style.display = 'flex';
        });

        document.querySelectorAll('.eyes-slash')[0].addEventListener('click', function() {
            document.querySelector('[name="regis_user_password"]').setAttribute('type', 'password');
            document.querySelectorAll('.eyes')[0].style.display = 'flex';
            document.querySelectorAll('.eyes-slash')[0].style.display = 'none';
        });

        document.querySelectorAll('.eyes-slash')[1].addEventListener('click', function() {
            document.querySelector('[name="regis_user_confirm_password"]').setAttribute('type', 'password');
            document.querySelectorAll('.eyes')[1].style.display = 'flex';
            document.querySelectorAll('.eyes-slash')[1].style.display = 'none';
        });

    </script>

</body>

</html>