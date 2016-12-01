<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="{{asset('/js/jquery.min.js')}}"></script>
</head>
<body>
	<img class="header" src="">
	<img width="300" src="{{$code}}">
<button id="action">开始</button>
<button id="btn">停止</button>
<button id="test">Test</button>
<a href="javascript:;" id="requ" >提交key</a>
<input type="text" name="" class="data">
<script type="text/javascript">
$(function(){

	$("#requ").click(function(){
		var data = $('.data').val();
			$.post("{{url('/wechat/key')}}",{url:data},function(msg){
					console.log(msg);
				});
			})

	var on = 0;
	function code(){
	 	$.get("{{url('wechat/status/'.$uuids)}}",function(data){
			arr = data.data.split(";");
			if(arr[0] == "window.code=201"){

				arr[1] = arr[1].substr(21);
				da =arr[2].replace("'"+"","");
				$(".header").attr('src',arr[1]+";"+da); 

			}else if(arr[0] == "window.code=200"){

				var key = arr[1].substr(21);
				key = key.replace('"','');
				key = key.substring(0, key.length - 1);  
				$('.data').val(key);
		 		clearInterval(clea);
			}
			
		})//8vl//9k=
	}

	$('#test').click(function(){
		key = "https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxnewloginpage?ticket=Aa8wd03A2CbeNpnPKzuCgdWK@qrticket_0&uuid=4c9EWhtPGQ==&lang=zh_CN&scan=1480579158%22"
 		$.post("{{url('/wechat/key')}}",{url:key},function(msg){
		 			console.log(msg);
		});
 	})

	$('#action').click(function(){
 		on = 1;
 	})
 	$('#btn').click(function(){
 		clearInterval(clea);
 	})
 	var clea =setInterval(function(){
 		if(on == 1){
			code();
		}
 	},1000);	
}) 
//nwindow.redirect_uri=
</script>
</body>
</html>