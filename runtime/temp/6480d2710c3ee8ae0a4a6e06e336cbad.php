<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"./themes/default/member/checkout\shipping_address.html";i:1569657151;}*/ ?>
<?php if ($addresses) { ?>
<input type="radio" name="shipping_address" value="existing" id="shipping-address-existing" checked="checked" />
<label for="shipping-address-existing">使用已有地址</label>
<div id="shipping-existing">
  <select name="address_id" style="width: 100%; margin-bottom: 15px;" size="5">
    <?php foreach ($addresses as $address) { if ($address['address_id'] == $address_id) { ?>
    <option value="<?php echo $address['address_id']; ?>" selected="selected">姓名：<?php echo $address['name']; ?>, 电话：<?php echo $address['telephone']; ?>,  地址：<?php echo $address['province']; ?>, <?php echo $address['city']; ?>, <?php echo $address['country']; ?>,<?php echo $address['address']; ?></option>
    <?php } else { ?>
    <option value="<?php echo $address['address_id']; ?>">姓名：<?php echo $address['name']; ?>, 电话：<?php echo $address['telephone']; ?>, 地址： <?php echo $address['province']; ?>, <?php echo $address['city']; ?>, <?php echo $address['country']; ?>,<?php echo $address['address']; ?></option>
    <?php } } ?>
  </select>
</div>
<p>
  <input type="radio" name="shipping_address" value="new" id="shipping-address-new" />
  <label for="shipping-address-new">使用新地址</label>
</p>
<?php }else{ ?>
<input type="hidden" name="shipping_address" value="new" />
<?php } ?>
<div id="shipping-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
  <table class="form">
  	
    <tr>
      <td><span class="required">*</span> 姓名</td></tr>
	<tr>  
      <td><input type="text" name="name" value="" class="large-field text" /></td>
    </tr>

     <tr>
      <td><span class="required">*</span> 电话</td></tr>
	<tr>
      <td><input type="text" name="telephone" value="" class="large-field text" /></td>
    </tr>
 
     <tr>
      <td><span class="required">*</span> 所在地</td></tr>
      <style>
		#area select{width:100px;}
		
	</style>
	<tr>
      <td> <p id="area">
        <select name="province_id" id="province">
            <option value="-1" selected>省份</option>
            <?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $v['area_id']; ?>"><?php echo $v['area_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <select name="city_id" id="city">
            <option value="-1">城市</option>
        </select>  
     </p></td>
    </tr>
 
    <tr>
      <td><span class="required">*</span> 地址</td></tr>
	<tr>
      <td><input type="text" name="address" value="" class="large-field text" /></td>
    </tr>


     
  </table>
</div>
<br />
<div class="buttons">
  <div class="left">
    <input type="button" value="继续" id="button-shipping-address" class="btn btn-primary btn-continue" />
  </div>
</div>
<script type="text/javascript">
$('#shipping-address input[name=\'shipping_address\']').live('change', function() {
	if (this.value == 'new') {
		$('#shipping-existing').hide();
		$('#shipping-new').show();
	} else {
		$('#shipping-existing').show();
		$('#shipping-new').hide();
	}
});
$("#province").change(function(){
            var ajaxurl='<?php echo url("/getarea"); ?>';
            var areaId=this.value;
            var areaType='city';
            $('#country').remove();
            if(areaId!=-1){
            $.post(ajaxurl,{'areaId':areaId},function(data){                
                if(areaType==='city'){
                   $('#'+areaType).html('<option value="-1">城市</option>');              
                }
              
                if(areaType!=='null'){
                    $.each(data,function(no,items){
                        $('#'+areaType).append('<option value="'+items.area_id+'">'+items.area_name+'</option>');
                    });
                }
            });
           }else{
           	$('#'+areaType).html('<option value="-1">城市</option>');       
           }
        }); 
        
		$("#city").change(function(){
            var ajaxurl='<?php echo url("/getarea"); ?>';
            var areaId=this.value;
            var areaType='county';
      		 $('#country').remove();
            $.post(ajaxurl,{'areaId':areaId},function(data){   
                   
               if(data!=null){
              
               	var html='';
               	html+=' <select name="country_id" id="country">'
               	$.each(data,function(no,items){
                      html+=  '<option value="'+items.area_id+'">'+items.area_name+'</option>';
                 });
               	html+='</select>';
               	$('#area').append(html);
               }
            });
           
        }); 
</script>