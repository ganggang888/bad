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
			<input type="text" id="begin" name="start_time" class="js-date" value="<?php echo ((isset($begin) && ($begin !== ""))?($begin):''); ?>" placeholder="开始时间" style="width: 120px;" autocomplete="off">-
			<input type="text" class="js-date" name="end_time" value="<?php echo ((isset($end) && ($end !== ""))?($end):''); ?>" style="width: 120px;" placeholder="结束时间" autocomplete="off" id="end"> &nbsp; &nbsp;
			
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
			window.location.href='index.php?g=Admin&m=Goods&a=sku_history&begin='+begin+'&end='+end;
		}
        </script>
		<form class="js-ajax-form" action="" method="post">
			
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="50">商品名称</th>
						<th>事件</th>
                        <th>数量</th>
						<th>用户名</th>
						<th>商品详情</th>
                        <th>操作时间</th>
					</tr>
				</thead>
				<?php $attributes = attributeType(); ?>
                <?php if(is_array($result)): foreach($result as $key=>$vo): ?><tr>
					<td><?php echo ($vo["name"]); ?></td>
					<td>
                    <?php if($vo['action'] == 1): ?>减
                    <?php elseif($vo['action'] == 2): ?>
                    加<?php endif; ?>
                    </td>
                    <td><?php echo ($vo["number"]); ?></td>
					<td><?php echo ($vo["mobile"]); ?></td>
					<td>
                    <?php $attribute = json_decode($vo['attribute'],true); ?>
                   <?php if(is_array($attribute)): foreach($attribute as $key=>$v): if($key == $vo['gid_info']): ?>成本价：<?php echo ($v["cost_price"]); ?> &nbsp;&nbsp;销售价：<?php echo ($v["selling_price"]); ?>&nbsp;&nbsp; 市场价：<?php echo ($v["market_value"]); ?>&nbsp;&nbsp; 单位：<?php echo ($v["unit"]); ?> &nbsp;&nbsp;库存：<?php echo ($v["stock"]); ?>&nbsp;&nbsp;
                   <?php $info = explode('-',$v['id']); ?>
                   <?php echo ($attributes[$info[0]]['son'][$info[1]]['name']); ?>：<?php echo ($v["name"]); ?>&nbsp;&nbsp;
                   <?php echo ($attributes[$info[0]]['son'][$info[1]]['info']); ?> : <?php echo ($v["info"]); ?><br/><?php endif; endforeach; endif; ?>
                    </td>
                    <td><?php echo ($vo["add_time"]); ?></td>
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