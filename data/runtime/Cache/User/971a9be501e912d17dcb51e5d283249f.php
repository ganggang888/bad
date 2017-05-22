<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>银行卡</title>
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
  <div class="wy-header-title">添加银行卡</div>
</header>
<div class="weui-content">
<div class="weui-cell wy-address-edit">
    <div class="weui-cell__hd"><label for="" class="weui-label wy-lab">银行名称</label></div>
    <div class="weui-cell__bd">
    <select id="bank_name" class="weui-input">
    <?php if(is_array($bankInfo)): foreach($bankInfo as $key=>$vo): ?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
    </select>
    </div>
    <div class="weui-cell__ft"><!--<i class="weui-icon-warn"></i>--></div>
  </div>
  <div class="weui-cell wy-address-edit">
    <div class="weui-cell__hd"><label for="" class="weui-label wy-lab">卡号</label></div>
    <div class="weui-cell__bd"><input class="weui-input" type="number" pattern="[0-9]*" id="card" value="weui input error" placeholder="请输入卡号"></div>
    <div class="weui-cell__ft"><!--<i class="weui-icon-warn"></i>--></div>
  </div>
  <div class="weui-cell wy-address-edit">
    <div class="weui-cell__hd"><label class="weui-label wy-lab">持卡人</label></div>
    <div class="weui-cell__bd"><input class="weui-input" type="text" pattern="[0-9]*" placeholder="请输入名称" id="name"></div>
  </div>
  <div class="weui-cell wy-address-edit">
    <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
    <div class="weui-cell__bd"><input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入手机号" id="phone"></div>
  </div>
  <div class="weui-btn-area">
   <a href="javascript:;" class="weui-btn weui-btn_plain-default" onclick="bank_add()">保存此银行卡</a>
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

<script src="js/jquery-weui.js"></script>
<script>
$(document).on("click", ".card-opt", function() {
        $.actions({
          actions: [
            {
              text: "删除",
              className: 'bg-danger',
            }
          ]
        });
      });
</script>
</body>
</html>