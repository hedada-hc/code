
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{asset('/js/vue.js')}}"></script>
</head>
<body>

  <div class="container">



           
	<table class="table">
      <caption>
      <!-- @for($i=0; $i<28;$i++)
      	<span class="label label-success">{{$i}}号{{$arr[$i]}} 次</span>
      @endfor -->
    
      </caption>
      <div class="progress">
	  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
	    <span class="sr-only">40% Complete (success)</span>
	  </div>
	</div>
	<div class="alert alert-success" role="alert">
	  <a href="#" class="alert-link">...</a>
	</div>
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Username</th>
          <th>Username</th>
          <th>Username</th>
        </tr>
      </thead>
      <tbody>
    @foreach($dd as $k=>$v)
        <tr >
          <td class="qihao">{{$v['id']}}</td>
          <td>{{$v['num1']}}</td>
          <td>{{$v['num2']}}</td>
          <td>{{$v['num3']}}</td>
          <td><span class="label label-success">{{$v['total']}}</span></td>
          <td>{{date("Y-m-d H:i:s",$v['time'])}}</td>
          @if($v['status'] == 1)
          <td>已开奖</td>
          @else
          <td><a href="{{url('/luck/pour/'.$v['id'])}}" >立即投</a></td>
          @endif
        </tr>
    @endforeach    
      </tbody>
    </table>
</div>    
    {{$dd->links()}}
    <script type="text/javascript">
	$(function(){
				//var t = new Date;
			//t.getFullYear();   //获取系统的年；
			//t.getMonth()+1;   //获取系统月份，由于月份是从0开始计算，所以要加1
			//t.getDate(); // 获取系统日，
			//t.getHours(); //获取系统时，
			//t.getMinutes(); //分
			//t.getSeconds(); //秒
			//每60秒执行一次myFunction()
			
			function time(){
				var t = new Date;
				var now_time = (t.getSeconds()/60)*100;
				console.log(now_time);
				$(".progress-bar-striped").css({width:+now_time+"%"});
				if (now_time == 0) {
					location.assign(location);
				}
				var qihao =$(".qihao").eq(4).text();
				$(".alert-link").text("第 "+qihao+" 期还有 "+(60-t.getSeconds())+" 开奖");
				
			}
			setInterval(time,1000);    //需要函数触发
})
	</script>
<!-- 
<div id="app-4">
  <ol>
    <li v-for="todo in todos">
      
    </li>
  </ol>
</div>

<script type="text/javascript">
	// 列表循环
	var app4 = new Vue({
		el:"#app-4",
		data:{
			{{$aa}}
		}
	})


    var app4 = new Vue({
        el:"#app-4",
        data:{
            todos:[
                {id:1,author:'function',name:'echo',price:'32.0'},
                {id:1,author:'function',name:'echo',price:'32.0'},
                {id:1,author:'function',name:'echo',price:'32.0'},
                {id:1,author:'function',name:'echo',price:'32.0'},
                {id:1,author:'function',name:'echo',price:'32.0'},
            ]
        }
    })
</script> -->


</body>
</html>

