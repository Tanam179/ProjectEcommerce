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
<body>
    <div class="wrapper-login">
        <div class="login">
            <div class="login-form-left">
                <div class="login-title">
                    <h3>HAPPY SHOE</h3>
                    <p>Đăng nhập</p>
                </div>
                <form class="login-form" action="/login-action" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="customer_email" placeholder=" ">
                        <label class="form-label">Email</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="customer_password" placeholder=" ">
                        <label class="form-label password">Password</label>
                        <div class="eyes">
                            <i class="ph-eye"></i>
                        </div>
                        <div class="eyes-slash">
                            <i class="ph-eye-slash"></i>
                        </div>
                    </div>
                    <button class="login-btn" type="submit">ĐĂNG NHẬP</button>
                    <div class="no-account">
                        <span>Ban không có tài khoản?  </span>
                        <a href="/register">Đăng ký ngay</a>
                    </div>
                    <div class="forget-password" style="font-size: 15px; margin-top: 10px;">
                        <a style="color: #ff3945" href="/reset-password">Quên mật khẩu?</a>
                    </div>
                    <p class="or-login-with">---- Hoặc đăng nhập bằng ----</p>
                    <div class="login-with-social">
                        <div class="login-with-facebook">
                            <i class="fab fa-facebook-f"></i>
                            <p>Đăng nhập bằng Facebook</p>
                        </div>
                        <div class="login-with-google">
                            <i class="fab fa-google"></i>
                            <p>Đăng nhập bằng Google</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-form-right"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        document.querySelector('.eyes').addEventListener('click', function() {

            document.querySelector('[name="customer_password"]').setAttribute('type', 'text');
            document.querySelector('.eyes').style.display = 'none';
            document.querySelector('.eyes-slash').style.display = 'flex';
        });


        document.querySelector('.eyes-slash').addEventListener('click', function() {
            document.querySelector('[name="customer_password"]').setAttribute('type', 'password');
            document.querySelector('.eyes').style.display = 'flex';
            document.querySelector('.eyes-slash').style.display = 'none';
        })
    </script>
</body>
</html>