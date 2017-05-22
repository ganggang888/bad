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
			<li><a href="<?php echo U('Goods/term_index');?>"><?php echo L('GOODS_TERM_INDEX');?></a></li>
			<li class="active"><a href="jacascript:;"><?php echo L('GOODS_TERM_EDIT');?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="">
			<fieldset>
				<div class="control-group">
					<label class="control-label"><?php echo L('GOODS_TERM_PARENT');?></label>
                    <div class="controls">
						<select name="parentid">
                        <?php if(!$_GET['parentid']): ?><option value="0">请选择分类</option><?php endif; ?>
                    <?php echo ($tree); ?>
                    </select>
					</div>
					
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('GOODS_TERM_NAME');?></label>
					<div class="controls">
						<input type="text" name="name" value="<?php echo ($data["name"]); ?>">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('GOODS_TERM_STATUS');?></label>
					<div class="controls">
						<select name="status">
                        <option value="1" <?php if($data['status'] == 1): ?>selected<?php endif; ?>>启用</option>
                        <option value="0" <?php if($data['status'] == 0): ?>selected<?php endif; ?>>禁用</option>
                        </select>
						<span class="form-required">*</span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">首页展示</label>
					<div class="controls">
						<select name="is_index">
                        <option value="1" <?php if($data['is_index'] == 1): ?>selected<?php endif; ?>>是</option>
                        <option value="0" <?php if($data['is_index'] == 0): ?>selected<?php endif; ?>>否</option>
                        </select>
						<span class="form-required">*</span>
					</div>
				</div>
				<input type="hidden" value="<?php echo ($data["id"]); ?>" name="id">
				
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('EDIT');?></button>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>