<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>手机注册</title>
<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
<meta name="description" content="<?php echo ($site_seo_description); ?>">
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
  <div class="wy-header-title">手机注册</div>
</header>
<div class="weui-content">
  <div class="weui-cells weui-cells_form wy-address-edit">
    <div class="weui-cell weui-cell_vcode">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
      <div class="weui-cell__bd"><input class="weui-input" id="mobile" type="tel" placeholder="请输入手机号"></div>
      <div class="weui-cell__ft"><input type="button" value="获取验证码" id="btn" class="weui-vcode-btn"></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">选择省</label></div>
      <div class="weui-cell__bd">
      <select name="province" id="province" class="weui-input">
                                <option value="0">请选择省</option>
                                <?php if(is_array($province)): foreach($province as $key=>$vo): ?><option value="<?php echo ($vo["provinceid"]); ?>"><?php echo ($vo["province"]); ?></option><?php endforeach; endif; ?>
                                </select>
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">选择市</label></div>
      <div class="weui-cell__bd"><div class="control-group" id="citySpan">
								<select name="city" id="city" class="weui-input">
                                <option value="0">请选择市</option>
                                </select>
							</div></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">选择区</label></div>
      <div class="weui-cell__bd"><div class="control-group" id="areaSpan">
								<select name="area" id="area" class="weui-input">
                                <option value="0">请选择区</option>
                                </select>
							</div></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">推荐人</label></div>
      <div class="weui-cell__bd"><div class="control-group" id="areaSpan">
								<input class="weui-input" id="tuijian" type="tel"  placeholder="请输入推荐人手机号">
							</div></div>
    </div>
    <div class="weui-cell weui-cell_vcode">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">验证码</label></div>
      <div class="weui-cell__bd"><input class="weui-input" type="number" placeholder="请输入验证码"></div>
      <div class="weui-cell__ft"><img class="weui-vcode-img" src="/themes/simplebootx/Public/images/vcode.jpg"></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">设置密码</label></div>
      <div class="weui-cell__bd"><input class="weui-input" id="password" type="password" pattern="[0-9]*" placeholder="请输入新密码"></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">确认密码</label></div>
      <div class="weui-cell__bd"><input class="weui-input" type="password" pattern="[0-9]*" id="repassword" placeholder="请再次输入新密码"></div>
    </div>
  </div>
  <label for="weuiAgree" class="weui-agree">
    <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox" checked="checked" value="1">
    <span class="weui-agree__text">阅读并同意<a href="javascript:void(0);">《注册协议》</a></span>
  </label>
  <div class="weui-btn-area"><a href="javascript:;" class="weui-btn weui-btn_warn" onclick="register()">注册并登陆</a></div>
  <div class="weui-cells__tips t-c font-12">登陆账号为您输入的手机号码</div>
  <div class="weui-cells__tips t-c pd-10"><a href="xieyi.html" class="weui-cell_link font-12">查看注册协议</a></div>
  
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