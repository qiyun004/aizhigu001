<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:45:"./themes/default/member/checkout\confirm.html";i:1569657151;}*/ ?>
<?php if (!isset($redirect)) { ?>
<div class="table-responsive checkout-product">
  <table class="table table-bordered">
    <thead>
      <tr>
        <td class="name">名称</td>
        <td class="model">型号</td>
        <td class="quantity">数量</td>
        <td class="price">价格</td>
        <td class="total">总计</td>
      </tr>
    </thead>
    <tbody>
    	<?php $t=0; foreach ($products as $product) { $t+=$product['total']; ?>
      <tr>
        <td class="name">
        	<img src="/<?php echo $product['image']; ?>" />
        	<a href="<?php echo url('/goods/'.$product['goods_id']); ?>"><?php echo $product['name']; ?></a>
         	<div>
				<?php foreach ($product['option'] as $option) { ?>
				<small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
				<?php } ?>
        
		 	 </div>
        
        </td>
        <td class="model"><?php echo $product['model']; ?></td>
        <td class="quantity"><?php echo $product['quantity']; ?></td>
        <td class="price"><div class="price"><?php echo $product['price']; ?></div></td>
        <td class="total"><div class="price"><?php echo $product['total']; ?></div></td>
      </tr>
      <?php } ?>
      
    </tbody>
    <tfoot>
   	  
   	  
 	  <tr>
        <td colspan="4" class="price" style="text-align: right;"><b style="color: #C30005;">商品总价:</b></td>
        <td class="total"><div class="price"><?php echo '￥'.$t; ?></div></td>
      </tr> 
      
      <?php if($shipping_required){ ?> 	  
	      <tr>
	        <td colspan="4" class="price" style="text-align: right;"><b style="color: #C30005;">运费:</b></td>
	        <td class="total"><div class="price"><?php echo '￥'.$transport_fee['price']; ?></div></td>
	      </tr>
 	  <?php } ?>
 	  
      <tr>
        <td colspan="4" class="price" style="text-align: right;"><b style="color: #C30005;">总计:</b></td>
        <td class="total"><div class="price"><?php echo '￥'.($t+$transport_fee['price']) ?></div></td>
      </tr> 
      
    </tfoot>
  </table>
</div>
<div class="payment">
	<div class="buttons">
		<div class="right" style="margin-right:10px;">
	
			<input type="button" value="下单" id="pay" class="btn btn-primary btn-continue" />		
		</div>
	</div>	
</div>
<script>

$(function(){
	$('#pay').click(function(){

		$.ajax({
		url: '<?php echo url("/payment"); ?>', 
		type: 'post',	
		beforeSend: function() {
			$('#pay').attr('disabled', true);
			$('#pay').after('<span class="wait">&nbsp;<img src="/public/static/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			
		},			
		success: function(json) {
			if(json.type=='wx_pay'){			
				art.dialog.open(json.url, 
					{	id:'pay',
						title: '微信支付',
						lock: true
				});					
			}else{
				location = json.url;
			}
			
		},
		error: function(xhr, ajaxOptions, thrownError) {
			$('#pay').attr('disabled', true);
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
	});
});
	
</script>
<?php } else { ?>
<script type="text/javascript">
location = '<?php echo $redirect; ?>';
</script> 
<?php } ?>