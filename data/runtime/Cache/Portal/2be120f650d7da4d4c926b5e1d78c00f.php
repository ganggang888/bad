<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>商品列表</title>
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
  <div class="wy-header-title">商品列表-<?php echo getSomeMessage('goods_term',$pid,'name');?>
  <?php if($_GET['name']): ?>搜索：<?php echo ($_GET['name']); endif; ?>
  </div>
</header>
<div class="weui-content">
  <div class="weui-navbar" style="position:fixed; top:44px; left:0; right:0; height:44px; background:#fff;">
  <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item<?php if($_GET['term_id'] == 0 && !$_GET['name']): ?>--on<?php endif; ?>" href="<?php echo leuu('Portal/Index/good_list',array('term_id'=>0,'pid'=>$pid));?>">全部商品</a>
  <?php if(!$_GET['pid'] && !$_GET['term_id']): if(is_array($termInfo)): foreach($termInfo as $key=>$vo): ?><a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item<?php if($_GET['term_id'] == $vo['id']): ?>--on<?php endif; ?>" href="<?php echo leuu('Portal/Index/good_list',array('pid'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; ?>
  <?php else: ?>
  <?php if(is_array($termInfo)): foreach($termInfo as $key=>$vo): ?><a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item<?php if($_GET['term_id'] == $vo['id']): ?>--on<?php endif; ?>" href="<?php echo leuu('Portal/Index/good_list',array('term_id'=>$vo['id'],'pid'=>$pid));?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; endif; ?>
  
  
  </div>
  <div class="wy-Module" style="margin-top:50px">
    <div class="wy-Module-con">
      <ul class="wy-pro-list clear">
      <?php if(is_array($result)): foreach($result as $key=>$vo): $info = json_decode($vo['photos_url'],true); ?>
        <li> <a href="<?php echo leuu('Portal/Index/goodsInfo',array('id'=>$vo['id']));?>">
          <div class="proimg"><?php if($info[0]): ?><img src="<?php echo sp_get_image_preview_url($info[0]);?>" /><?php endif; ?></div>
          <div class="protxt">
            <div class="name"><?php echo ($vo["name"]); ?></div>
            <div class="wy-pro-pri">0元+<?php echo ($vo["score"]); ?> 积分</div>
          </div>
          </a> </li><?php endforeach; endif; ?>
      </ul>
    </div>
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