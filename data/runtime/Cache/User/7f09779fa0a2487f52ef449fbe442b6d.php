<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>我的团队</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="/themes/simplebootx/Public/lib/weui.min.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/jquery-weui.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/style.css">
</head>
<body ontouchstart>
<!--主体-->
<header class="wy-header" style="position:fixed; top:0; left:0; right:0; z-index:200;">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title">我的团队</div>
</header>
<div class='weui-content'>
  <div class="weui-tab">
    <div class="weui-navbar" style="position:fixed; top:44px; left:0; right:0; height:44px; background:#fff;">
      <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item--on" href="#tab1">全部</a>
      <a class="weui-navbar__item proinfo-tab-tit font-14" href="#tab2">一团</a>
      <a class="weui-navbar__item proinfo-tab-tit font-14" href="#tab3">二团</a>
    </div>
    <div class="weui-tab__bd proinfo-tab-con" style="padding-top:87px;">
    
      <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
        <div class="weui-panel jyjl">
          <div class="weui-panel__hd">全部团员：<em class="num"><?php echo ($allCount); ?>人</em>，累计收益：<em class="num"><?php echo ($allMoney); ?>积分</em></div>
          
            
            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><div class="weui-panel__bd">
              <div class="weui-media-box weui-media-box_appmsg" style="padding:5px 10px 5px 5px">
                <div class="weui-media-box__hd"><img class="weui-media-box__thumb" src="/themes/simplebootx/Public/upload/headimg.jpg" style="width:80%; height:80%; padding-top:10px;"></div>
                <div class="weui-media-box__bd">
                  <div class="wy-pro-pri" style="margin-bottom:3px;"><em class="num font-15" style="margin-left:0"><?php echo ($vo["mobile"]); ?></em></div>
                  <h1 class="weui-media-box__desc" style="display:block"><span style="float:right">贡献收益：<?php echo ($vo["for_you"]); ?>积分</span>推荐人：<?php echo tuijianName($vo['pid']);?></h1>
                  <h1 class="weui-media-box__info" style="margin-top:5px;">加入时间：<?php echo date("Y-m-d H",strtotime($vo['create_time']));?></h1>
                </div>
              </div>
            </div><?php endforeach; endif; ?>
            
            
            
            
            
            
        </div>        
      </div>
      
      <div id="tab2" class="weui-tab__bd-item">
        <div class="weui-panel jyjl">
          <div class="weui-panel__hd">一团团员：<em class="num"><?php echo ($oneCount); ?>人</em>，累计收益：<em class="num"><?php echo ($oneMoney); ?>积分</em></div>
          
          
          <?php if(is_array($one)): foreach($one as $key=>$value): ?><div class="weui-panel__bd">
              <div class="weui-media-box weui-media-box_appmsg" style="padding:5px 10px 5px 5px">
                <div class="weui-media-box__hd"><img class="weui-media-box__thumb" src="/themes/simplebootx/Public/upload/headimg.jpg" style="width:80%; height:80%; padding-top:10px;"></div>
                <div class="weui-media-box__bd">
                  <div class="wy-pro-pri" style="margin-bottom:3px;"><em class="num font-15" style="margin-left:0"><?php echo ($value["mobile"]); ?></em></div>
                  <h1 class="weui-media-box__desc" style="display:block"><span style="float:right">贡献收益：<?php echo ($value["for_you"]); ?>积分</span>推荐人：<?php echo tuijianName($value['pid']);?></h1>
                  <h1 class="weui-media-box__info" style="margin-top:5px;">加入时间：<?php echo date("Y-m-d H",strtotime($value['create_time']));?></h1>
                </div>
              </div>
            </div><?php endforeach; endif; ?>
            
            
            
            
            
            
        </div>        
      </div>
      
      <div id="tab3" class="weui-tab__bd-item">
        <div class="weui-panel jyjl">
          <div class="weui-panel__hd">二团团员：<em class="num"><?php echo ($twoCount); ?>人</em>，累计收益：<em class="num"><?php echo ($twoMoney); ?>积分</em></div>
          
          <?php if(is_array($two)): foreach($two as $key=>$val): ?><div class="weui-panel__bd">
              <div class="weui-media-box weui-media-box_appmsg" style="padding:5px 10px 5px 5px">
                <div class="weui-media-box__hd"><img class="weui-media-box__thumb" src="/themes/simplebootx/Public/upload/headimg.jpg" style="width:80%; height:80%; padding-top:10px;"></div>
                <div class="weui-media-box__bd">
                  <div class="wy-pro-pri" style="margin-bottom:3px;"><em class="num font-15" style="margin-left:0"><?php echo ($val["mobile"]); ?></em></div>
                  <h1 class="weui-media-box__desc" style="display:block"><span style="float:right">贡献收益：<?php echo ($val["for_you"]); ?>积分</span>推荐人：<?php echo tuijianName($val['pid']);?></h1>
                  <h1 class="weui-media-box__info" style="margin-top:5px;">加入时间：<?php echo date("Y-m-d H",strtotime($val['create_time']));?></h1>
                </div>
              </div>
            </div><?php endforeach; endif; ?>
            
            
            
            
            
        </div>        
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