<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ($site_seo_title); ?> <?php echo ($site_name); ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="/themes/simplebootx/Public/lib/weui.min.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/jquery-weui.css">
<link rel="stylesheet" href="/themes/simplebootx/Public/css/style.css">
</head>
<body ontouchstart>
<!--顶部搜索-->
<header class='weui-header'>
  <div class="weui-search-bar" id="searchBar">
    <form class="weui-search-bar__form">
      <div class="weui-search-bar__box">
        <i class="weui-icon-search"></i>
        <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索您想要的商品" required>
        <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
      </div>
      <label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
        <i class="weui-icon-search"></i>
        <span>搜索您想要的商品</span>
      </label>
    </form>
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel" onclick="var name = $('#searchInput').val();
	window.location.href='/index.php?g=Portal&m=Index&a=good_list&name='+name;"style="display:block">搜索</a>
  </div>
</header>
<!--主体-->
<div class='weui-content'>
  <!--顶部轮播-->
  <?php $banner=sp_getslide("banner"); ?>
  <div class="swiper-container swiper-banner">
    <div class="swiper-wrapper">
    <?php if(is_array($banner)): foreach($banner as $key=>$vo): ?><div class="swiper-slide"><a href="<?php echo ($vo["slide_url"]); ?>"><img src="<?php echo sp_get_image_preview_url($vo['slide_pic']);?>" /></a></div><?php endforeach; endif; ?>
    
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <!--图标分类-->
  <div class="weui-grids" style="background:#FFF">
  <?php if(is_array($termInfo)): foreach($termInfo as $key=>$vo): ?><a href="<?php echo leuu('Portal/Index/good_list',array('pid'=>$vo['id']));?>" class="weui-grid js_grid">
        <div class="weui-grid__icon">
            <img src="<?php echo sp_get_image_preview_url($vo['img']);?>" >
        </div>
        <p class="weui-grid__label">
          <?php echo ($vo["name"]); ?>
        </p>
      </a><?php endforeach; endif; ?>
  <a href="<?php echo leuu('User/Center/orderList',array('status'=>'all'));?>" class="weui-grid js_grid">
        
        <div class="weui-grid__icon">
            <img src="/themes/simplebootx/Public/images/icon-link3.png" >
        </div>
        <p class="weui-grid__label">
          我的订单列表
        </p>
      </a>
  </div>
  <!--新闻切换-->
  <div class="wy-ind-news">
    <i class="news-icon-laba"></i>
    <div class="swiper-container swiper-news">
      <div class="swiper-wrapper">
      <?php $newInfo=sp_sql_posts("cid:4;field:post_title,post_excerpt,object_id,term_id,smeta;order:post_hits desc;limit:100;"); ?>
      <?php if(is_array($newInfo)): foreach($newInfo as $key=>$vo): ?><div class="swiper-slide"><a href="<?php echo leuu('Portal/Index/news_page',array('id'=>$vo['object_id'],'cid'=>$vo['term_id']));?>"><?php echo ($vo["post_title"]); ?></a></div><?php endforeach; endif; ?>
        
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <a href="<?php echo leuu('Portal/Index/news_list');?>" class="newsmore"><i class="news-icon-more"></i></a>
  </div>
  <!--精选推荐-->
  <div class="wy-Module">
    <div class="wy-Module-tit"><span>会员推荐</span></div>
    <div class="wy-Module-con">
      <div class="swiper-container swiper-jingxuan" style="padding-top:34px;">
        <div class="swiper-wrapper">
        <?php if(is_array($one)): foreach($one as $key=>$vo): $info = json_decode($vo['photos_url'],true); ?>
                    
        <div class="swiper-slide"><a href="<?php echo leuu('Portal/Index/goodsInfo',array('id'=>$vo['id']));?>">
        <?php if($info[0]): ?><img src="<?php echo sp_get_image_preview_url($info[0]);?>" /><?php endif; ?></a></div><?php endforeach; endif; ?>
        </div>
        <div class="swiper-pagination jingxuan-pagination"></div>
      </div>
    </div>
  </div>
  <!--酒水专场-->
  <div class="wy-Module">
    <div class="wy-Module-tit"><span>商家推荐</span></div>
    <div class="wy-Module-con">
      <div class="swiper-container swiper-jiushui" style="padding-top:34px;">
        <div class="swiper-wrapper">
        <?php if(is_array($two)): foreach($two as $key=>$vo): $info = json_decode($vo['photos_url'],true); ?>
        <div class="swiper-slide"><a href="<?php echo leuu('Portal/Index/goodsInfo',array('id'=>$vo['id']));?>"><?php if($info[0]): ?><img src="<?php echo sp_get_image_preview_url($info[0]);?>" /><?php endif; ?></a></div><?php endforeach; endif; ?>
        
        </div>
        <div class="swiper-pagination jingxuan-pagination"></div>
      </div>
    </div>
  </div>
  <!--猜你喜欢-->
  <div class="wy-Module">
    <div class="wy-Module-tit-line"><span>猜你喜欢</span></div>
    <div class="wy-Module-con">
      <ul class="wy-pro-list clear">
      <?php if(is_array($result)): foreach($result as $key=>$vo): $info = json_decode($vo['photos_url'],true); ?>
        <li>
          <a href="<?php echo leuu('Portal/Index/goodsInfo',array('id'=>$vo['id']));?>">
            <div class="proimg"><?php if($info[0]): ?><img src="<?php echo sp_get_image_preview_url($info[0]);?>" /><?php endif; ?></div>
            <div class="protxt">
              <div class="name"><?php echo ($vo["name"]); ?></div>
              <?php $attribute = json_decode($vo['attribute'],true); ?>
              <div class="wy-pro-pri">0元+<?php echo ($vo["score"]); ?> 积分</div>
            </div>
          </a>
        </li><?php endforeach; endif; ?>
      </ul>
      <div class="morelinks"><a href="<?php echo leuu('Portal/Index/good_list');?>">查看更多 >></a></div>
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
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script> 
<script src="/themes/simplebootx/Public/js/jquery-weui.js"></script>
<script src="/themes/simplebootx/Public/js/swiper.js"></script>

<script>
	$(".swiper-banner").swiper({
        loop: true,
        autoplay: 3000
      });
	$(".swiper-news").swiper({
		loop: true,
		direction: 'vertical',
		paginationHide :true,
        autoplay: 30000
      });
	 $(".swiper-jingxuan").swiper({
		pagination: '.swiper-pagination',
		loop: true,
		paginationType:'fraction',
        slidesPerView:3,
        paginationClickable: true,
        spaceBetween: 2
      });
	 $(".swiper-jiushui").swiper({
		pagination: '.swiper-pagination',
		paginationType:'fraction',
		loop: true,
        slidesPerView:3,
		slidesPerColumn: 2,
        paginationClickable: true,
        spaceBetween:2
      });
</script>
</body>
</html>