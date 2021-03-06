<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:38:"./themes/default/member/login\reg.html";i:1569657151;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />	
	<link rel="stylesheet" href="/public/static/view_res/common/base.css" />
	<link rel="stylesheet" href="/public/static/view_res/member/css/reg.css" />
</head>
<body>		
	<ul class="form">
		<li><span>用户名：</span><input class="text" name="username" type="text" /></li>
		<li><span>邮箱：</span><input class="text" name="email" type="text" /></li>
		<li><span>密 码：</span><input class="text" name="password" type="password" /></li>
		<li><span>确认密码：</span><input class="text" name="rpassword" type="password" /></li>		
		<li><span>昵称：</span><input class="text" name="nickname" type="text" /></li>	
		<?php if(1 == config('use_captcha')): ?>	
		<li class="clearfix"><span>验证码：</span><input class="text" name="captcha" type="text" /></li>
		<li class="clearfix"><span></span><img class="verifyimg reloadverify" src="<?php echo url('login/verify'); ?>" alt="captcha" /></li>
		<?php endif; ?>	
		<li><span></span><input type="submit" id="send" value="注册" /></li>
	</ul>	
</body>
<script src="/public/static/js/jquery/jquery-2.0.3.min.js"></script>
<script src="/public/static/js/jquery/jquery-migrate-1.2.1.min.js"></script>

<script>
	<?php if(1==config('use_captcha')){ ?>
		//刷新验证码
		var verifyimg = $(".verifyimg").attr("src");
	    $(".reloadverify").click(function(){
	        if( verifyimg.indexOf('?')>0){
	            $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
	        }else{
	            $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
	        }
	    });	
	<?php } ?>	
	$('#send').click(function(){
		
		var username=$("input[name='username']").val();
		var pwd=$("input[name='password']").val();
		var pwd2=$("input[name='rpassword']").val();
		
		var remail=$("input[name='email']").val();
		var rnickname=$("input[name='nickname']").val();
		
		
		if(username==''){
			alert('请输入账号');
			return false;
		}else if(pwd==''){
			alert('请输入密码');
			return false;
		}else if(pwd2==''){
			alert('请输入确认密码');
			return false;
		}else if(pwd2!=pwd){
			alert('两次密码不一致');
			return false;
		}
		
		<?php if(1==config('use_captcha')){ ?>
			var captcha=$("input[name='captcha']").val();		
			if(captcha==''){
				alert('请输入验证码');
				return false;
			}			
		<?php } ?>
		
		$.post(
			"/reg",
			{
				username:username,
				password:pwd,
				pwd2:pwd2,
				email:remail,
				nickname:rnickname,
				<?php if(1==config('use_captcha')){ ?>
				captcha:captcha,	
				<?php } ?>
			},
			function(d){
				if(d.error){
					alert(d.error);
				}else if(d.success){	
					
					if(d.check==1){
						alert(d.success);
					}else if(d.check==0){
						
						var p=$("#top",window.parent.document).find('ul');						
						p.html('');					
						p.append('<li><a href="<?php echo url('member/order_member/index'); ?>">会员中心</a></li><li><a href="<?php echo url('/logout'); ?>">退出</a></li>');								
					}
					parent.window.art.dialog.list['reg'].close();	
					
		
				}
			}	
		);
		
	});

</script>
</html>