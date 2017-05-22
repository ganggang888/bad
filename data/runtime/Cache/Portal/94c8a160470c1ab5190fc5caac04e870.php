<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
	<html>
	<head>
		<title><?php echo ($site_seo_title); ?> <?php echo ($site_name); ?></title>
		<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
		<meta name="description" content="<?php echo ($site_seo_description); ?>">
			<?php  function _sp_helloworld(){ echo "hello ThinkCMF!"; } function _sp_helloworld2(){ echo "hello ThinkCMF2!"; } function _sp_helloworld3(){ echo "hello ThinkCMF3!"; } ?>
	<?php $portal_index_lastnews="1,2"; $portal_hot_articles="1,2"; $portal_last_post="1,2"; $tmpl=sp_get_theme_path(); $default_home_slides=array( array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/1.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/2.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/3.jpg", "slide_url"=>"", ), ); ?>
	<meta name="author" content="ThinkCMF">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

   	<!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
	<link rel="icon" href="/themes/simplebootx/Public/assets/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/themes/simplebootx/Public/assets/images/favicon.ico" type="image/x-icon">
    <link href="/themes/simplebootx/Public/assets/simpleboot/themes/simplebootx/theme.min.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/assets/simpleboot/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/assets/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
	<!--[if IE 7]>
	<link rel="stylesheet" href="/themes/simplebootx/Public/assets/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link href="/themes/simplebootx/Public/assets/css/style.css" rel="stylesheet">
	<style>
		/*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
		#backtotop{position: fixed;bottom: 50px;right:20px;display: none;cursor: pointer;font-size: 50px;z-index: 9999;}
		#backtotop:hover{color:#333}
		#main-menu-user li.user{display: none}
	</style>
	
		
        <link href="/themes/simplebootx/Public/assets/css/slippry/slippry.css" rel="stylesheet">
        <link href="/themes/simplebootx/Public/assets/css/cart.css" rel="stylesheet">
        <link href="/themes/simplebootx/Public/assets/css/cart-min.css" rel="stylesheet">
        
		<style>
			.caption-wraper{position: absolute;left:50%;bottom:2em;}
			.caption-wraper .caption{
			position: relative;left:-50%;
			background-color: rgba(0, 0, 0, 0.54);
			padding: 0.4em 1em;
			color:#fff;
			-webkit-border-radius: 1.2em;
			-moz-border-radius: 1.2em;
			-ms-border-radius: 1.2em;
			-o-border-radius: 1.2em;
			border-radius: 1.2em;
			}
			@media (max-width: 767px){
				.sy-box{margin: 12px -20px 0 -20px;}
				.caption-wraper{left:0;bottom: 0.4em;}
				.caption-wraper .caption{
				left: 0;
				padding: 0.2em 0.4em;
				font-size: 0.92em;
				-webkit-border-radius: 0;
				-moz-border-radius: 0;
				-ms-border-radius: 0;
				-o-border-radius: 0;
				border-radius: 0;}
			}
		</style>
	</head>
<body class="body-white">
<?php echo hook('body_start');?>
<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="/"><img src="/themes/simplebootx/Public/assets/images/logo.png"/></a>
       <div class="nav-collapse collapse" id="main-menu">
       	<?php
 $effected_id="main-menu"; $filetpl="<a href='\$href' target='\$target'>\$label</a>"; $foldertpl="<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>\$label <b class='caret'></b></a>"; $ul_class="dropdown-menu" ; $li_class="li-class" ; $style="nav"; $showlevel=6; $dropdown='dropdown'; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>
		
		<ul class="nav pull-right" id="main-menu-user">
			<!-- <li class="user login" style="margin-left: 5px;">
	            <a class="dropdown-toggle user notifactions" href="<?php echo U('user/notification/index');?>">
	            <i class="fa fa-envelope"></i>
	            <span class="count">0</span>
	            </a>
          	</li> -->
			<li class="dropdown user login">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	            <img src="/themes/simplebootx/Public/assets/images/headicon.png" class="headicon"/>
	            <span class="user-nicename"></span><b class="caret"></b></a>
	            <ul class="dropdown-menu pull-right">
	               <li><a href="<?php echo U('user/center/index');?>"><i class="fa fa-user"></i> &nbsp;个人中心</a></li>
	               <li class="divider"></li>
	               <li><a href="<?php echo U('user/index/logout');?>"><i class="fa fa-sign-out"></i> &nbsp;退出</a></li>
	            </ul>
          	</li>
          	<li class="dropdown user offline">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	           		<img src="/themes/simplebootx/Public/assets/images/headicon.png" class="headicon"/>登录<b class="caret"></b>
	            </a>
	            <ul class="dropdown-menu pull-right">
	               <li><a href="<?php echo U('api/oauth/login',array('type'=>'sina'));?>"><i class="fa fa-weibo"></i> &nbsp;微博登录</a></li>
	               <li><a href="<?php echo U('api/oauth/login',array('type'=>'qq'));?>"><i class="fa fa-qq"></i> &nbsp;QQ登录</a></li>
	               <li><a href="<?php echo leuu('user/login/index');?>"><i class="fa fa-sign-in"></i> &nbsp;登录</a></li>
	               <li class="divider"></li>
	               <li><a href="<?php echo leuu('user/register/index');?>"><i class="fa fa-user"></i> &nbsp;注册</a></li>
	            </ul>
          	</li>
		</ul>
		<div class="pull-right">
        	<form method="post" class="form-inline" action="<?php echo U('portal/search/index');?>" style="margin:18px 0;">
				 <input type="text" class="" placeholder="Search" name="keyword" value="<?php echo I('get.keyword');?>"/>
				 <input type="submit" class="btn btn-info" value="Go" style="margin:0"/>
			</form>
		</div>
       </div>
     </div>
   </div>
 </div>

<?php $home_slides=sp_getslide("portal_index"); $home_slides=empty($home_slides)?$default_home_slides:$home_slides; ?>
商品名称：<?php echo ($info["name"]); ?>
<?php $attribute = json_decode($info['attribute'],true); ?>
<?php if(is_array($attribute)): foreach($attribute as $key=>$v): ?><div class="col-sm-4 col-xs-6 simpleCart_shelfItem row-padding">
			   <div class="thumbnail i_list">
	  <div class="caption">
        <h3 class="item_name"><a href="<?php echo U('Index/goodsInfo',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></h3>
        <input value="<?php echo ($info["id"]); ?>-<?php echo ($key); ?>" class="item_Quantity" type="hidden">
    <p ><span class="pull-left item_price" style="color:#FF7700;font-weight:600;font-size:14px"> ￥<?php echo ($v["selling_price"]); ?> </span>
		<span class="pull-right "><a  href="javascript:;" class="btn btn-warning btn-sm item_add"><i class="fa fa-shopping-cart"></i> 加入购物车</a> </span>
		
		</p>
		<div class="clearfix"></div>
	  </div>
      </div>
	   </div>

                   成本价：<?php echo ($v["cost_price"]); ?> &nbsp;&nbsp;销售价：<?php echo ($v["selling_price"]); ?>&nbsp;&nbsp; 市场价：<?php echo ($v["market_value"]); ?>&nbsp;&nbsp; 单位：<?php echo ($v["unit"]); ?> &nbsp;&nbsp;库存：<?php echo ($v["stock"]); ?>&nbsp;&nbsp;
                   <?php $info = explode('-',$v['id']); ?>
                   <?php echo ($attributes[$info[0]]['son'][$info[1]]['name']); ?>：<?php echo ($v["name"]); ?>&nbsp;&nbsp;
                   <?php echo ($attributes[$info[0]]['son'][$info[1]]['info']); ?> : <?php echo ($v["info"]); ?><br/><?php endforeach; endif; ?>

<div style="background-color:#FF7700" class="panel panel-cart top5">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
          <i class="fa fa-shopping-cart"></i> 购物车 <i class="fa fa-angle-down"></i>
         <span class="simpleCart_quantity pull-right">0</span>
		</a>
      </h4>
    </div>
    <div class="panel-collapse collapse in" id="collapseOne">
      <div style="padding:5px;" class="panel-body">
   <div style="max-height:250px;overflow:auto;">    
<div class="simpleCart_items"> <div><div class="headerRow"><div class="item-name">商品</div><div class="item-price">单价</div><div class="item-decrement"></div><div class="item-quantity">数量</div><div class="item-increment"></div><div class="item-total">总价</div><div class="item-remove">操作</div></div></div></div>
</div>
<div style="clear:left"></div>
 <hr class="top5">

<div class="count">
数量: <span class="simpleCart_quantity">0</span></div>
<div class="ship">
配送费: <span class="simpleCart_shipping">¥0</span> (含打包费)</div>
<p class="grand">
合计总额: <span class="simpleCart_grandTotal">¥0</span></p>
 
<p align="center"><span style="margin-right:20px;" class="pull-right"><a href="javascript:;" class="simpleCart_empty">清空</a> </span>
	<a href="<?php echo U('Index/Cart');?>" class="btn btn-warning"><i class="fa fa-shopping-cart"></i> 立刻结算</a> 
	
 
</p>
 
	  </div>
    </div>
  </div>
  
  <div class=" container " style="margin-top:10px">

   <div class="panel panel-cart">
    <div class="panel-heading">
    <h3 class="panel-title">购物车</h3>
  </div>
             <div class="panel-body">

<div class="row">
	  
			 
	   <div class="col-md-12">
	     

<div class="simpleCart_items" ></div>
<div style="clear:left"></div>

<hr>
<div class="">
<div class="count">
数量: <span class="simpleCart_quantity"></span></div>
<div class="ship">
配送费: <span class="simpleCart_shipping"></span></div>
<p class="grand">
合计总额: <span class="simpleCart_grandTotal"></span></p>

</div>

	 

	  
	   
	   
	   
	   
	   
	   
	   </div>
 
	   
	   
	   </div>


<div class="well">	
<!--判定是否为登录用户-->
<?php if(empty($uid)): ?><div class="form-horizontal" >
			   <div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">收货人：</div>
    <div class="col-sm-3">
	
	<input type="text" class="form-control" name="oman" id="oman" placeholder="请输入收货人姓名" datatype="*"  sucmsg="" nullmsg="请输入收货人姓名！" errormsg="" >
	



	

      
    </div>
	 <div class="col-sm-7 col-xs-12"><div class="Validform_checktip "></div></div>
  </div>
  <div class="form-group fps">
    <div for="inputPassword3" class="col-sm-2 control-label">手机号：</div>
    <div class="col-sm-3">
	
      <input type="text" class="form-control" name="otel" id="otel" placeholder="请输入手机号" datatype="m"  sucmsg="" nullmsg="请输入手机号！" errormsg="手机号码不正确">
	 
	  
    </div>
	<div class="col-sm-7"><div class="Validform_checktip "></div></div>
  </div>
  <!--<?php if(empty($oman)): ?><div class="form-group fps">
    <div for="inputPassword3" class="col-sm-2 control-label">验证码：</div>
    <div class="col-sm-3">

      <input type="text" class="form-control" name="ote" placeholder="" datatype="*6-6"  sucmsg="" nullmsg="请输入正确的验证码！" errormsg="验证码错误!">
	 
	 
	  
    </div>
	<div class="col-sm-6"><span class="Validform_checktip "></span> <button type="button" data-loading-text="正在发送..." class="btn btn-default btn-sm pull-left">获取验证码</button></div>
	<div class="col-sm-1"></div>
  </div>
  <?php else: endif; ?>-->
  <div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">地址：</div>
    <div class="col-sm-4">
	
      <input type="text" class="form-control" id="oaddress" name="oaddress" placeholder="请输入地址" datatype="*"  sucmsg="" nullmsg="请输入地址！" errormsg="" >
	 
	 
    </div>
	<div class="col-sm-6"><div class="Validform_checktip "></div></div>
  </div>
  <!--
  <div class="form-group">
    <div for="inputPassword3" class="col-sm-3 control-label">支付方式</div>
    <div class="col-sm-9">
      <div class="radio">
  <label>
    <input type="radio" name="" id="optionsRadios1" value="1" checked>
   
  </label>
</div>
    </div>
	 </div>-->
	 <div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">送货时间</div>
	
	    <div class="col-sm-2">
		<select class="form-control" id="days" name="days">
		 

<option value="<?php echo date('Y-m-d'); ?>"><?php echo date('Y-m-d'); ?></option>
 <option value="<?php echo date('Y-m-d',strtotime('+1 day')); ?>"><?php echo date('Y-m-d',strtotime('+1 day')); ?></option>
                 
                         
	     </select>
	
					
   </div>
    <div class="col-sm-2">
	

	<select class="form-control" id="times" name="times">
					
 <?php $__FOR_START_13021__=substr((intval($openstime)),0,2);$__FOR_END_13021__=substr((intval($openetime)),0,2);for($i=$__FOR_START_13021__;$i < $__FOR_END_13021__;$i+=1){ if(($i) >= "10"): ?><option value="<?php echo ($i); ?>:00"><?php echo ($i); ?>:00</option>
                           <option value="<?php echo ($i); ?>:30"><?php echo ($i); ?>:30</option>
						   

						<?php else: ?>
						     <option value="0<?php echo ($i); ?>:00">0<?php echo ($i); ?>:00</option>
                           <option value="0<?php echo ($i); ?>:30">0<?php echo ($i); ?>:30</option><?php endif; } ?>
</select>
					
   </div>
	<div class="col-sm-6"></div>
  </div>
	   <div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">备注：</div>
    <div class="col-sm-4">
    <span class="help-block">  

<textarea class="form-control"  id="ocontent" name="ocontent"   row="3"></textarea></span>
 



    </div>
	<div class="col-sm-6"></div>
  </div>
     <div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">支付方式：</div>
    <div class="col-sm-4">
   
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="paytyle1" value="1" checked> 货到付款
</label>
<label class="radio-inline">
<!-- Modal 
  <input type="radio" name="inlineRadioOptions" id="paytyle2"  value="2"> 在线支付
-->
  </label>



    </div>
	<div class="col-sm-6"></div>
  </div>
  
 <p align="center"> <a href="javascript:;" class="btn btn-danger simpleCart_checkout" ><i class="fa fa-shopping-cart"></i> 提交订单</a></p>
	
</div>	


</div>



<?php else: ?> <!--用户登录状态-->

				   <div class="form-horizontal" >
<div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">地址：</div>
    <div class="col-sm-8">
	<?php if(empty($addlist)): ?><input type="radio" name="optionad" checked id="optionsRadios2" value="">
    
	
	
	
	<?php else: ?> 
	<?php if(is_array($addlist)): $i = 0; $__LIST__ = $addlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="radio">
  <label>
  <?php if(($vo["addtop"]) == "1"): ?><input type="radio" name="optionad" checked id="optionad" value="<?php echo ($vo["name"]); ?>,<?php echo ($vo["tel"]); ?>,<?php echo ($vo["address"]); ?>">
    
  <?php else: ?>
   <input type="radio" name="optionad"  id="optionad" value="<?php echo ($vo["name"]); ?>,<?php echo ($vo["tel"]); ?>,<?php echo ($vo["address"]); ?>"><?php endif; ?>

   <?php echo ($vo["name"]); ?>,<?php echo ($vo["tel"]); ?>,<?php echo ($vo["address"]); ?>
	
  </label>
</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>

	

	

      
    </div>
	 <div class="col-sm-2 col-xs-12"><a href="<?php echo U('Address/add/');?>" data-toggle="modal" data-target="#myModal">增加地址</a></div>
  </div>

 <div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">送餐时间</div>
	
	
     <div class="col-sm-2">
		<select class="form-control" id="days" name="days">
		 

<option value="<?php echo date('Y-m-d'); ?>"><?php echo date('Y-m-d'); ?></option>
 <option value="<?php echo date('Y-m-d',strtotime('+1 day')); ?>"><?php echo date('Y-m-d',strtotime('+1 day')); ?></option>
                 
                         
	     </select>
	
					
   </div>
    <div class="col-sm-2">
	

	<select class="form-control" id="times" name="times">
					
 <?php $__FOR_START_11858__=substr((intval($openstime)),0,2);$__FOR_END_11858__=substr((intval($openetime)),0,2);for($i=$__FOR_START_11858__;$i < $__FOR_END_11858__;$i+=1){ if(($i) >= "10"): ?><option value="<?php echo ($i); ?>:00"><?php echo ($i); ?>:00</option>
                           <option value="<?php echo ($i); ?>:30"><?php echo ($i); ?>:30</option>
						   

						<?php else: ?>
						     <option value="0<?php echo ($i); ?>:00">0<?php echo ($i); ?>:00</option>
                           <option value="0<?php echo ($i); ?>:30">0<?php echo ($i); ?>:30</option><?php endif; } ?>
</select>
					
   </div>
	<div class="col-sm-6"></div>
  </div>
	   <div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">备注：</div>
    <div class="col-sm-4">
    <span class="help-block">  

<textarea class="form-control" id="ocontent" name="ocontent"   row="3"></textarea></span>
 



    </div>
	<div class="col-sm-6"></div>
  </div>
	   <div class="form-group fps">
    <div for="inputEmail3" class="col-sm-2 control-label">支付方式</div>
    <div class="col-sm-7">
  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="paytyle" value="1" checked> 货到付款
</label>
<label class="radio-inline">
<!-- Modal 
  <input type="radio" name="inlineRadioOptions" id="paytyle"  value="2"> 在线支付
-->
  </label>
    </div>
	<div class="col-sm-3"></div>
  </div>
 <p align="center"> <a href="javascript:;" class="btn btn-danger simpleCart_checkout" ><i class="fa fa-shopping-cart"></i> 提交订单</a></p>
	



  </div>

 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
</div><!-- /.modal --><?php endif; ?><!--if login end--> 	


		 
</div>	











 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
				  
	 
		
			</div>
</div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">提示</h4>
      </div>
      <div class="modal-body">
       
   <p style="text-align:center">   
   <a href="<?php echo U('Public/register/');?>" class="btn btn-danger">注册成为会员更多优惠</a>
　　　　　
   <a href="<?php echo U('Cart/index/');?>" class="btn btn-default">不注册直接下单</a>

  </p>
  



      </div>
       
	 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
//全局变量
var GV = {
    ROOT: "/",
    WEB_ROOT: "/",
    JS_ROOT: "public/js/"
};
</script>
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="/public/js/jquery.js"></script>
   <script src="/public/js/wind.js"></script>
   <script src="/themes/simplebootx/Public/assets/simpleboot/bootstrap/js/bootstrap.min.js"></script>
   <script src="/public/js/frontend.js"></script>
<script>
$(function(){
	$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
	
	$("#main-menu li.dropdown").hover(function(){
		$(this).addClass("open");
	},function(){
		$(this).removeClass("open");
	});
	
	$.post("<?php echo U('user/index/is_login');?>",{},function(data){
		if(data.status==1){
			if(data.user.avatar){
				$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"<?php echo sp_get_image_url('[AVATAR]','!avatar');?>".replace('[AVATAR]',data.user.avatar));
			}
			
			$("#main-menu-user .user-nicename").text(data.user.user_nicename!=""?data.user.user_nicename:data.user.user_login);
			$("#main-menu-user li.login").show();
			
		}
		if(data.status==0){
			$("#main-menu-user li.offline").show();
		}
		
		/* $.post("<?php echo U('user/notification/getLastNotifications');?>",{},function(data){
			$(".nav .notifactions .count").text(data.list.length);
		}); */
		
	});	
	;(function($){
		$.fn.totop=function(opt){
			var scrolling=false;
			return this.each(function(){
				var $this=$(this);
				$(window).scroll(function(){
					if(!scrolling){
						var sd=$(window).scrollTop();
						if(sd>100){
							$this.fadeIn();
						}else{
							$this.fadeOut();
						}
					}
				});
				
				$this.click(function(){
					scrolling=true;
					$('html, body').animate({
						scrollTop : 0
					}, 500,function(){
						scrolling=false;
						$this.fadeOut();
					});
				});
			});
		};
	})(jQuery); 
	
	$("#backtotop").totop();
	
	
});
</script>


<script language="javascript" src="/themes/simplebootx/Public/assets/js/simpleCart.min.js"></script>
<script>
  simpleCart({
   checkout: {
        type: "SendForm" ,
url: "index.php?g=User&m=center&a=save" ,
method: "POST" , 
    },
	currency: "JPY",
	shippingQuantityRate: 0,
	shippingTotalRate: 0,
	 /*shippingFlatRate: <?php echo ($pspay); ?>,*/
	cartColumns: [
{ attr: "name" , label: "商品" } ,
{ attr: "price" , label: "单价", view: 'currency' } ,
{ view: "decrement" , label: false , text: "-" } ,
{ attr: "quantity" , label: "数量" } ,
{ view: "increment" , label: false , text: "+" } ,
{ attr: "total" , label: "总价", view: 'currency' } ,
{ view: "remove" , text: "删除" , label: false }
]
  });
 </script>
 <script>
   
    $("div[role='dialog']").on("show.bs.modal", function() {  
        // 具体css样式调整  
        $(this).css({  
            "display": "block",  
            "margin-top": function() {  
                return ($(this).height() / 3);  
            }  
        });  
    });  

 </script>		
	
		<script type="text/javascript">

	
	
simpleCart.bind( "update" , function(){

 if(simpleCart.total()<=0){
 $("#cartSubmit").hide();
 $("#cartIsEmpty").show();
 $("#cartCha").hide();
 }
 else{
	 if( <?php echo ($startpay); ?>- simpleCart.total() <=0){
      $("#cartSubmit").show();
	$("#cartIsEmpty").hide();
	  $("#cartCha").hide();
    } else {
	$("#cartCha").show();
	$("#cartSubmit").hide();
    $("#cartIsEmpty").hide();
   var showimg = <?php echo ($startpay); ?>- simpleCart.total();
$("#cha").text(showimg);
    }}
 
});



	
	 </script>
<script src="/themes/simplebootx/Public/assets/js/slippry.min.js"></script>
<script>
$(function() {
	var demo1 = $("#homeslider").slippry({
		transition: 'fade',
		useCSS: true,
		captions: false,
		speed: 1000,
		pause: 3000,
		auto: true,
		preload: 'visible'
	});
});
</script>
<?php echo hook('footer_end');?>
</body>
</html>