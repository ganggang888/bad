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
			<li class="active"><a href="javascript:;">设置返点</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="">
			<fieldset>
				<div class="control-group">
					<label class="control-label">黄金会员下级首单下单返佣比例</label>
					<div class="controls">
						<input type="text" name="level_first" value="<?php echo ($info["level_first"]); ?>">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">见点奖（）</label>
					<div class="controls">
						<input type="text" name="jiandian" value="<?php echo ($info["jiandian"]); ?>">
						<span class="form-required">积分</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">黄金会员下级非首单下单返佣比例</label>
					<div class="controls">
						<input type="text" name="level_next" value="<?php echo ($info["level_next"]); ?>"> <span class="form-required"></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">普通会员推荐返佣比例</label>
					<div class="controls">
						<input type="text" name="pu" value="<?php echo ($info["pu"]); ?>"> <span class="form-required"></span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">钻石会员下级首单下单返佣比例</label>
					<div class="controls">
						<input type="text" name="zuanshi_first" value="<?php echo ($info["zuanshi_first"]); ?>"> <span class="form-required"></span>
					</div>
				</div>
                
                <div class="control-group">
					<label class="control-label">钻石会员下级非首单下单返佣比例</label>
					<div class="controls">
						<input type="text" name="zuanshi_next" value="<?php echo ($info["zuanshi_next"]); ?>"> <span class="form-required"></span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">下下级下单返佣比例</label>
					<div class="controls">
						<input type="text" name="level_level" value="<?php echo ($info["level_level"]); ?>"> <span class="form-required"></span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">黄金会员购买商品优惠比例</label>
					<div class="controls">
						<input type="text" name="huangjin" value="<?php echo ($info["huangjin"]); ?>"> <span class="form-required"></span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">钻石会员购买商品优惠比例</label>
					<div class="controls">
						<input type="text" name="zuanshi" value="<?php echo ($info["zuanshi"]); ?>"> <span class="form-required"></span>
					</div>
				</div>
                
                <div class="control-group">
					<label class="control-label">金币超过多少有收益</label>
					<div class="controls">
						<input type="text" name="jinbi" value="<?php echo ($info["jinbi"]); ?>"> <span class="form-required"></span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">金币收益年化率</label>
					<div class="controls">
						<input type="text" name="jinbi_shouyi" value="<?php echo ($info["jinbi_shouyi"]); ?>"> <span class="form-required">%</span>
					</div>
				</div>
                
                
                <div class="control-group">
					<label class="control-label">代理商代理费收益年化率</label>
					<div class="controls">
						<input type="text" name="daili_shouyi" value="<?php echo ($info["daili_shouyi"]); ?>"> <span class="form-required">%</span>
					</div>
				</div>
				
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit">修改</button>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>