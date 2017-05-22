<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>密码修改</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="/themes/simplebootx/Public/lib/weui.min.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/jquery-weui.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/style.css">
</head>
<body ontouchstart>
<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">签到</div>
</header>
<div class="weui-content">
  <div style="text-align: -webkit-center;">
				<div  id="calendar"></div>
					<div style="text-align: center;">
						<input type="hidden" name="act" value="sign_do"> 
						<!-- <input type="submit"  class="button"  id="sign_buttn"/>已签到 -->
						<button class="sign_button" style="margin: 5% 0 5% 0;">已签到</button>
					</div>

				<div style=" text-align: left;margin-left: 10px;padding-bottom: 10px;margin-bottom: 20%">
					<h3>签到规则：</h3>
					<ul>
						<li>1.第一次1个积分，之后签到积分依次向上累计</li>
						<li>2.累计第五次签到后，之后连续签到每次5个积分</li>
						<li>3.断签后签到重新从1个积分开始累计</li>
					</ul>
				</div>

			</div>

</div>
<link rel="stylesheet" href="/themes/simplebootx/Public/css/sign.css">
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
<script type="text/javascript" src="/themes/simplebootx/Public/js/calendar.js"></script>

<script type="text/javascript">

$(function(){
  //ajax获取日历json数据
  var signList=[{"signDay":"13"},{"signDay":"17"}];
   calUtil.init(signList);
});

</script>

</body>
</html>