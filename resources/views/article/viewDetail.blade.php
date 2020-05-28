<!DOCTYPE html>
<html>
    <head>
        <title>{{$list['title']}}</title>

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
             <input type="hidden" name="id" value="{{$list['id']}}" id="id" >
            <div class="content">

                {{$list['content']}}
                
            </div>
        </div>
    </body>
    <script type="text/javascript">
        window.onload = function(){
            //上报点击
            var id = document.getElementById('id').value;
            ajax({
                type:"post",
                url:"/article/click",
                data:{'id':id},
                success:function(data){
                    var info = JSON.parse(data);
                    console.log(info.msg)
                }
            })
        }
        function ajax(options){
            //创建一个ajax对象
            var xhr = new XMLHttpRequest() || new ActiveXObject("Microsoft,XMLHTTP");
            //数据的处理 {a:1,b:2} a=1&b=2;
            var str = "";
            for(var key in options.data){
                str+="&"+key+"="+options.data[key];
            }
            str = str.slice(1)
            if(options.type == "get"){
                var url = options.url+"?"+str;
                xhr.open("get",url);
                xhr.send();
            }else if(options.type == "post"){
                xhr.open("post",options.url);
                xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
                xhr.send(str)
            }
            //监听
            xhr.onreadystatechange = function(){
                //当请求成功的时候
                if(xhr.readyState == 4 && xhr.status == 200){
                    var d = xhr.responseText;
                    //将请求的数据传递给成功回调函数
                    options.success&&options.success(d)
                }else if(xhr.status != 200){
                    //当失败的时候将服务器的状态传递给失败的回调函数
                    options.error&&options.error(xhr.status);
                }
            }
        }

    </script>
</html>
