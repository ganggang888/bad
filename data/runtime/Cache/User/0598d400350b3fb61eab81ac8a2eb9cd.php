<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>地址管理</title>
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
  <div class="wy-header-title">地址管理</div>
</header>
<div class="weui-content">
  <div class="weui-panel address-box">
  <?php if(is_array($info)): foreach($info as $key=>$vo): ?><div class="weui-panel__bd">
      <div class="weui-media-box weui-media-box_text address-list-box">
        <a href="<?php echo leuu('User/Center/editAddress',array('id'=>$vo['id']));?>" class="address-edit"></a>
        <h4 class="weui-media-box__title">
        <?php if($good_id): ?><a href="<?php echo leuu('User/Center/duihuan',array('good_id'=>$good_id,'pid'=>$pid,'address_id'=>$vo['id'],'type1'=>$type1,'type2'=>$type2));?>"><span><?php echo ($vo["name"]); ?></span><span><?php echo ($vo["phone"]); ?></span></a>
        <?php else: ?>
        <span><?php echo ($vo["name"]); ?></span><span><?php echo ($vo["phone"]); ?></span><?php endif; ?>
        </h4>
        <p class="weui-media-box__desc address-txt"><?php echo ($vo["address"]); ?></p>
        <?php if($vo['listorder'] == 1): ?><span class="default-add">默认地址</span><?php endif; ?>
      </div>
    </div><?php endforeach; endif; ?>
  </div>
  <div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="<?php echo leuu('User/Center/addAddress');?>" id="showTooltips">添加收货地址</a>
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