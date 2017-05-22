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
<script type="text/html" id="photos-item-wrapper">
	<li id="savedimage{id}">
		<input id="photo-{id}" type="hidden" name="photos_url[]" value="{filepath}"> 
		<input id="photo-{id}-name" type="text" name="photos_alt[]" value="{name}" style="width: 160px;" title="图片名称">
		<img id="photo-{id}-preview" src="{url}" style="height:36px;width: 36px;" onclick="parent.image_preview_dialog(this.src);">
		<a href="javascript:upload_one_image('图片上传','#photo-{id}');">替换</a>
		<a href="javascript:(function(){$('#savedimage{id}').remove();})();">移除</a>
	</li>
</script>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('Goods/index');?>">商品首页</a></li>
			<li class="active"><a href="<?php echo U('Goods/add');?>">添加商品</a></li>
		</ul>
        <ul class="nav nav-tabs" id="navs">
			<li class="active"><a href="javascript:;" class="1">商品信息</a></li>
			<li><a href="javascript:;"  class="2">商品属性</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="">
			<fieldset>
            <div class="one">
            <div class="control-group">
					<label class="control-label">分类名称</label>
					<div class="controls">
						<select name="term_id">
                        <option value="0">请选择分类</option>
                        <?php echo ($tree); ?>
                        </select>
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">商品名称</label>
					<div class="controls">
						<input type="text" required name="name" placeholder="请输入商品名称">
						<span class="form-required">*</span>
					</div>
				</div>
				
                <div class="control-group">
					<label class="control-label">所需积分</label>
					<div class="controls">
						<input type="text" required name="score" placeholder="请输入兑换积分">
						<span class="form-required">*</span>
					</div>
				</div>
                
                <div class="control-group">
					<label class="control-label">黄金会员专区推荐</label>
					<div class="controls">
						<select name="huangjin">
                        <option value="0">否</option>
                        <option value="1">是</option>
                        
                        </select>
						<span class="form-required">*</span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">状态</label>
					<div class="controls">
						<select name="status">
                        <option value="1">上架</option>
                        <option value="0">下架</option>
                        </select>
						<span class="form-required">*</span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">商品详情</label>
					<div class="controls">
						<script type="text/plain" id="content" name="content"></script>
						<span class="form-required">*</span>
					</div>
				</div>
                <div class="control-group">
					<label class="control-label">商品标签</label>
					<div class="controls">
						<textarea name="label" rows="5"></textarea>
						<span class="form-required">多个标签请以#隔开入（优惠#限量）</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">图集</label>
					<div class="controls">
						<ul id="photos" class="pic-list unstyled"></ul>
								<a href="javascript:upload_multi_image('图片上传','#photos','photos-item-wrapper');" class="btn btn-small">选择图片</a>
						<span class="form-required">*</span>
					</div>
				</div>
				</div>
                <div class="two" style="display:none">
                <div class="control-group">
					<label class="control-label">对应属性</label>
					<div class="controls">
						<select class="shuxing" name="attribute[id][]">
                        <option value="0">请选择</option>
                        <?php if(is_array($attribute)): foreach($attribute as $key=>$vo): if(is_array($vo['son'])): foreach($vo['son'] as $k=>$v): ?><option value="<?php echo ($key); ?>-<?php echo ($k); ?>"><?php echo ($vo["name"]); ?>/<?php echo ($v["name"]); ?>/<?php echo ($v["info"]); ?></option><?php endforeach; endif; endforeach; endif; ?>
                        </select>
                        <span class="form-required"><a href="javascript:;" id="addMore">添加更多</a></span>
					</div>
				</div>
                <div class="control-group" style="border-bottom:dotted 1px #333">
					<label class="control-label">详细参数</label>
					<div class="controls about">
						<input type="text" required name="attribute[cost_price][]" placeholder="成品价">
                        <input type="text" required name="attribute[selling_price][]" placeholder="销售价">
                        <input type="text" required name="attribute[market_value][]" placeholder="市场价">
                        <input type="text" required name="attribute[unit][]" placeholder="商品单位">
                        <input type="text" required name="attribute[stock][]" placeholder="库存">
					</div>
				</div>
                
                </div>
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('ADD');?></button>
				<a class="btn" href="javascript:history.back(-1);"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
     <script>
    $(document).ready(function(){
		$(".shuxing").change(function(){
			var value = $(this).val();
			$(this).parent().parent().next().children(".controls.about").load("index.php?g=Admin&m=Goods&a=shuxing&value="+value);
		});
		$("#addMore").click(function(){
			$(".two").last().append(window.infos);
		})
		var other = '<div class="control-group">';
		other += $(".two").children().prev().html();
		other += '</div>';
		other += '<div class="control-group">';
		other += $(".two").children().prev().next().html();
		other += '</div>';
		other += "\<script type=\"text/javascript\" src=\"getInfo.js\" >\</script\>";
		
		other = other.replace('<a href="javascript:;" id="addMore">添加更多</a>','<a href="javascript:;" class="deleteOne">删除</a>');
		window.infos = other;
	})

    </script>
    <script>
    $(function(){
		$("#navs a").click(function(){
			if ($(this).attr("class") == 1) {
				$(".one").show();
				$(".two").hide();
				$("#navs li").attr("class","");
				$(this).parent().attr("class","active");
			} else if ($(this).attr("class") == 2) {
				$(".one").hide();
				$(".two").show();
				$("#navs li").attr("class","");
				$(this).parent().attr("class","active");
			}
		})
	})
    </script>
    <script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.WEB_ROOT;
	</script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.all.min.js"></script>
    <script>
    editorcontent = new baidu.editor.ui.Editor({initialFrameHeight:200/*initialFrameWidth:400 */});
	editorcontent.render('content');
    </script>
   
</body>
</html>