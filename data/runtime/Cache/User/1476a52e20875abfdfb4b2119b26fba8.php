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
			<li class="active"><a><?php echo L('USER_INDEXADMIN_INDEX');?></a></li>
		</ul>
		<form class="well form-search" method="post" action="<?php echo U('Indexadmin/index');?>">
			用户名： 
			<input type="text" name="keyword" style="width: 200px;" value="<?php echo I('request.keyword');?>" placeholder="手机号">
            用户等级
            <select name="level">
            <option value="0">所有</option>
            <option value="1" <?php if($request['level'] == 1): ?>selected<?php endif; ?>>普通会员</option>
            <option value="2" <?php if($request['level'] == 2): ?>selected<?php endif; ?>>黄金会员</option>
            <option value="3" <?php if($request['level'] == 3): ?>selected<?php endif; ?>>钻石会员</option>
            <option value="4" <?php if($request['level'] == 4): ?>selected<?php endif; ?>>代理商</option>
            <option value="5" <?php if($request['level'] == 5): ?>selected<?php endif; ?>>股东商</option>
            </select>
			<input type="submit" class="btn btn-primary" value="搜索" />
			<a class="btn btn-danger" href="<?php echo U('Indexadmin/index');?>">清空</a>
		</form>
		<form method="post" class="js-ajax-form">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th align="center">ID</th>
						<th><?php echo L('USERNAME');?></th>
						<th>用户等级</th>
						<th><?php echo L('REGISTRATION_TIME');?></th>
						<th><?php echo L('LAST_LOGIN_TIME');?></th>
						<th><?php echo L('LAST_LOGIN_IP');?></th>
						<th><?php echo L('STATUS');?></th>
						<th align="center"><?php echo L('ACTIONS');?></th>
					</tr>
				</thead>
				<tbody>
					<?php $user_statuses=array("0"=>L('USER_STATUS_BLOCKED'),"1"=>L('USER_STATUS_ACTIVATED'),"2"=>L('USER_STATUS_UNVERIFIED')); ?>
					<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
						<td align="center"><?php echo ($vo["id"]); ?></td>
						<td><?php echo ($vo['user_login']?$vo['user_login']:($vo['mobile']?$vo['mobile']:L('THIRD_PARTY_USER'))); ?></td>
						<td>
                        <?php if($vo['level'] == 1): ?>普通会员
                        <?php elseif($vo['level'] == 2): ?>
                        黄金会员
                        <?php elseif($vo['level'] == 3): ?>
                        钻石会员
                        <?php elseif($vo['level'] == 4): ?>
                        代理商
                        <?php elseif($vo['level'] == 5): ?>
                        股东商<?php endif; ?>
                        </td>
						<td><?php echo ($vo["create_time"]); ?></td>
						<td><?php echo ($vo["last_login_time"]); ?></td>
						<td><?php echo ($vo["last_login_ip"]); ?></td>
						<td><?php echo ($user_statuses[$vo['user_status']]); ?></td>
						<td align="center">
							<?php if(($vo["id"]) != "1"): ?><a href="<?php echo U('indexadmin/ban',array('id'=>$vo['id']));?>" class="js-ajax-dialog-btn" data-msg="<?php echo L('BLOCK_USER_CONFIRM_MESSAGE');?>"><?php echo L('BLOCK_USER');?></a>|
								<a href="<?php echo U('indexadmin/cancelban',array('id'=>$vo['id']));?>" class="js-ajax-dialog-btn" data-msg="<?php echo L('ACTIVATE_USER_CONFIRM_MESSAGE');?>"><?php echo L('ACTIVATE_USER');?></a>
							<?php else: ?>
								<a style="color: #ccc;"><?php echo L('BLOCK_USER');?></a>|
								<a style="color: #ccc;"><?php echo L('ACTIVATE_USER');?></a><?php endif; ?>
						</td>
					</tr><?php endforeach; endif; ?>
				</tbody>
			</table>
			<div class="pagination"><?php echo ($page); ?></div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>