<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>会员中心</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="/themes/simplebootx/Public/lib/weui.min.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/jquery-weui.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/style.css">
</head>
<body ontouchstart>
<!--主体-->
<div class='weui-content'>
  <div class="wy-center-top">
    <div class="weui-media-box weui-media-box_appmsg">
      <div class="weui-media-box__hd"><img class="weui-media-box__thumb radius" src="/themes/simplebootx/Public/upload/headimg.jpg" alt=""></div>
      <div class="weui-media-box__bd">
        <h4 class="weui-media-box__title user-name"><?php echo ($_SESSION['user']['mobile']); ?></h4>
        <p class="user-grade">等级：
        <?php if($_SESSION['user']['level'] == 1): ?>普通会员
        <?php elseif($_SESSION['user']['level'] == 2): ?>
        黄金会员
        <?php elseif($_SESSION['user']['level'] == 3): ?>
        钻石会员
        <?php elseif($_SESSION['user']['level'] == 4): ?>
        代理商
        <?php elseif($_SESSION['user']['level'] == 5): ?>
        股东商<?php endif; ?>
        </p>
        <p class="user-integral">可用金币：<em class="num"><?php echo ($_SESSION['user']['gold']); ?></em></p> 
      </div>
    </div>
<!--    <div class="xx-menu weui-flex">
      <div class="weui-flex__item"><div class="xx-menu-list"><em>987</em><p>账户余额</p></div></div>
      <div class="weui-flex__item"><div class="xx-menu-list"><em>459</em><p>我的蓝豆</p></div></div>
      <div class="weui-flex__item"><div class="xx-menu-list"><em>4</em><p>收藏商品</p></div></div>
    </div>-->
  </div>
  <div class="weui-panel weui-panel_access">
    <div class="weui-panel__hd">
      <a href="<?php echo leuu('User/Center/orderList',array('status'=>'all'));?>" class="weui-cell weui-cell_access center-alloder">
        <div class="weui-cell__bd wy-cell">
          <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-order-all.png" alt="" class="center-list-icon"></div>
          <div class="weui-cell__bd weui-cell_primary"><p class="center-list-txt">全部订单</p></div>
        </div>
        <span class="weui-cell__ft"></span>
      </a>   
    </div>
    <div class="weui-panel__bd">
      <div class="weui-flex">
        
        <div class="weui-flex__item">
          <a href="<?php echo leuu('User/Center/orderList',array('status'=>0));?>" class="center-ordersModule">
          <?php if($daifa): ?><span class="weui-badge" style="position: absolute;top:5px;right:10px; font-size:10px;"><?php echo ($daifa); ?></span><?php endif; ?>
            <div class="imgicon"><img src="/themes/simplebootx/Public/images/center-icon-order-dfh.png" /></div>
            <div class="name">待发货</div>
          </a>
        </div>
        <div class="weui-flex__item">
          <a href="<?php echo leuu('User/Center/orderList',array('status'=>2));?>" class="center-ordersModule">
          <?php if($daifa): ?><span class="weui-badge" style="position: absolute;top:5px;right:10px; font-size:10px;"><?php echo ($daishou); ?></span><?php endif; ?>
            <div class="imgicon"><img src="/themes/simplebootx/Public/images/center-icon-order-dsh.png" /></div>
            <div class="name">待收货</div>
          </a>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="weui-panel weui-panel_access">
    <div class="weui-panel__hd">
      <a href="<?php echo leuu('User/Center/fx_log');?>" class="weui-cell weui-cell_access center-alloder">
        <div class="weui-cell__bd wy-cell">
          <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-jk.png" alt="" class="center-list-icon"></div>
          <div class="weui-cell__bd weui-cell_primary"><p class="center-list-txt">我的小金库</p></div>
        </div>
        <span class="weui-cell__ft"></span>
      </a>   
    </div>
    <div class="weui-panel__bd">
      <div class="weui-flex">
        <div class="weui-flex__item">
          <a href="<?php echo leuu('User/Center/jf_change_status');?>" class="center-ordersModule">
            <div class="center-money"><em><?php echo ($_SESSION['user']['score']); ?></em></div>
            <div class="name">账户积分</div>
          </a>
        </div>
        <div class="weui-flex__item">
          <a href="<?php echo leuu('User/Center/fx_log');?>" class="center-ordersModule">
            <div class="center-money"><em><?php if($_SESSION['user']['can_monery']): echo ($_SESSION['user']['can_monery']); ?> <?php else: ?>0<?php endif; ?></em></div>
            <div class="name">返现积分</div>
          </a>
        </div>
        <!--<div class="weui-flex__item">
          <a href="myburse.html" class="center-ordersModule">
            <div class="center-money"><em>550.0</em></div>
            <div class="name">待返还</div>
          </a>
        </div>-->
        <!--<div class="weui-flex__item">
          <a href="myburse.html" class="center-ordersModule">
            <div class="center-money"><em>165</em></div>
            <div class="name">冻结金额</div>
          </a>
        </div>-->
      </div>
    </div>
  </div>
  
  <!--图标-->
  <div class="weui-panel">
  <div class="weui-flex wy-iconlist-box">
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Center/bank_list');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-5.png"></div><p>我的银行卡</p></a></div>
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Center/log_index');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-1.png"></div><p>交易记录</p></a></div>
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Other/tixian_history');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-7.png"></div><p>提现记录</p></a></div>
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Center/chongzhi');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-4.png"></div><p>去充值</p></a></div>
  </div>
  <div class="weui-flex wy-iconlist-box">
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Other/getLevelPeople');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-14.png"></div><p>我的团队</p></a></div>
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Center/my_save');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-1.png"></div><p>我的收藏</p></a></div>
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Other/index');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-7.png"></div><p>兑换积分</p></a></div>
    <div class="weui-flex__item" ><a href="javascript:;" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-4.png"></div><p></p></a></div>
  </div>
  <div class="weui-flex wy-iconlist-box">
    <div class="weui-flex__item"><a href="<?php echo leuu('Portal/Index/news_list');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-3.png"></div><p>新闻中心</p></a></div>
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Center/addressList');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-10.png"></div><p>地址管理</p></a></div>
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Center/changePassword');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-12.png"></div><p>密码修改</p></a></div>
    <div class="weui-flex__item"><a href="<?php echo leuu('User/Index/logout');?>" class="wy-links-iconlist"><div class="img"><img src="/themes/simplebootx/Public/images/me-11.png"></div><p>退出账号</p></a></div>
  </div>
</div>
<!--<div class="bdsharebuttonbox" data-tag="share_1">
	<a class="bds_mshare" data-cmd="mshare"></a>
	<a class="bds_qzone" data-cmd="qzone" href="#"></a>
	<a class="bds_tsina" data-cmd="tsina"></a>
	<a class="bds_baidu" data-cmd="baidu"></a>
	<a class="bds_renren" data-cmd="renren"></a>
	<a class="bds_tqq" data-cmd="tqq"></a>
	<a class="bds_more" data-cmd="more">更多</a>
	<a class="bds_count" data-cmd="count"></a>
</div>-->


  <!--图标end-->
  
  <!--<div class="weui-panel">
        <div class="weui-panel__bd">
          <div class="weui-media-box weui-media-box_small-appmsg">
            <div class="weui-cells">
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Center/log_index');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-jyjl.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">交易记录</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Center/my_save');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-sc.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">我的收藏</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('Portal/Index/news_list');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/icon_nav_article.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">新闻列表</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Other/tixian_history');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-sc.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">提现记录</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Center/addressList');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-dz.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">地址管理</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Center/chongzhi');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-dz.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">去充值</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Center/bank_list');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-yhk.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">我的银行卡</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Other/index');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-yhk.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">兑换积分</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Center/changePassword');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-dlmm.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">密码修改</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo leuu('User/Index/logout');?>">
                <div class="weui-cell__hd"><img src="/themes/simplebootx/Public/images/center-icon-out.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">退出账号</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
            </div>
          </div>
        </div>
      </div>-->
  
  
  
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