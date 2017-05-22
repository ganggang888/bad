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
.caption-wraper {
	position: absolute;
	left: 50%;
	bottom: 2em;
}
.caption-wraper .caption {
	position: relative;
	left: -50%;
	background-color: rgba(0, 0, 0, 0.54);
	padding: 0.4em 1em;
	color: #fff;
	-webkit-border-radius: 1.2em;
	-moz-border-radius: 1.2em;
	-ms-border-radius: 1.2em;
	-o-border-radius: 1.2em;
	border-radius: 1.2em;
}
 @media (max-width: 767px) {
.sy-box {
	margin: 12px -20px 0 -20px;
}
.caption-wraper {
	left: 0;
	bottom: 0.4em;
}
.caption-wraper .caption {
	left: 0;
	padding: 0.2em 0.4em;
	font-size: 0.92em;
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	-ms-border-radius: 0;
	-o-border-radius: 0;
	border-radius: 0;
}
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

商品名称：<?php echo ($info["name"]); ?>
<?php $attribute = json_decode($info['attribute'],true); ?>

<a href="javascript:;" class="simpleCart_empty">empty cart</a>
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
            <div class="count"> 数量: <span class="simpleCart_quantity"></span></div>
            <div class="ship"> 配送费: <span class="simpleCart_shipping"></span></div>
            <p class="grand"> 合计总额: <span class="simpleCart_grandTotal"></span></p>
          </div>
                </div>
      </div>
              <div class="well"> 
              请选择地址：
              <?php if(is_array($address)): foreach($address as $key=>$vo): ?><div class="address"><input type="radio" name="optionad" id="optionad" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["address"]); ?>|<?php echo ($vo["name"]); ?>|<?php echo ($vo["phone"]); ?></div><?php endforeach; endif; ?>
              <textarea id="ocontent" placeholder="请输入备注"></textarea>
              <?php if(empty($address)): ?><a href="<?php echo U('Center/addAddress');?>">添加地址</a><?php endif; ?>
              <p align="center"> <a href="javascript:;" class="btn btn-danger simpleCart_checkout" ><i class="fa fa-shopping-cart"></i> 提交订单</a></p>
              <!--if login end--> 
              
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
        <p style="text-align:center"> <a href="<?php echo U('Public/register/');?>" class="btn btn-danger">注册成为会员更多优惠</a> 　　　　　 <a href="<?php echo U('Cart/index/');?>" class="btn btn-default">不注册直接下单</a> </p>
      </div>
            </div>
    <!-- /.modal-content --> 
  </div>
          <!-- /.modal-dialog --> 
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
 <script>
 simpleCart.bind( 'beforeCheckout' , function( data ){
  
 
   data.addressid = document.getElementById("optionad").value;
  data.ocontent = document.getElementById("ocontent").value;
 
 data.item_totals = simpleCart.grandTotal();
   data.shopspay = simpleCart.shipping(); 
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