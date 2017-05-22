<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>提现操作</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="/themes/simplebootx/Public/lib/weui.min.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/jquery-weui.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/style.css">
</head>
<body ontouchstart>
<header class="wy-header" style="position:fixed; top:0; left:0; right:0; z-index:200;">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">提现操作-兑换积分</div>
</header>
<div class='weui-content'>
  <div class="weui-tab">
    <div class="weui-navbar" style="position:fixed; top:44px; left:0; right:0; height:44px; background:#fff;">
     
      
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item" href="<?php echo leuu('User/Other/getGold');?>">金币提现</a>
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item--on" href="<?php echo leuu('User/Other/index');?>">返现积分提现</a>
     
    </div>
    <div class="weui-tab__bd proinfo-tab-con" style="padding-top:87px;">
    <input type="number" name="score" id="score" class="ydy_jf_input fl" placeholder="2积分=1人民币" style="width:42%;    height: 43px;
    line-height: 43px;
    font-size: 14px; border:solid #dedcdd 1px; margin-top:10px; margin-left:10px">
    <span style="float:left; margin-top:20px; margin-left:5px">=</span><input type="number" name="rmb" id="rmb" class="ydy_jf_input fl" placeholder="人民币" style="width:42%;    height: 43px;
    line-height: 43px;
    font-size: 14px; border:solid #dedcdd 1px; margin-top:10px; margin-left:5px">
    
    </div>
    
    <div class="weui-cell__bd" style="width:90%; float:left; text-align:right; padding-right:10%">
    <p>可提现积分：<?php echo ($_SESSION['user']['can_monery']); ?></p>
    </div>
  </div>
  <div class="weui-cell wy-address-edit">
    <div class="weui-cell__hd"><label for="" class="weui-label wy-lab">提现银行</label></div>
    <div class="weui-cell__bd">
    <input class="weui-input" id="bank" type="text" value="请选择提现银行" readonly="" data-values="">
    </div>
    <div class="weui-cell__ft"><!--<i class="weui-icon-warn"></i>--></div>
  </div>
  <div class="weui-btn-area" style=" margin-top:200px"><a href="javascript:;" class="weui-btn weui-btn_warn" onclick="jf_tixian()">立即兑换</a></div>
</div>
<div class="ydy_jf_wenzi">
					&nbsp;&nbsp;&nbsp;兑换说明：
				</div>
                <div class="ydy_jf_wenzi ydy_jf_wenzi2 ydy_jf_wenzi3">
					&nbsp;&nbsp;&nbsp;两积分兑换一人民币。	
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
<script>
$("#bank").select({
	title:"请选择银行名称",
	items: [<?php echo ($tex); ?>]
})
</script>
</body>
</html>