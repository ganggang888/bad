<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ($site_name); ?></title>

<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
<meta name="description" content="<?php echo ($site_seo_description); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="/themes/simplebootx/Public/lib/weui.min.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/jquery-weui.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/style.css">
</head>
<body ontouchstart style="background:#323542;">
<!--主体-->
<div class="login-box">
  	<div class="lg-title">欢迎登陆伟义商城</div>
    <div class="login-form">
    	<form action="#">
        	<div class="login-user-name common-div">
            	<span class="eamil-icon common-icon">
                	<img src="/themes/simplebootx/Public/images/eamil.png" />
                </span>
                <input type="email" name="username" id="username" value="" placeholder="请输入您的手机号" />        
            </div>
            <div class="login-user-pasw common-div">
            	<span class="pasw-icon common-icon">
                	<img src="/themes/simplebootx/Public/images/password.png" />
                </span>
                <input type="password" id="password" name="password" value="" placeholder="请输入您的密码" />        
            </div>
            <a href="javascript:;" class="login-btn common-div" onclick="login()">登陆</a>
            <!--<a href="javascript:;" class="login-oth-btn common-div">微信登陆</a>
            <a href="javascript:;" class="login-oth-btn common-div">QQ登陆</a>-->
        </form>
    </div>
    <div class="forgets">
    	<a href="<?php echo leuu('Portal/index/forget');?>">忘记密码？</a>
        <a href="<?php echo leuu('User/Register/index');?>">免费注册</a>
    </div>
</div>
<!--底部导航-->
<div class="foot-black"></div>
<div class="weui-tabbar wy-foot-menu">
  <a href="index.html" class="weui-tabbar__item <?php if($index == 1): ?>weui-bar__item--on<?php endif; ?>">
    <div class="weui-tabbar__icon foot-menu-home"></div>
    <p class="weui-tabbar__label">首页</p>
  </a>
  <a href="<?php echo leuu('Portal/Index/good_list');?>" class="weui-tabbar__item weui-bar__item<?php if($shangpin == 1): ?>--on<?php endif; ?>">
    <div class="weui-tabbar__icon foot-menu-list"></div>
    <p class="weui-tabbar__label">商品</p>
  </a>
  <!--<a href="shopcart.html" class="weui-tabbar__item">
    <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span>
    <div class="weui-tabbar__icon foot-menu-cart"></div>
    <p class="weui-tabbar__label">购物车</p>
  </a>-->
  <a href="<?php echo leuu('User/Center/index');?>" class="weui-tabbar__item <?php if($huiyuan == 1): ?>weui-bar__item--on<?php endif; ?>">
    <div class="weui-tabbar__icon foot-menu-member"></div>
    <p class="weui-tabbar__label">我的</p>
  </a>
</div>
<script src="/themes/simplebootx/Public/lib/jquery-2.1.4.js"></script> 
<script src="/themes/simplebootx/Public/lib/fastclick.js"></script> 
<script type="text/javascript" src="/themes/simplebootx/Public/js/jquery.Spinner.js"></script>
<script src="/themes/simplebootx/Public/js.js"></script> 
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script>

<script src="/themes/simplebootx/Public/js/jquery-weui.js"></script>

</body>
</html>