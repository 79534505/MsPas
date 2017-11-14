<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>数独游戏登录</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="/Public/static/css/style.css" tppabs="css/style.css" />
<style>
body{height:100%;background:#16a085;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<script src="/Public/static/js/jquery.js"></script>
<script src="/Public/static/js/verificationNumbers.js" tppabs="/Public/static/js/verificationNumbers.js"></script>
<script src="/Public/static/js/Particleground.js" tppabs="/Public/static/js/Particleground.js"></script>
	<script type="text/javascript">
		var SITE_URL  = '';
		//载入函数
		var U = function(url, params) {
			var website = SITE_URL+'/index.php';
			url = url.split('/');
			if(url[0] == '' || url[0] == '@')
				url[0] = '';
			if (!url[1])
				url[1] = 'Index';
			if (!url[2])
				url[2] = 'index';
			website = website+'/'+url[0]+'/'+url[1];
			if(params) {
				params = params.join('&');
				website = website + '&' + params;
			}
			return website;
		};
	</script>
<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
  //登录
  $(".submit_btn").click(function(){
	  var username = $('#username').val();
	  var password = $('#password').val();
	  if(username == ''){
		  alert('请填写用户名!');
		  return;
	  }
	  if(password == ''){
		  alert('请填写密码!');
		  return;
	  }
	  if(username.length > 16 || password.length > 16){
		  alert('用户名和密码过长!');
	  }
	  $.ajax({
		  url:U('Login/do_login'),
		  data:{'username':username,'password':password},
		  type:'post',
		  dataType:'json',
		  success:function(data){
			  if(data.status){
				  window.location.href= U('Index/index');
			  }else{
				  alert(data.msg);
			  }
		  }
	  });
	 });

	//注册
	$(".reg_btn").click(function(){
		var username = $('#username').val();
		var password = $('#password').val();
		var client_ip = '<?php echo ($client_ip); ?>';
		if(username == ''){
			alert('请输入用户名!');
			return;
		}
		if(password == ''){
			alert('请输入密码!');
			return;
		}
		if(username.length > 16 || username.length < 3 || password.length > 16 || password.length < 6){
			alert('用户名和密码长度有误!');
			return;
		}
		$.ajax({
			url:U('Login/do_register'),
			data:{'username':username,'password':password,'client_ip':client_ip},
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status){
					window.location.href= U('Index/index');
				}else{
					alert(data.msg);
				}
			}
		});
	});
});
</script>
</head>
<body>
<dl class="admin_login">
 <dt>
  <strong>数独游戏登录</strong>
 </dt>
 <dd class="user_icon">
  <input type="text" placeholder="账号" class="login_txtbx" id="username"/>
 </dd>
 <dd class="pwd_icon">
  <input type="password" placeholder="密码" class="login_txtbx" id="password"/>
 </dd>
 <dd>
  <input type="button" value="立即登陆" class="submit_btn"/>
 </dd>
<dd>
	<input type="button" value="立即注册" class="reg_btn"/>
</dd>
 <dd>
 </dd>
</dl>
</body>
</html>