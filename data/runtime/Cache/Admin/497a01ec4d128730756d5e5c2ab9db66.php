<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    ROOT: "/",
	    WEB_ROOT: "/",
	    JS_ROOT: "public/js/",
	    APP:'<?php echo (MODULE_NAME); ?>'/*当前应用名*/
	};
	</script>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="javascript:;">订单列表</a></li>
		</ul>
			时间：
			<input type="text" id="begin" name="start_time" class="js-date" value="<?php echo ((isset($begin) && ($begin !== ""))?($begin):''); ?>" style="width: 120px;" autocomplete="off">-
			<input type="text" class="js-date" name="end_time" value="<?php echo ((isset($end) && ($end !== ""))?($end):''); ?>" style="width: 120px;" autocomplete="off" id="end"> &nbsp; &nbsp;
			收货人： 
			<input type="text" name="name" id="name" style="width: 200px;" value="<?php echo ((isset($name) && ($name !== ""))?($name):''); ?>" placeholder="请输入收货人...">
            收货人手机号： 
	  <input type="text" name="phone" id="phone" style="width: 200px;" value="<?php echo ((isset($phone) && ($phone !== ""))?($phone):''); ?>" placeholder="请输入手机号...">
            订单号： 
	  <input type="text" name="order_number" id="order_number" style="width: 200px;" value="<?php echo ((isset($order_number) && ($order_number !== ""))?($order_number):''); ?>" placeholder="请输入订单号...">
            订单状态:<select id="status">
            <option value="0" <?php if($status == 0): ?>selected<?php endif; ?>>待发货</option>
            <option value="2" <?php if($status == 2): ?>selected<?php endif; ?>>已发货</option>
            <option value="3" <?php if($status == 3): ?>selected<?php endif; ?>>已收货</option>
            <option value="4" <?php if($status == 4): ?>selected<?php endif; ?>>已作废</option>
            </select>
			<a class="btn " href="javascript:;" onClick="doSearch()">搜索</a>
		</form>
        <script>
        function doSearch()
		{
			var begin = $("#begin").val();
			var end = $("#end").val();
			var name = $("#name").val();
			var phone = $("#phone").val();
			var order_number = $("#order_number").val();
			var status = $("#status").val();
			window.location.href='index.php?g=Admin&m=Goods&a=orderList&begin='+begin+'&end='+end+'&name='+name+'&phone='+phone+'&order_number='+order_number+'&status='+status;
		}
        </script>
		<form class="js-ajax-form" action="" method="post">
			
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="50">用户名</th>
						<th>订单号</th>
                        <th>订单信息</th>
						<th>订单状态</th>
						<th>收货人</th>
                        <th>手机号</th>
						<th>物流方式</th>
                        <th>下单时间</th>
                        <th>操作</th>
					</tr>
				</thead>
				<?php if(is_array($result)): foreach($result as $key=>$vo): ?><tr>
					<td><?php echo getUserInfo($vo['uid'],'mobile');?></td>
					<td><b><?php echo ($vo["order_num"]); ?></b></td>
                    <td><?php echo orderContent($vo['goodsinfo']);?></td>
					<td><?php echo getOrderStatusInfo($vo['status']);?></td>
					<td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["phone"]); ?></td>
					<td>
                    <?php if ($vo['logistics_num']) { echo $vo['logistics_mode'].":".$vo['logistics_num']; } else { echo "暂无"; } ?></td>
					<td><?php echo ($vo["pay_time"]); ?></td>
                    <td><a href="<?php echo U('Goods/fa',array('id'=>$vo['id']));?>">物流状态修改</a> | <a href="<?php echo U('Goods/deleteOrder',array('id'=>$vo['id']));?>" class="js-ajax-delete">删除</a></td>
				</tr><?php endforeach; endif; ?>
				
			</table>
			
		  <div class="pagination"><?php echo ($page->show('Admin')); ?></div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	<script>
		function refersh_window() {
			var refersh_time = getCookie('refersh_time');
			if (refersh_time == 1) {
				window.location = "<?php echo U('AdminPost/index',$formget);?>";
			}
		}
		setInterval(function() {
			refersh_window();
		}, 2000);
		$(function() {
			setCookie("refersh_time", 0);
			Wind.use('ajaxForm', 'artDialog', 'iframeTools', function() {
				//批量复制
				$('.js-articles-copy').click(function(e) {
					var ids=[];
					$("input[name='ids[]']").each(function() {
						if ($(this).is(':checked')) {
							ids.push($(this).val());
						}
					});
					
					if (ids.length == 0) {
						art.dialog.through({
							id : 'error',
							icon : 'error',
							content : '您没有勾选信息，无法进行操作！',
							cancelVal : '关闭',
							cancel : true
						});
						return false;
					}
					
					ids= ids.join(',');
					art.dialog.open("/index.php?g=portal&m=AdminPost&a=copy&ids="+ ids, {
						title : "批量复制",
						width : "300px"
					});
				});
				//批量移动
				$('.js-articles-move').click(function(e) {
					var ids=[];
					$("input[name='ids[]']").each(function() {
						if ($(this).is(':checked')) {
							ids.push($(this).val());
						}
					});
					
					if (ids.length == 0) {
						art.dialog.through({
							id : 'error',
							icon : 'error',
							content : '您没有勾选信息，无法进行操作！',
							cancelVal : '关闭',
							cancel : true
						});
						return false;
					}
					
					ids= ids.join(',');
					art.dialog.open("/index.php?g=portal&m=AdminPost&a=move&old_term_id=<?php echo ((isset($term["term_id"]) && ($term["term_id"] !== ""))?($term["term_id"]):0); ?>&ids="+ ids, {
						title : "批量移动",
						width : "300px"
					});
				});
			});
		});
	</script>
</body>
</html>