<!DOCTYPE html>
<html>
    <head>
        <title>登录</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .inputer{
                width: 100%;
                height: 30px;
                margin-top: 5px;
            }
            .alert{
                position: absolute;
                left: 0;
                top: 0;
                background-color: #777171;
                width: 100%;
                height: 100%;
            }
            .alert-box{
                width: 200px;
                height: 100px;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                background-color: #6f866f;
            }
            .letter-spacing{
                margin-left: 10px;
            }
            .hide-form{
                display: none;
            }
            .select-this{
                background-color: green;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">

                <form method="post" action="checkLogin" id="loginForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="inputer">
                        登录账号：<input type="text" name="username" value="{{ old('username') }}">
                    </div>
                    <div class="inputer">
                        登录密码：<input type="password" name="password" value="{{ old('password') }}">
                    </div>
                    <div class="inputer">
                        <input type="submit" name="btn" class="letter-spacing select-this" value="登录" id="loginBtn1">
                        <button onclick="return registerUser()" class="letter-spacing" id="registerBtn1">注册</button>
                    </div>
                </form>
                <form method="post" action="registerUser" id="registerForm" class="hide-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="inputer">
                        账号：<input type="text" name="username" value="">
                    </div>
                    <div class="inputer">
                        密码：<input type="password" name="password" value="">
                    </div>
                    <div class="inputer">
                         <button onclick="return closeForm()" id="loginBtn2" class="letter-spacing">登录</button>
                        <input type="submit" name="btn"  class="letter-spacing" id="registerBtn2" value="注册">
                       
                    </div>
                </form>
                @if (count($errors) > 0)
                    <div class="alert alert-danger show-div" id="alert-div">
                        <div class="alert-box">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                @endif
            </div>
        </div>
    </body>
    <script type="text/javascript">
        setTimeout(function(){
            var div = document.getElementById('alert-div');
            if(div.getAttribute("class") == 'alert alert-danger show-div'){
                div.style.display = 'none';
            }
            
        },1000);
        function registerUser(){
            document.getElementById('registerForm').style.display='block';
            document.getElementById('loginForm').style.display='none';
            document.getElementById('registerBtn1').className ='letter-spacing select-this';
            document.getElementById('registerBtn2').className ='letter-spacing select-this';
            document.getElementById('loginBtn1').className ='';
            document.getElementById('loginBtn2').className ='';
            return false;

        }
        function closeForm(){
            document.getElementById('registerForm').style.display='none';
            document.getElementById('loginForm').style.display='block';
           document.getElementById('loginBtn1').className ='letter-spacing select-this';
            document.getElementById('loginBtn2').className ='letter-spacing select-this';
            document.getElementById('registerBtn1').className ='';
            document.getElementById('registerBtn2').className ='';
            return false;
        }
    </script>
</html>
