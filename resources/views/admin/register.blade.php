<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

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
            .hideForm{
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">

                <div>
                    @if($result === 0 || $result === null)
                    注册失败
                    @else
                    注册成功
                    @endif
                </div>
                <div class="hideForm">
                    <form action="/admin/login" method="get">
                        <input type="submit" name="btn" id="btn">
                    </form>
                </div>
                
            </div>
        </div>
    </body>
    <script type="text/javascript">
        setTimeout(function(){
            document.getElementById('btn').click();
        },1000);
    </script>
</html>
