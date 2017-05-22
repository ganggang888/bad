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
			<li class="active"><a href="javascript:;">用户提现记录</a></li>
		</ul>
        <form class="well form-search">
		
			时间：
			<input type="text" id="begin" name="start_time" class="js-date" value="<?php echo ((isset($begin) && ($begin !== ""))?($begin):''); ?>" style="width: 120px;" autocomplete="off" placeholder="开始时间">-
			<input type="text" class="js-date" name="end_time" value="<?php echo ((isset($end) && ($end !== ""))?($end):''); ?>" style="width: 120px;" autocomplete="off" id="end" placeholder="结束时间"> &nbsp; &nbsp;
			用户名： 
			<input type="text" name="mobile" id="mobile" style="width: 200px;" value="<?php echo ((isset($mobile) && ($mobile !== ""))?($mobile):''); ?>" placeholder="请输入用户名...">
			<a class="btn " href="javascript:;" onClick="doSearch()">搜索</a>
		</form>
        <script>
        function doSearch()
		{
			var begin = $("#begin").val();
			var end = $("#end").val();
			var mobile = $("#mobile").val();
			window.location.href='index.php?g=User&m=Indexadmin&a=jb_dh_jf&begin='+begin+'&end='+end+'&mobile='+mobile;
		}
        </script>
		<form class="js-ajax-form" action="" method="post">
			
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="60">用户名</th>
						<th>提现金额</th>
                        <th>状态</th>
                        <th>类别</th>
                        <th>提现银行卡信息</th>
                        <th>提交时间</th>
                        <th>操作</th>
					</tr>
				</thead>
				<?php if(is_array($result)): foreach($result as $key=>$vo): ?><tr>
					<td><?php echo ($vo["mobile"]); ?></td>
					<td><b><?php echo ($vo["money"]); ?></b></td>
                    <td><b><?php if($vo['status'] == 1): ?>处理中
         <?php elseif($vo['status'] == 2): ?>
         成功
         <?php elseif($vo['status'] == 3): ?>
         驳回<?php endif; ?></b></td>
        <td>
        <?php if($vo['type'] == 1): ?>积分提现
        <?php elseif($vo['type'] == 2): ?>
        金币提现<?php endif; ?>
        </td>
                    <td>姓名：<?php echo getSomeMessage('bank',$vo['bank_id'],'name');?><br/>
                    银行卡名称：<?php echo getSomeMessage('bank',$vo['bank_id'],'bank_name');?><br/>
                    卡号：<?php echo getSomeMessage('bank',$vo['bank_id'],'card');?>
                    </td>
                    <td>
                    <?php echo ($vo["add_time"]); ?>
                    </td>
                    <th>
                    <a href="<?php echo U('User/Indexadmin/change_tixian_status',array('status'=>2,'id'=>$vo['id']));?>" class="js-ajax-dialog-btn" data-msg="确定打款成功？">已成功</a> | 
                   <a href="<?php echo U('User/Indexadmin/change_tixian_status',array('status'=>3,'id'=>$vo['id']));?>" class="js-ajax-dialog-btn" data-msg="确定驳回？">驳回</a> 
                    
                    </th>
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