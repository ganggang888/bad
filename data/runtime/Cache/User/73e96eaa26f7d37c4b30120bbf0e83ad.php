<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>全部订单</title>
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
  <div class="wy-header-title">订单管理</div>
</header>
<div class='weui-content'>
  <div class="weui-tab">
    <div class="weui-navbar" style="position:fixed; top:44px; left:0; right:0; height:44px; background:#fff;">
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item<?php if($_GET[status] == 'all'): ?>--on<?php endif; ?>" href="<?php echo leuu('User/Center/orderList',array('status'=>'all'));?>">全部</a>
      
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item<?php if($_GET[status] == '0'): ?>--on<?php endif; ?>" href="<?php echo leuu('User/Center/orderList',array('status'=>0));?>">待发货</a>
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item<?php if($_GET[status] == 2): ?>--on<?php endif; ?>" href="<?php echo leuu('User/Center/orderList',array('status'=>2));?>">待收货</a>
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item<?php if($_GET[status] == 3): ?>--on<?php endif; ?>" href="<?php echo leuu('User/Center/orderList',array('status'=>3));?>">已收货</a>
    </div>
    <div class="weui-tab__bd proinfo-tab-con" style="padding-top:87px;">
      <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
      <?php if(is_array($result)): foreach($result as $key=>$vo): ?><div class="weui-panel weui-panel_access">
          <div class="weui-panel__hd"><span>单号：<?php echo ($vo["order_num"]); ?></span><span class="ord-status-txt-ts fr">
          <?php if($vo['status'] == 0): ?>待发货
          <?php elseif($vo['status'] == 2): ?>
          已发货
          <?php elseif($vo['status'] == 3): ?>
          已收货<?php endif; ?>
          </span></div>
          <?php if($vo['status'] == 2): ?><div class="weui-panel__hd"><a href="https://m.kuaidi100.com/result.jsp?nu=<?php echo ($vo["logistics_num"]); ?>" target="_blank"><span>快递单号：<?php echo ($vo["logistics_num"]); ?></span></a><span class="ord-status-txt-ts fr">
          
          </span></div>
          <div class="weui-panel__hd"><span>发货时间：<?php echo ($vo["delivery_time"]); ?></span><span class="ord-status-txt-ts fr">
          
          </span></div><?php endif; ?>
          <div class="weui-media-box__bd  pd-10">
            <div class="weui-media-box_appmsg ord-pro-list">
            <?php $pics = $vo['goods']['photos_url']; $pics = json_decode($pics,true); ?>
              <div class="weui-media-box__hd"><a href="<?php echo leuu('Portal/Index/goodsInfo',array('id'=>$vo['goods']['id']));?>"><img class="weui-media-box__thumb" src="<?php echo sp_get_image_preview_url($pics[0]);?>" alt=""></a></div>
              <div class="weui-media-box__bd">
                <h1 class="weui-media-box__desc"><a href="pro_info.html" class="ord-pro-link"><?php echo ($vo['goods']['name']); ?></a></h1>
                <p class="weui-media-box__desc">规格：<?php echo ($vo["name"]); ?></p>
                <div class="clear mg-t-10">
                <?php $goodsinfo = json_decode($vo['goodsinfo'],true); $goodsinfo = current($goodsinfo); ?>
                  <div class="wy-pro-pri fl">积分<em class="num font-15"><?php echo ($goodsinfo["prices"]); ?></em></div>
                  <div class="pro-amount fr"><span class="font-13">数量×<em class="name">1</em></span></div>
                </div>
              </div>
            </div>
            
          </div>
          <div class="ord-statistics">
            <span>共<em class="num">1</em>件商品，</span>
            <span class="wy-pro-pri">总积分：<em class="num font-15"><?php echo ($goodsinfo["prices"]); ?></em></span>
            <span>(含运费<b>￥0.00</b>)</span>
          </div>
          <div class="weui-panel__ft">
            <div class="weui-cell weui-cell_access weui-cell_link oder-opt-btnbox">
            <?php if($vo['status'] == 2): ?><a href="javascript:;" class="ords-btn-com receipt" onclick="queren(<?php echo ($vo["id"]); ?>)">确认收货</a><!--<a href="comment.html" class="ords-btn-com">评价</a>--><?php endif; ?>
            </div>    
          </div>
        </div><?php endforeach; endif; ?>
      </div>
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