<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:42:"./themes/default/index/category\index.html";i:1569657151;s:78:"D:\phpstudy2018\PHPTutorial\WWW\oscshop2\themes\default\index\public\base.html";i:1569657151;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo (isset($SEO['title']) && ($SEO['title'] !== '')?$SEO['title']:''); ?></title>
	<meta name="keywords" content="<?php echo (isset($SEO['keywords']) && ($SEO['keywords'] !== '')?$SEO['keywords']:''); ?>"/>
	<meta name="description" content="<?php echo (isset($SEO['description']) && ($SEO['description'] !== '')?$SEO['description']:''); ?>"/>
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />	
	<link rel="stylesheet" href="/public/static/view_res/common/base.css" />
	<link rel="stylesheet" href="/public/static/view_res/home/css/common.css" />	
	
</head>
<body>	
	
	<?php if(is_module_install('member')): ?>	
		<div id="top">		
			<div class="allWrap">
				<ul class="left">
					<?php if(member('uid')): ?>
						<li><a href="<?php echo url('member/order_member/index'); ?>">会员中心</a></li>
						<li><a href="<?php echo url('/logout'); ?>">退出</a></li>
					<?php else: ?>
						<li><a class="pointer" id="reg">注册</a></li>
						<li><a class="pointer" id="login">登录</a></li>
					<?php endif; ?>
				</ul>
				<ul class="right">
					<li id="cart">
						 购物车(<a href="<?php echo url('/cart'); ?>"> <?php if(session('total')): ?><?php echo \think\Session::get('total'); else: ?>0<?php endif; ?> </a>)
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php endif; ?>
	
	<div id="header" class="allWrap">
		<ul id="home">
			<li><a href="<?php echo \think\Request::instance()->root(true); ?>">首页</a></li>
		</ul>  
		<ul class="nav">
		<?php if(is_array($top_nav) || $top_nav instanceof \think\Collection || $top_nav instanceof \think\Paginator): $i = 0; $__LIST__ = $top_nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?>
			<li><a href="<?php echo url('/category/'.$category['id']); ?>"><?php echo $category['name']; ?></a>
				<?php if(isset($category['children'])): ?>
					<ul>
					<?php if(is_array($category['children']) || $category['children'] instanceof \think\Collection || $category['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $category['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$children): $mod = ($i % 2 );++$i;?>
						<li><h3><a href="<?php echo url('/category/'.$children['id']); ?>"><?php echo $children['name']; ?></a></h3></li>				
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				<?php endif; ?>
			</li>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>	
	
	

<?php if(!empty($attribute)): ?>
	<div id="attribute" class="allWrap">
		<p>属性</p>
		<?php if(is_array($attribute) || $attribute instanceof \think\Collection || $attribute instanceof \think\Paginator): $i = 0; $__LIST__ = $attribute;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
			<div class="clearfix attribute-value">
				<span style="float:left;"><?php echo $key; ?>:</span>
				<?php if(isset($value)): ?>
				<ul>					
					<?php if(is_array($value) || $value instanceof \think\Collection || $value instanceof \think\Paginator): $k = 0; $__LIST__ = $value;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
						<li class="attribute" id="a<?php echo $v['attribute_value_id']; ?>" aid="<?php echo $v['attribute_value_id']; ?>"><?php echo $v['value_name']; ?></li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<?php endif; ?>
			</div>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	</div>		
<?php endif; ?>



<div id="goods" class="allWrap">
		<div class="clearfix">
			<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?>
			 <dl>
			 	<?php if(isset($goods['shipping']) and ($goods['shipping'] == 0)): ?>
			 	<span class="no_shipping">免配送商品</span>
			 	<?php endif; ?>
			 	<dt><a href="<?php echo url('/goods/'.$goods['goods_id']); ?>">
			 		<?php if(!empty($goods['image'])): ?>
				 		<img src="/<?php echo resize($goods['image'],230,230); ?>">
				 		<?php else: ?>
				 		<img src="/public/static/image/no_image_230x230.jpg">
			 		<?php endif; ?>
			 		</a>
			 		</dt>
			 	<dd><a href="<?php echo url('/goods/'.$goods['goods_id']); ?>"><?php echo $goods['name']; ?></a></dd>
			 	<dd><a class="red" href="<?php echo url('/goods/'.$goods['goods_id']); ?>"> &yen; <?php echo $goods['price']; ?></a></dd>
			 </dl>
			<?php endforeach; endif; else: echo "$empty" ;endif; ?>			
		</div>
		<div id="page" class="clearfix"><?php echo $list->render(); ?></div>
		<div id="total" class="clearfix">总计 <?php echo ($list->total() ?: "0"); ?> </div>	
		
</div>			

		
	<div id="footer">
		<div class="allWrap">
		<p>Copyright © 2015-<?php echo date('Y',time()); ?> <?php echo \think\Config::get('SITE_TITLE'); ?>  <?php echo \think\Config::get('SITE_URL'); ?> All Rights Reserved. 备案号：<?php echo \think\Config::get('SITE_ICP'); ?> </p>
		</div>
	</div>	
</body>


<script src="/public/static/js/jquery/jquery-2.0.3.min.js"></script>
<script src="/public/static/js/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="/public/static/artDialog/artDialog.js"></script>
<script src="/public/static/artDialog/iframeTools.js"></script>
<link href="/public/static/artDialog/skins/default.css" rel="stylesheet" type="text/css" />	
<script src="/public/static/view_res/home/js/common.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?32e3cb4cf7e5c6772c4dc1f5d496b6af";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>


<style>
	.hover{ background:#aaa; }
</style>
<script>
var attribute=get_url_attr('a');

if(attribute){	 
	 var ch = new Array;
	 ch = attribute.split(",");
	 if(ch.length==1){
		 $('#a'+attribute).addClass('hover');
	 }else if(ch.length>1){			 
		 		 
		 for(i=0;i<ch.length;i++){		  
			$('#a'+ch[i]).addClass('hover');
		}
	 }
}


$(function(){
	$('.attribute').click(function(){

		if(attribute){
			if($(this).hasClass('hover')){
				$(this).removeClass('hover');
			}else{
				$(this).siblings().removeClass('hover')
				$(this).addClass('hover');
			}
		}else{
				$(this).addClass('hover');
		}
		
		var length=$('#attribute li.hover').size();	
		
		
			var url = "<?php echo url('/category'); ?>"+'/'+'<?php echo \think\Request::instance()->param('id'); ?>';	
			var param='?a=';
	
		
		$('#attribute li.hover').each(function(i){
			
			if(i<length-1){
				param+=$('#attribute li.hover').eq(i).attr('aid')+',';
			}else{
				param+=$('#attribute li.hover').eq(i).attr('aid');
			}
			
		});
		
		url+=param;
		
		window.location.href = url;		
	});

	
});
</script>

</html>