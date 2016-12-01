<?php $__env->startSection('content'); ?>
	<script type="text/javascript">
	$(function(){
	     jsonajax();
	});
//这里就要进行计算滚动条当前所在的位置了。如果滚动条离最底部还有100px的时候就要进行调用ajax加载数据
	 $(window).scroll(function(){    
	     //此方法是在滚动条滚动时发生的函数
	     // 当滚动到最底部以上100像素时，加载新内容
	     var $doc_height,$s_top,$now_height;
	     $doc_height = $(document).height();        //这里是document的整个高度
	     $s_top = $(this).scrollTop();            //当前滚动条离最顶上多少高度
	     $now_height = $(this).height();            //这里的this 也是就是window对象
	     if(($doc_height - $s_top - $now_height) < 100) jsonajax();    
	 });
	 num =1;
	  function jsonajax(){

	  	if(num==1){
	  		$.post("<?php echo e(url('reg/loing')); ?>",{_token:"<?php echo e(csrf_token()); ?>",id:'123'},function(){

	  		});
	  	}
	  	num=0;	
	  }

	</script>
	<div class="header">
		<div class="content">
			
		<a href="javascript:;" class="btn">更新缓存</a>	
		<?php $__currentLoopData = $dd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<nav id="more">
				<a target="new" href="<?php echo e(url('show/'.$v['id'])); ?>" rel="文章标题"><?php echo e($v['titles']); ?></a>

				<p rel="发布时间">PHP识别二维码的方法(php-zbarcode安装与使用)PHP使用PHPExcel删除Excel单元格指定列的方法PHPExcel合并与拆分单元格的方法</p>
				<span href="" rel="发布时间"><?php echo e(date('Y-m-d H:i:s',$v['times'])); ?></span>
				<span href="" rel="发布时间">ID:<?php echo e($v['id']); ?></span>
			</nav>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>	
		<a href="javascript:;" class="get_more">::点击加载更多内容::</a>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			alert(window.scrollTop());
			$('.btn').click(function(){
				$.post("<?php echo e(url('/reg/ajax')); ?>",{_token:'<?php echo e(csrf_token()); ?>',dr:1},function(db){
					alert(db.static);
				});
			})

			 if($(window).scrollTop()==($(document).height()-$(window).height())){
			 	$.post("<?php echo e(url('/reg/ajax')); ?>",{_token:'<?php echo e(csrf_token()); ?>',dr:1},function(db){
					alert(db.static);
				});
			 }
		})


</script>
		
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>