<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>订单详情</title>
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
  <div class="wy-header-title">订单详情</div>
</header>
<div class="weui-content">
  <div class="wy-media-box weui-media-box_text address-select">
    <div class="weui-media-box_appmsg">
      <div class="weui-media-box__hd proinfo-txt-l" style="width:20px;"><span class="promotion-label-tit"><img src="/themes/simplebootx/Public/images/icon_nav_city.png" /></span></div>
      <div class="weui-media-box__bd">
      <?php if($address): ?><a href="<?php echo leuu('User/Center/addressList',array('good_id'=>$good_id,'pid'=>$pid,'type1'=>$type1,'type2'=>$type2));?>" class="weui-cell_access">
          <h4 class="address-name"><span><?php echo ($address['name']); ?></span><span><?php echo ($address['phone']); ?></span></h4>
          <div class="address-txt"><?php echo ($address['address']); ?>号</div>
        </a><?php endif; ?>
        
      </div>
      <div class="weui-media-box__hd proinfo-txt-l" style="width:16px;"><div class="weui-cell_access"><span class="weui-cell__ft"></span></div></div>
    </div>
  </div>
  <div class="wy-media-box weui-media-box_text">
    <div class="weui-media-box__bd">
     <div class="weui-media-box_appmsg ord-pro-list">
     <?php $pics = json_decode($goods['photos_url'],true); ?>
        <div class="weui-media-box__hd"><a href="pro_info.html">
        <?php if($pics[0]): ?><img class="weui-media-box__thumb" src="<?php echo sp_get_image_preview_url($pics[0]);?>" alt=""><?php endif; ?>
        </a></div>
        <div class="weui-media-box__bd">
          <h1 class="weui-media-box__desc"><a href="pro_info.html" class="ord-pro-link"><?php echo ($goods["name"]); ?></a></h1>
          <p class="weui-media-box__desc">规格：<span><?php echo ($type1); ?></span>，<span><?php echo ($type2); ?></span></p>
          <div class="clear mg-t-10">
            <div class="wy-pro-pri fl">积分<em class="num font-15"><?php echo ($goods['score']); ?></em></div>
            <div class="pro-amount fr"><span class="font-13">数量×<em class="name">1</em></span></div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <div class="weui-panel">
    <div class="weui-panel__bd">
      <div class="weui-media-box weui-media-box_small-appmsg">
        <div class="weui-cells">
          <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd weui-cell_primary">
              <p class="font-14"><span class="mg-r-10">配送方式</span><span class="fr">快递</span></p>
            </div>
          </div>
          <!--<div class="weui-cell weui-cell_access" href="javascript:;">
            <div class="weui-cell__bd weui-cell_primary">
              <p class="font-14"><span class="mg-r-10">运费</span><span class="fr txt-color-red">￥<em class="num">10.00</em></span></p>
            </div>
          </div>-->
          <a class="weui-cell weui-cell_access" href="money.html">
            <div class="weui-cell__bd weui-cell_primary">
              <p class="font-14"><span class="mg-r-10">可用积分</span><span class="sitem-tip"><em class="num"><?php echo ($_SESSION['user']['score']); ?></em>分</span></p>
            </div>
            <span class="weui-cell__ft"></span>
          </a>
          
        </div>
      </div>
    </div>
  </div>
  <div class="wy-media-box weui-media-box_text">
    <div class="mg10-0 t-c">
    <?php if($after_monery): ?><span class="wy-pro-pri mg-tb-5">
    <?php echo ($name); ?> <?php echo ($youhui*100); ?>%
    <em class="num font-20"><?php echo ($after_monery); ?></em>积分</span>
    <?php else: ?>
    <span class="wy-pro-pri mg-tb-5"><em class="num font-20"><?php echo ($goods['score']); ?></em>积分</span><?php endif; ?></div>
    <?php if($error == 1): ?><div class="mg10-0"><a href="<?php echo leuu('User/Center/index');?>" class="weui-btn weui-btn_primary" style="background:#666">积分不够,去充值</a></div>
    <?php else: ?>
    <div class="mg10-0"><a href="javascript:;" class="weui-btn weui-btn_primary" onclick="do_duihuan()">确认兑换</a></div><?php endif; ?>
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
<?php if(!$address): ?><script>
$.toast("请先去填写收货地址", "forbidden",function(){
	window.location.href='/index.php?g=User&m=Center&a=addressList';
});
</script><?php endif; ?>
</body>
</html>