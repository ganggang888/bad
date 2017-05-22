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
			<li class="active"><a href="javascript:;">商品首页</a></li>
			<li><a href="<?php echo U('Goods/add');?>" target="_self">添加商品</a></li>
		</ul>
		<form class="well form-search">
			分类： 
			<select name="term" id="term" style="width: 120px;">
				<option value='0'>全部</option>
                <?php echo ($tree); ?>
			</select> &nbsp;&nbsp;
			时间：
			<input type="text" id="begin" name="start_time" class="js-date" value="<?php echo ((isset($begin) && ($begin !== ""))?($begin):''); ?>" style="width: 120px;" autocomplete="off">-
			<input type="text" class="js-date" name="end_time" value="<?php echo ((isset($end) && ($end !== ""))?($end):''); ?>" style="width: 120px;" autocomplete="off" id="end"> &nbsp; &nbsp;
			标题： 
			<input type="text" name="name" id="name" style="width: 200px;" value="<?php echo ((isset($name) && ($name !== ""))?($name):''); ?>" placeholder="请输入标题...">
			<a class="btn " href="javascript:;" onClick="doSearch()">搜索</a>
		</form>
        <script>
        function doSearch()
		{
			var term_id = $("#term").val();
			var begin = $("#begin").val();
			var end = $("#end").val();
			var name = $("#name").val();
			window.location.href='index.php?g=Admin&m=Goods&a=index&term_id='+term_id+'&begin='+begin+'&end='+end+'&name='+name;
		}
        </script>
		<form class="js-ajax-form" action="" method="post">
			
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="15"><label><input type="checkbox" class="js-check-all" data-direction="x" data-checklist="js-check-x"></label></th>
						<th width="50">排序</th>
						<th>商品名称</th>
                        <th>所属分类</th>
						<th>缩略图</th>
						<th>商品属性</th>
                        <th>积分</th>
						<th width="50">状态</th>
                        <th width="50">商家推荐</th>
                        <th width="50">酒水推荐</th>
                        <th width="50">添加时间</th>
						<th width="70">操作</th>
					</tr>
				</thead>
				<?php if(is_array($result)): foreach($result as $key=>$vo): ?><tr>
					<td><input type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x" name="ids[]" value="<?php echo ($vo["id"]); ?>" title="ID:<?php echo ($vo["id"]); ?>"></td>
					<td><input name="listorders[<?php echo ($vo["id"]); ?>]" class="input input-order" type="text" size="5" value="<?php echo ($vo["listorder"]); ?>"></td>
					<td><b><?php echo ($vo["name"]); ?></b></td>
                    <td><b><?php echo ($vo["term_name"]); ?></b></td>
					<td>
					 <?php $info = json_decode($vo['photos_url'],true); ?>
                    <?php if($info): if(is_array($info)): foreach($info as $key=>$v): ?><a href="<?php echo sp_get_image_preview_url($v);?>"><img src="<?php echo sp_get_image_preview_url($v);?>" width="100" style="float:left"></a><?php endforeach; endif; ?>
                    <?php else: ?>
                    无<?php endif; ?>
					</td>
					<td>
                    <?php $attribute = json_decode($vo['attribute'],true); ?>
                   <?php if(is_array($attribute)): foreach($attribute as $key=>$v): ?>成本价：<?php echo ($v["cost_price"]); ?> &nbsp;&nbsp;销售价：<?php echo ($v["selling_price"]); ?>&nbsp;&nbsp; 市场价：<?php echo ($v["market_value"]); ?>&nbsp;&nbsp; 单位：<?php echo ($v["unit"]); ?> &nbsp;&nbsp;库存：<?php echo ($v["stock"]); ?>&nbsp;&nbsp;
                   <?php $info = explode('-',$v['id']); ?>
                   <?php echo ($attributes[$info[0]]['son'][$info[1]]['name']); ?>：<?php echo ($v["name"]); ?>&nbsp;&nbsp;
                   <?php echo ($attributes[$info[0]]['son'][$info[1]]['info']); ?> : <?php echo ($v["info"]); ?><br/><?php endforeach; endif; ?>
                    </td>
                    <td><?php echo ($vo["score"]); ?></td>
					<td>
                    <?php echo $vo['status'] == 1 ? '上架' : '下架'; ?>
                    </td>
					<td>
						<?php echo $vo['indexs'] == 1 ? '是' : '否'; ?>
					</td>
                    <td>
						<?php echo $vo['member'] == 1 ? '是' : '否'; ?>
					</td>
                    <td>
						<?php echo ($vo["add_time"]); ?>
					</td>
					<td>
						<a href="<?php echo U('Goods/edit',array('id'=>$vo['id']));?>">修改</a> 
					</td>
				</tr><?php endforeach; endif; ?>
				
			</table>
			<div class="table-actions">
			  <button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Goods/listorders');?>">排序</button>
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Goods/changeStatus',array('type'=>1,'status'=>1));?>" data-subcheck="true">会员推荐</button>
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Goods/changeStatus',array('type'=>1,'status'=>0));?>" data-subcheck="true">取消会员推荐</button>
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Goods/changeStatus',array('type'=>2,'status'=>1));?>" data-subcheck="true">商家推荐</button>
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Goods/changeStatus',array('type'=>2,'status'=>0));?>" data-subcheck="true">取消商家推荐</button>
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Goods/changeStatus',array('type'=>3,'status'=>1));?>" data-subcheck="true">上架</button>
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Goods/changeStatus',array('type'=>3,'status'=>0));?>" data-subcheck="true">下架</button>
				
				
				<button class="btn btn-danger btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Goods/delete');?>" data-subcheck="true" data-msg="你确定删除吗？"><?php echo L('DELETE');?></button>
			</div>
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