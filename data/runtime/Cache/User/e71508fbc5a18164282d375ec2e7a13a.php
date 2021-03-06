<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>添加地址</title>
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
  <div class="wy-header-title">编辑地址</div>
</header>
<div class="weui-content">
  <div class="weui-cells weui-cells_form wy-address-edit">
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">收货人</label></div>
      <div class="weui-cell__bd"><input class="weui-input" id="name"  placeholder="请输入收货人" value="<?php echo ($info["name"]); ?>"></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
      <div class="weui-cell__bd"><input class="weui-input" type="number" pattern="[0-9]*" id="phone" value="<?php echo ($info["phone"]); ?>" placeholder="请填写手机号"></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label for="name" class="weui-label wy-lab">所在地区</label></div>
      <div class="weui-cell__bd"><input class="weui-input" id="address" type="text" value="<?php echo provinceName($info['province']);?> <?php echo cityName($info['city']);?> <?php echo areaName($info['area']);?>" readonly="" data-code="420106" data-codes="<?php echo ($info["province"]); ?>,<?php echo ($info["city"]); ?>,<?php echo ($info["area"]); ?>"></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">详细地址</label></div>
      <div class="weui-cell__bd">
        <textarea class="weui-textarea" placeholder="洋河新区电商产业园2楼东侧最里面第二间办公室" id="info"><?php echo ($info["address"]); ?></textarea>
        <input type="hidden" name="id" id="id" value="<?php echo ($info["id"]); ?>">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">设为默认地址</div>
      <div class="weui-cell__ft"><input class="weui-switch" type="checkbox" id="default"<?php if($info['listorder'] == 1): ?>checked="checked"<?php endif; ?>></div>
    </div>
  </div> 
  <div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips" onclick="editAddress()">保存此地址</a>
    <a href="javascript:;" class="weui-btn weui-btn_warn" onclick="deleteAddress()">删除此地址</a>
  </div>

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

<script src="/themes/simplebootx/Public/js/jquery-weui.js"></script>
<script src="/themes/simplebootx/Public/js/city-picker.js"></script>
<script>
      $("#address").cityPicker({
        title: "选择出发地",
        onChange: function (picker, values, displayValues) {
          console.log(values, displayValues);
        }
      });
    </script>
</body>
</html>