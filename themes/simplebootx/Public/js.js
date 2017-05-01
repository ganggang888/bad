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
		alert('请输入正确的用户名');
		return false;
	}
	if (password.length < 5) {
		alert('请输入正确的密码');
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
                alert(data.info);
                window.location.href=data.url;
            } else if (data.status == 1) {
                alert('登录成功');
                window.location.href='/index.php?g=User&m=Center&a=index';
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
	if (weuiAgree == false) {
		alert('请选择同意协议');
		return false;
	}
	if (mobile.length != 11) {
		alert('请输入正确的手机号');
		return false;
	}
	if (province == 0) {
		alert('请选择省份');
		return false;
	}
	if (city == 0) {
		alert('请选择市');
		return false;
	}
	if (area == 0) {
		alert('请选择区');
		return false;
	}
	if (password != repassword) {
		alert('两次密码输入不一致');
		return false;
	}
	if (password == '') {
		alert('请输入密码');
		return false;
	}
	var info = {
		mobile:mobile,
		password:password,
		province:province,
		city:city,
		area:area,
		is_ajax:1
	}
	$.ajax({
        type:"POST",
        url:"/index.php?g=User&m=Register&a=doregister",
        data:info,
        success: function(data){
            if (data.status == 0) {
                alert(data.info);
                window.location.href=data.url;
            } else if (data.status == 1) {
                alert('注册成功');
                window.location.href='/index.php?g=User&m=Center&a=index';
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
		alert('请输入地址');
		return false;
	}
	if (phone.length != 11) {
		alert('请输入正确的手机号');
		return false;
	}
	if (info == '') {
		alert('请输入详细地址');
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
                alert(data.info);
                window.location.href=data.url;
            } else if (data.status == 1) {
                alert('添加成功');
                window.location.href='/index.php?g=User&m=Center&a=addressList';
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
		alert('请输入地址');
		return false;
	}
	if (phone.length != 11) {
		alert('请输入正确的手机号');
		return false;
	}
	if (info == '') {
		alert('请输入详细地址');
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
                alert(data.info);
                window.location.href=data.url;
            } else if (data.status == 1) {
                alert('修改成功');
                window.location.href='/index.php?g=User&m=Center&a=addressList';
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
                alert(data.info);
                window.location.href=data.url;
            } else if (data.status == 1) {
                alert('删除成功');
                window.location.href='/index.php?g=User&m=Center&a=addressList';
            }
        }
    })
}

//省市区联动
$(document).ready(function(){
	$("#province").change(function(){
		
		var provinceid=$(this).val();
		$("#citySpan").load("index.php?g=user&m=register&a=city&provinceid="+provinceid);
		$("#areaSpan").html("<select id=\"area\" name=\"area\"><option value=\"0\">请选则区</option></select>");
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
		alert('请输入持卡人名称');
		return false;
	}
	if (phone.length !== 11) {
		alert('请输入正确的手机号');
		return false;
	}
	if (card.length < 10) {
		alert('请输入正确的卡号');
		return false;
	}
	if (bank_name == '') {
		alert('请输入银行名称');
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
                alert(data.info);
                return false;
				//window.location.href=data.url;
            } else if (data.status == 1) {
                alert('添加成功');
                window.location.href='/index.php?g=User&m=Center&a=bank_list';
            }
        }
    })
}

