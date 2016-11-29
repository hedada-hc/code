<style type="text/css">
		.mail_con{
			display:block;background:#E6E6EA;color:333;font-family: "Helvetica Neue","Hiragino Sans GB","Microsoft YaHei","\9ED1\4F53",Arial,sans-serif;text-align: center;height: 100%;-webkit-box-sizing: border-box;box-sizing: border-box;display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;-webkit-box-align: center;-webkit-align-items: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: center;-webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;font-family: "Helvetica Neue","Hiragino Sans GB","Microsoft YaHei","\9ED1\4F53",Arial,sans-serif;
		}
		.mail_con .mail_text{
		    width: 850px;margin: 45px 0;box-shadow: 0 0 25px 5px rgba(0,0,0,.09);-webkit-box-shadow: 0 0 25px 5px rgba(0,0,0,.09);background-color: #FFF;border-radius: 8px;-moz-border-radius: 8px;-webkit-border-radius: 8px;overflow: hidden;
		}
		.mail_con .mail_text mail{
			padding: 17% 16%;text-align: left;font-size: 14px;
		}
		.mail_con .mail_text mail nav h1{
			margin-bottom: 24px;
		}
		.mail_con .mail_text mail nav h2{
			margin-bottom: 24px;
		}
		.mail_con .mail_text mail nav span{
			margin-bottom: 24px;
			display:block;
		}
		.mail_con .mail_text mail nav span a{
			color: #42C642;
			text-decoration: underline;
			cursor: pointer;
		}
		.mail_con .mail_text mail nav .mail_btn{
			color: #fff;
			background:#42C642;
			display:block;
			width:100px;
			height:40px;
			border-radius:5px;
			text-decoration:none;
			text-align:center;
			line-height:40px;
		}

</style>
<div style="background:#E6E6EA;display:block;width:100%;height:100%;">
	<content style="display:block;width: 850px;margin:52px auto;box-shadow: 0 0 25px 5px rgba(0,0,0,.09);-webkit-box-shadow: 0 0 25px 5px rgba(0,0,0,.09);background-color: #FFF;border-radius: 8px;-moz-border-radius: 8px;-webkit-border-radius: 8px;overflow: hidden;">
		<mail style='padding: 17% 16%;text-align: left;font-size: 14px;display:block;'>
			<nav>
				<h1 style="margin-bottom: 24px;color:#ff4400;">商品出问题啦,下面是反馈信息</h1><br/>
				商品错误类型：<h2 style="margin-bottom: 24px;font-size:16px;font-weight:500">{{$content['error_type']}}<br/>商品错误描述：<span style="color:#42C642;">{{$content['depict']}}</span><br/></h2>

				<span style="margin-bottom: 24px;display:block;font-weight: 600;color:#ff5656">反馈者联系QQ：{{$content['qq']}}
					<a style="color:#42C642;font-weight:100;" href="{{url('http://sadmin.taokezhushou.com/admin/items/'.$content['goods_id'].'/edit')}}"><br/>{{url('http://sadmin.taokezhushou.com/admin/items/'.$content['goods_id'].'/edit')}}</a>
					<br/>
				</span>

				<a style="color: #fff;background:#42C642;display:block;width:100px;height:40px;border-radius:5px;text-decoration:none;text-align:center;line-height:40px;cursor:pointer;margin-bottom: 24px;" href="{{url('http://sadmin.taokezhushou.com/admin/items/'.$content['goods_id'].'/edit')}}" target="new" >点击修改错误</a><br>
				<span style="display:block;color: #a9a9a9;text-align:right;font-size:12px">
					淘客助手官方团队 {{date("Y年m月d日 H时i分s秒",time())}}
				</span>
			</nav>
		</mail>
	</content>
</div>
