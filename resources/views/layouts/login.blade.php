<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('icon')}}/css/all.css">
    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets')}}/admin/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('assets')}}/admin/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('assets')}}/admin/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets')}}/admin/css/demo.css" rel="stylesheet" />
    <title>Login</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            font-family: Arial, Helvetica, sans-serif; /* phông chữ ko chân*/
        }

        body {
            overflow: hidden;
            height: 100vh;
        }
        .center{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -60%);
            width: 400px;
        }

        .center h1 {
            text-align: center;
            padding: 0 0 20px 0;
        }

        .center form {
            padding: 0 40px;
            box-sizing: border-box;
        }

        form .txt_field {
            position: relative;
            margin: 30px 0;
            border-bottom: 2px solid #adadad;
        }

        .txt_field input{
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
        }

        .txt_field label{
            position: absolute;
            top: 50%;
            left: 5px;
            color: #adadad;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
        }

        .txt_field span::before{
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #2691d9;
            transition: .5s;
        }

        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label{
            top: -5px;
            color: #2691d9;
        }

        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before{
            width: 100%;
        }

        input[type="submit"] {
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            font-size: 20px;
            color: #e9f4fb;
            margin-top: 15px;
            font-weight: 700;
            cursor: pointer;
            outline:  none;
        }

        input[type="submit"]:hover {
            border-color: #2691d9;
            transition: .5s;
        }

        .signup_link{
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: #666666;
        }

        .signup_link a{
            color: #2691d9;
            text-decoration: none;
        }

        .signup_link a:hover{
            text-decoration: underline;
        }    

        .error {
            color: red;
            font-size: 13px;
        }

        #icon {
            position: absolute;
            top: 40%;
            transform: translateX(-27px);
            opacity: 0.5;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="center">
        <h1>Login</h1>
        <form action="{{route('login.post')}}" method="POST">
            <div class="txt_field">
                <input type="text" required name="username">
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" required name="password" id="password">
                <span></span>
                <label>Password</label>
                <i class="fa-regular fa-eye" id="icon" onclick="change()"></i>
            </div>
            @csrf
            <input type="submit" value="Login" name="login">
        </form>
    </div>

    <script>
        var password = document.getElementById('password');
        var icon = document.getElementById('icon');
        function change() {
            if (password.type == 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash')
            }else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye')
            }

        }
    </script>
    <!--   Core JS Files   -->
    <script src="{{asset('assets')}}/admin/js/jquery.3.2.1.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('assets')}}/admin/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('assets')}}/admin/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{asset('assets')}}/admin/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{asset('assets')}}/admin/js/demo.js"></script>
    @if ($message = Session::get('error'))
        <script type="text/javascript">
            $(document).ready(function(){
                demo.initChartist();
                $.notify({
                    message: '{{$message}}'
                },{
                    type: 'info',
                    timer: 4000
                });
            });
        </script>
    @endif
</body>
</html>