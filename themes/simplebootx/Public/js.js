var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return '';
    }
})();


//sleep

//sleep-end
window.alert = function(name){
 var iframe = document.createElement("IFRAME");
iframe.style.display="none";
iframe.setAttribute("src", 'data:text/plain,');
document.documentElement.appendChild(iframe);
window.frames[0].window.alert(name);
iframe.parentNode.removeChild(iframe);
}
var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();


//登录
function login()
{
	var username = $("#username").val();
	var password = $("#password").val();
	if (username.length != 11) {
		$.toast("请输入正确的用户名", "forbidden");
		return false;
	}
	if (password.length < 5) {
		$.toast("请输入正确的密码", "forbidden");
		return false;
	}
	var info = {
        username:username,
        password:password,
        is_ajax:1
    }
	$.ajax({
        type:"POST",
        url:"/index.php?g=User&m=Login&a=dologin",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                return false;
			   // window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast("登录成功",function() {
				  window.location.href='/index.php?g=User&m=Center&a=index';
				});
                
            }
        }
    })
	
}

//注册
function register()
{
	var province = $("#province").val();
	var mobile = $("#mobile").val();
	var city = $("#city").val();
	var area = $("#area").val();
	var password = $("#password").val();
	var repassword = $("#password").val();
	var weuiAgree = $("#weuiAgree").is(':checked');
	var tuijian = $("#tuijian").val();
	if (weuiAgree == false) {
		$.toast("请选择同意协议", "forbidden");
		return false;
	}
	if (mobile.length != 11) {
		$.toast("请输入正确的手机号", "forbidden");
		return false;
	}
	if (province == 0) {
		$.toast("请选择省份", "forbidden");
		return false;
	}
	if (city == 0) {
		$.toast("请选择市", "forbidden");
		return false;
	}
	if (area == 0) {
		$.toast("请选择区", "forbidden");
		return false;
	}
	if (password != repassword) {
		$.toast("两次密码输入不一致", "forbidden");
		return false;
	}
	if (password == '') {
		$.toast("请输入密码", "forbidden");
		return false;
	}
	var pid = $_GET['uuid'];
	var info = {
		mobile:mobile,
		password:password,
		province:province,
		city:city,
		area:area,
		tuijian:tuijian,
		pid:pid,
		is_ajax:1
	}
	$.ajax({
        type:"POST",
        url:"/index.php?g=User&m=Register&a=doregister",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
				return false;
            } else if (data.status == 1) {
				$.toast("注册成功",function() {
				  window.location.href='/index.php?g=User&m=Center&a=index';
				});
            }
        }
    })
}

//添加地址
function addAddress()
{
	var name = $("#name").val();
	var phone = $("#phone").val();
	var address = $("#address").attr("data-codes");
	var info = $("#info").val();
	if (name == '') {
		$.toast("请输入地址", "forbidden");
		return false;
	}
	if (phone.length != 11) {
		$.toast("请输入正确的手机号", "forbidden");
		return false;
	}
	if (info == '') {
		$.toast("请输入详细地址", "forbidden");
		return false;
	}
	var de = $("#default").is(':checked');
	var info = {
		name:name,
		phone:phone,
		address:info,
		codeinfo:address,
		de:de,
		is_ajax:true
	}
	
	$.ajax({
        type:"POST",
        url:"",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast("添加成功",function() {
				  window.location.href='/index.php?g=User&m=Center&a=addressList';
				});
            }
        }
    })
	
	
}


//修改地址
function editAddress()
{
	var name = $("#name").val();
	var phone = $("#phone").val();
	var address = $("#address").attr("data-codes");
	var info = $("#info").val();
	var id = $("#id").val();
	if (name == '') {
		$.toast("请输入地址", "forbidden");
		return false;
	}
	if (phone.length != 11) {
		$.toast("请输入正确的手机号", "forbidden");
		return false;
	}
	if (info == '') {
		$.toast("请输入详细地址", "forbidden");
		return false;
	}
	var de = $("#default").is(':checked');
	var info = {
		name:name,
		phone:phone,
		address:info,
		codeinfo:address,
		de:de,
		id:id,
		is_ajax:true
	}
	
	$.ajax({
        type:"POST",
        url:"",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast("修改成功",function() {
				  window.location.href='/index.php?g=User&m=Center&a=addressList';
				});
            }
        }
    })
	
	
}

//删除地址
function deleteAddress()
{
	var id = $("#id").val();
	$.ajax({
        type:"GET",
        url:"/index.php?g=User&m=Center&a=deleteAddress&id="+id,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast("删除成功",function() {
				  window.location.href='/index.php?g=User&m=Center&a=addressList';
				});
            }
        }
    })
}
//省市区联动
$(document).ready(function(){
	$.toast.prototype.defaults.duration = 1000;
	$("#province").change(function(){
		
		var provinceid=$(this).val();
		$("#citySpan").load("index.php?g=user&m=register&a=city&provinceid="+provinceid);
		$("#areaSpan").html("<select id=\"area\" name=\"area\"><option value=\"0\">请选则区</option></select>");
	});
	$("#user_gold").on('input',function(e){  
	   var values = $(this).val();
	   $("#user_score").val(values*2); 
	});
	$("#score").on('input',function(e){ 
	   var values = $(this).val();
	   var b = values % 2;
	   if (b != 0) {
			$.toast("请输入偶数", "forbidden");
			return false;  
	   }
	   $("#rmb").val(values/2); 
	});  
})
function selectArea(){
	var cityid=$("#city").val();
	$("#areaSpan").load("index.php?g=user&m=register&a=Area&cityid="+cityid);
}


//点击发送后状态改变
var wait=60;  
function time(o) {  
        if (wait == 0) {  
            o.removeAttribute("disabled");            
            o.value="免费获取!";  
            wait = 60;  
        } else {  
            o.setAttribute("disabled", true);  
            o.value="重新发送(" + wait + ")";  
            wait--;  
            setTimeout(function() {  
                time(o)  
            },  
            1000)  
        }  
}
$(function(){
$("#btn").click(function(){
	time(this);
});
$(".wy-header-icon-back").click(function(){
	history.go(-1);
});

$(".oneClick").click(function(){
	var name = $(this).text();
	var id = $_GET['id'];
	$("#two").load("/index.php?g=Portal&m=Index&a=goodClick&id="+id+"&name="+name);
	
})

$(".inserClick").click(function(){
	var name = $(this).text();
	var id = $_GET['id'];
	$("#next_two").load("/index.php?g=Portal&m=Index&a=goodClick&id="+id+"&name="+name);
	
})
});


//点击发送后状态改变 end



//银行卡添加
function bank_add()
{
	var name = $("#name").val();
	var phone = $("#phone").val();
	var card = $("#card").val();
	var bank_name = $("#bank_name").val();
	if (name == '') {
		$.toast("请输入持卡人名称", "forbidden");
		return false;
	}
	if (phone.length !== 11) {
		$.toast("请输入正确的手机号", "forbidden");
		return false;
	}
	if (card.length < 10) {
		$.toast("请输入正确的卡号", "forbidden");
		return false;
	}
	if (bank_name == '') {
		$.toast("请输入银行名称", "forbidden");
		return false;
	}
	var info = {
		name:name,
		phone:phone,
		card:card,
		bank_name:bank_name,
		is_ajax:1
	}
	
	$.ajax({
        type:"POST",
        url:"",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast("添加成功",function() {
				  window.location.href='/index.php?g=User&m=Center&a=bank_list';
				});
            }
        }
    })
}

function toLogin()
{
	$.toast("您尚未登录", "forbidden", function() {
	  window.location.href='/index.php?g=User&m=Login&a=index';
	});
	
}

//删除收藏
function deleteShoucang(id)
{
	$.ajax({
        type:"GET",
        url:"/index.php?g=User&m=Center&a=delete_shoucang&id="+id,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast(data.info,function() {
				  window.location.href='/index.php?g=User&m=Center&a=my_save';
				});
            }
        }
    })
}

//兑换页面
function duihuan()
{
	var type1 = $("#one .oneClick.active a").text();
	var type2 = $("#two .active a").text();
	var address_id = $("#address_id").val();
	if (type1 == '' || type2 == '') {
		$.toast("请选择商品属性", "forbidden");
		return false;
	}
	if ($_GET['pid']) {
		window.location.href='/index.php?g=User&m=Center&a=duihuan&type1='+type1+'&type2='+type2+'&pid='+$_GET['pid']+'&good_id='+$_GET['id']+'&address_id='+address_id;
	} else {
		window.location.href='/index.php?g=User&m=Center&a=duihuan&type1='+type1+'&type2='+type2+'&good_id='+$_GET['id']+'&address_id='+address_id;
	}
}

//开始兑换
function do_duihuan()
{
	var goods_id = $_GET['good_id'];
	var parentid = $_GET['pid'];
	var address_id = $_GET['address_id'];
	var type1 = $_GET['type1'];
	var type2 = $_GET['type2'];
	var jf = $(".num.font-20").text();
	var info = {
		goods_id:goods_id,
		parentid:parentid,
		address_id:address_id,
		type1:type1,
		type2:type2,
		jf:jf,
		is_ajax:1
	}
	
	$.ajax({
        type:"POST",
        url:"/index.php?g=User&m=Center&a=do_duihuan",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast("兑换成功",function() {
				  window.location.href='/index.php?g=User&m=Center&a=orderList&status=all';
				});
            }
        }
    })
}

//确认收货
function queren(id)
{
	$.ajax({
		type:"GET",
		url:"/index.php?g=User&m=Center&a=queren&id="+id,
		success: function(data){
			if (data.status == 0) {
				$.toast(data.info, "forbidden");
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast("确认收货成功",function() {
				  window.location.href='/index.php?g=User&m=Center&a=orderList&status=3';
				});
            }
		}
	})
}

//修改密码
function changePassword()
{
	var old = $("#old").val();
	if (old == '') {
		$.toast("请输入旧密码", "forbidden");
		return false;
	}
	var password = $("#password").val();
	if (password.length < 5) {
		$.toast("密码必须大于等于6位！", "forbidden");
		return false;
	}
	var repassword = $("#repassword").val();
	if (password != repassword) {
		$.toast("两次密码输入不一致！", "forbidden");
		return false;
	}
	var info = {
		old_password:old,
		password:password,
		repassword:repassword,
		is_ajax:1
	}
	$.ajax({
        type:"POST",
        url:"/index.php?g=User&m=Center&a=changePassword",
        data:info,
        success: function(data){
            if (data.status == 0) {
                $.toast(data.info, "forbidden");
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast("密码修改成功",function() {
				  window.location.href='/index.php?g=User&m=Login&a=index';
				});
            }
        }
    })
	
}

//充值码兑换积分
function chongzhima()
{
	var code = $("#code").val();
	var mi = $("#mi").val();
	if (code == '') {
		$.toast("请输入充值码", "forbidden");
		return false;
	}
	if (mi == '') {
		$.toast("请输入卡密", "forbidden");
		return false;
	}
	var info = {
		code:code,
		mi:mi,
		is_ajax:1
	}
	$.ajax({
        type:"POST",
        url:"/index.php?g=User&m=Center&a=chongzhima",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast(data.info,function() {
				  window.location.href='/index.php?g=User&m=Center&a=index';
				});
            }
        }
    })
}


//gold兑换积分
function gold_get_jf()
{
	var gold = $("#user_gold").val();
	var jf = $("#user_score").val();
	if (jf == '') {
		$.toast("请输入需要兑换的积分", "forbidden");
		return false;
	}
	var info = {
		gold:gold,
		jf:jf,
		is_ajax:1
	}
	$.ajax({
        type:"POST",
        url:"/index.php?g=User&m=Other&a=gold_get_jf",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast(data.info,function() {
				  window.location.href='/index.php?g=User&m=Center&a=index';
				});
            }
        }
    })
}


//首页商品搜索
function sousuo()
{
	var name = $("#searchInput").val();
	window.location.href='/index.php?g=Portal&m=Index&a=good_list&name='+name;
}

//积分提现申请
function jf_tixian()
{
	var score = $("#score").val();
	var rmb = $("#rmb").val();
	var bank = $("#bank").attr("data-values");
	if (score == '') {
		$.toast("请输入积分", "forbidden");
		return false;
	}
	if (bank == '') {
		$.toast("请选择银行卡", "forbidden");
		return false;
	}
	var info = {
		jf:score,
		bank:bank,
		is_ajax:1
	}
	$.ajax({
        type:"POST",
        url:"",
        data:info,
        success: function(data){
            if (data.status == 0) {
				$.toast(data.info, "forbidden");
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
				$.toast(data.info,function() {
				  window.location.href='/index.php?g=User&m=Center&a=tixian_history';
				});
            }
        }
    })
}