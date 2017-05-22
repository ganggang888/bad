<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>我的收藏</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="/themes/simplebootx/Public/lib/weui.min.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/jquery-weui.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/style.css">
</head>
<body ontouchstart>
<!--顶部搜索-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">我的收藏</div>
</header>
<!--主体-->
<div class="weui-content">
  <div class='proListWrap'>
    
    
    <?php if(is_array($result)): foreach($result as $key=>$vo): $pics = json_decode($vo['photos_url'],true); $pics = current($pics); ?>
    <div class="pro-items">
      <div class="weui-media-box weui-media-box_appmsg">
        <div class="weui-media-box__hd"><a href="<?php echo leuu('Portal/Index/goodsInfo',array('id'=>$vo['gid']));?>">
        <?php if($pics): ?><img class="weui-media-box__thumb" src="<?php echo sp_get_image_preview_url($pics);?>" alt=""><?php endif; ?>
        </a></div>
        <div class="weui-media-box__bd">
          <h1 class="weui-media-box__desc"><a href="<?php echo leuu('Portal/Index/goodsInfo',array('id'=>$vo['gid']));?>" class="ord-pro-link"><?php echo ($vo["name"]); ?></a></h1>
          <div class="wy-pro-pri">积分<em class="num font-15"><?php echo ($vo["score"]); ?> </em></div>
          <ul class="weui-media-box__info prolist-ul">
            <li class="weui-media-box__info__meta"><a href="javascript:;" class="wy-dele" onclick="deleteShoucang(<?php echo ($vo["sid"]); ?>)"></a></li>
          </ul>
        </div>
      </div>
    </div><?php endforeach; endif; ?>

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