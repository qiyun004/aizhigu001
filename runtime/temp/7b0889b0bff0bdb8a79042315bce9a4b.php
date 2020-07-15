<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./themes/default/payment/payment\payment_list.html";i:1569657151;}*/ ?>
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
	<h2>选择支付方式</h2>
	<p>
		<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pay): $mod = ($i % 2 );++$i;?>
		<label>
			<input name="code" <?php if($pay['code'] == 'alipay'): ?> checked="checked" <?php endif; ?>  value="<?php echo $pay['code']; ?>" type="radio" /> <?php echo $pay['name']; ?>
		</label>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	</p>
	<button id="pay">支付</button>
</body>
<script src="/public/static/js/jquery/jquery-2.0.3.min.js"></script>
<script src="/public/static/js/jquery/jquery-migrate-1.2.1.min.js"></script>

<script>
$('#pay').click(function(){
		
var type=$("input[name='code']:checked").val();		

$.post(
	"<?php echo url('payment/Payment/re_pay'); ?>",
	{
		type:type				
	},
	function(d){
		if(d.error){
			alert(d.error);
		}else if(d.pay_url){
			
			if(d.type=='wx_pay'){
					window.location.href=d.pay_url;
				}else{
					parent.window.location.href=d.pay_url;
				}
			}
		}	
	);
	
});

</script>

</script>
</html>