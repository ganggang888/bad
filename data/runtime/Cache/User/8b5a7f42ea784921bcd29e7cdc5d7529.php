<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>返现收益记录</title>
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
  <div class="wy-header-title">返现收益记录</div>
</header>
<div class="weui-content">
<div class="weui-navbar" style="position:fixed; top:44px; left:0; right:0; height:44px; background:#fff;">
     
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item" href="<?php echo leuu('User/Center/fx_log');?>">返现收益记录</a>
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item--on" href="<?php echo leuu('User/Other/lcsy_history');?>">理财收益记录</a>
     
    </div>
  <div class="weui-cells wy-news-list" style="margin-top:43px">
    
     <?php if(is_array($result)): foreach($result as $key=>$vo): ?><a class="weui-cell weui-cell">
      <div class="weui-cell__bd">
        <p>
        <?php if($vo['type'] == 1): ?>金币活期收益
        <?php elseif($vo['type'] == 2): ?>
        代理商活期积分收益<?php endif; ?>
        
        </p>
      	<p>收益：<?php echo ($vo['money']); ?></p>
      </div>
      <div class="weui-cell__ft"><?php echo date("Y-m-d",strtotime($vo['add_time']));?></div>
     </a><?php endforeach; endif; ?>
  </div>
  <div class="weui-cell__bd" style="width:90%; float:left; text-align:right; padding-right:10%">
    <p>可提现积分：<?php echo ($_SESSION['user']['can_monery']); ?></p>
    </div>
  <div class="weui-btn-area" style=" margin-top:90px"><a href="<?php echo leuu('User/Other/tixian');?>" class="weui-btn weui-btn_warn">申请提现</a></div>
</div>
<div class="ydy_jf_wenzi">
					&nbsp;&nbsp;&nbsp;提现说明：
				</div>
                <div class="ydy_jf_wenzi ydy_jf_wenzi2">
					&nbsp;&nbsp;&nbsp;返现收益超过2000即可提现；
				</div>
                <div class="ydy_jf_wenzi ydy_jf_wenzi2 ydy_jf_wenzi3">
					&nbsp;&nbsp;&nbsp;两个返现积分兑换一人民币。	
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