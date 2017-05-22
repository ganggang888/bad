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
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('Goods/orderList');?>">订单列表</a></li>
			<li class="active"><a href="javascript:;">物流信息</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="">
			<fieldset>
            <div class="control-group">
					<label class="control-label">订单号码</label>
					<div class="controls">
						<input type="text" value="<?php echo ($info["order_num"]); ?>" disabled>
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">选择物流公司</label>
                    <div class="controls">
						<select name="logistics_mode">
                        <?php if(is_array($wuliu)): foreach($wuliu as $key=>$vo): ?><option value="<?php echo ($vo); ?>" <?php if($info['logistics_mode'] == $vo): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                    </select>
					</div>
					
				</div>
				<div class="control-group">
					<label class="control-label">运单号码</label>
					<div class="controls">
						<input type="text" name="logistics_num" value="<?php echo ($info["logistics_num"]); ?>">
						<span class="form-required">*</span>
					</div>
				</div>
				
				
				<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit">确定</button>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>