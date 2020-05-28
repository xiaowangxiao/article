<!DOCTYPE html>
<html>
    <head>
        <title>文章列表</title>

        <link href="https://fonts.googleapis.com/css?family=SimSun:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #545b5f;
                display: table;
                font-weight: 100;
                font-family: 'SimSun';
            }

            .container {
                width: 100%;
                height: 100%;
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
            table{
            	width: 100%;
            	line-height: 25px;
            	font-size: 25px;
            	padding: 10px 10px;
            }
            tr{
            	line-height: 40px;
            }
            th{
            	width: 200px;
            }
            button{
            	width: 70px;
			    height: 22px;
			    line-height: 20px;
			    
			    
			    margin-left: 10px;
            }
            .edit-btn{
            	color: #fff;
            	background-color: #8787e0;
            }
            .del-btn{
            	color: #000;
            	background-color: #c1c1d2;
            }
            .head-div{
            	margin-top: 50px;
            }
            .head-div button{
            	width: 100px;
            	height: 25px;
            	color: #fff;
            	background-color: #b5925d;
            	line-height: 22px;
            }
            .inputer{
                width: 100%;
                height: 50px;
                padding: 5px;
            }
            .btn-inputer{
                width: 100%;
                height: 30px;
                margin-top: 5px;
                text-align: center;
                line-height: 30px;
            }
            .textarea-inputer{
                width: 100%;
                height: 50px;
                margin-top: 5px;
            }
            .hide-form{
            	display: none;
            	width: 100%;
			    height: 100%;
			    position: absolute;
			    left: 0;
			    top: 0;
			    z-index: 999;
			    background-color: #c1b7b7a6;
			    color: #fff;
            }
            .form-div{
            	width: 500px;
			    height: 500px;
			    position: absolute;
			    top: 50%;
			    left: 50%;
			    transform: translate(-50%,-50%);
			    text-align: left;
            }
            .label{
            	width: 100px;
            	height: 40px;
    			display: inline-block;
    			float: left;
    			line-height: 40px;
            }
            .input{
            	display: inline-block;
            	height: 100%;
            }
            .input input,textarea{
            	height: 40px !important;
            	width: 200px !important;
            }
            .letter-spacing{
            	margin-left: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
            	<div class="head-div">
            		<button onclick="addArticle()">添加文章</button>
                    <button onclick="clearSession()">清空session</button>
            	</div>
            	<div class="hide-form" id="form">
            		<div class="form-div">
            			<form action="/article/addArticle" method="post">
	            			<input type="hidden" name="id" id="id" value="">
	            			 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		                    <div class="inputer">
		                        <div class="label">标题：</div>
		                        <div class="input"><input type="text" name="title" id="title"></div>
		                    </div>
		                    <div class="inputer">
		                        <div class="label">文章内容：</div>
		                        <div class="input"><textarea name="content" id="content"></textarea></div>
		                    </div>
		                    <div class="btn-inputer">
		                        <input type="submit" name="btn" value="提交">
		                        <button onclick="return closeForm()" class="letter-spacing">关闭</button>
		                    </div>
		                     
	            		</form>
	            		
            		</div>
            		
            	</div>
            	
               <table>
			    <thead>
			    	<tr>
			    		<th colspan="5">文章列表</th>
			    	</tr>
			        <tr>
			            <th> id</th>
			            <th> 标题</th>
			            <th> 内容  </th>
			            <th> 点击次数</th>
			            <th> 操作  </th>
			        </tr>
			    </thead>
			    <tbody>
			         @foreach($lists as $list)
			          <tr>
			              <td> {{$list['id']}} </td>
			              <td> {{$list['title']}} </td>
			              <td> {{$list['content']}} </td>
			              <td> @if(isset($list['click_times'])) {{$list['click_times']}} @endif </td>
			              <td>
                            <button class="edit-btn" onclick="editArticle('{{$list['id']}}','{{$list['title']}}','{{$list['content']}}')">修改</button>
			              <button class="del-btn" onclick="delArticle('{{$list['id']}}')">删除</button>
			              </td>
			          </tr>
			         @endforeach
			   </tbody>
			</table>
            </div>
        </div>
    </body>
    <script type="text/javascript">
    	function delArticle(id){
    		if(confirm('确定删除记录ID为'+id+'的文章吗？')){
    			window.location.href = '/article/delArticle/'+id;
    		}
    	}
    	function addArticle(){
    		document.getElementById('id').value = '';
    		document.getElementById('title').value = '';
    		document.getElementById('content').innerHTML = '';
    		document.getElementById('form').style.display='block';
    	}
    	function editArticle(id,title,content){
    		document.getElementById('id').value = id;
    		document.getElementById('title').value = title;
    		document.getElementById('content').innerHTML = content;
    		document.getElementById('form').style.display='block';
    	}
    	function closeForm(){
    		document.getElementById('form').style.display='none';
    		return false;
    	}
        function clearSession(){
            window.location.href = '/admin/clearSession/';
        }
    </script>
</html>
