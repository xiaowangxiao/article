<!DOCTYPE html>
<html>
    <head>
        <title>文章</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
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
                @foreach($lists as $list)
                <div>
                    <a href="/article/{{$list['id']}}.html"/>{{$list['id']}}.{{$list['title']}}
                </div>
                @endforeach
                
                
            </div>
        </div>
    </body>
</html>
