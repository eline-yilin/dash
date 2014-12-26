<h2><?php echo $title;?></h2>

<?php echo validation_errors(); ?>
<?php if(isset($error)) var_dump($error);?>
<?php //if(isset($upload_data)) var_dump($upload_data);?>
<?php 
$attributes = array('class' => 'product_create', 'id' => 'product_create');
echo form_open_multipart('../product/create', $attributes);
 ?>

     <input type="hidden" id='_method' name="_method" value="CREATE">
	<input type='hidden' name='postback' value='1' />
	  <!-- Upload Image-->
	<fieldset>
      <div id="legend" class="">
        <legend class=""><?php echo $this->lang->line('uploadimage'); ?></legend>
    <div class="control-group   {?sizewarning} error {/sizewarning}">
          
          <!-- img-->
			<div class="controls hidden imgRow" id="imgTemplate">
          		 <input type="file",  class="input-xlarge"  id='thumbnail'>
         	 </div>
          <div class="controls imgRow">
            <input type="file", name="thumbnail1"  class="input-xlarge"  id='thumbnail1'>
          </div>
 		  <label class="control-label label-warning" for="thumbnail1" style='margin-top:5px;padding:3px;'><?php echo $this->lang->line('imgsizelimit'); ?></label>
 					<!-- Button -->
          <div class="controls">
            <button type='button' id='addImg' onclick="javascript:addImage();"  class="btn btn-success">
            	<i class="icon-white icon-plus-sign"></i><?php echo $this->lang->line('addImg'); ?>
            </button>
          </div>
          
    </div>
 
	</div>
    </fieldset>
	<!-- Prod Info-->
    <fieldset>
      <div id="legend" class="">
        <legend class=""><?php echo $this->lang->line('addproduct'); ?></legend>
    <div class="control-group">
          <!-- Text input-->
          <label class="control-label" for="username"><?php echo $this->lang->line('productname'); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='productname' id='productname'  value=''>
          </div>
          <!-- category-->
		  <label class="control-label hidden" for="phone"><?php echo $this->lang->line('category'); ?></label>
          <div class="controls hidden">
            <input type="text"  class="input-xlarge" name='category' id='category' value=''>
          </div>
           <!-- price-->
		  <label class="control-label" for="price"><?php echo $this->lang->line('price'); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='price' id='price' value=''>
          </div>
          <!-- desc-->
          <label class="control-label" for="phone"><?php echo $this->lang->line('description'); ?></label>
          <div class="controls">
            <textarea  class="input-xlarge" name='description' id='description'></textarea>
          </div>
          <!-- entity-->
          <label class="control-label"><?php echo $this->lang->line('entity'); ?></label>
          <div class="controls">
            <select class="input-xlarge" name='entity' id='entity'>
              <option value=''></option>
              <?php foreach($user['roles'] as $role):?>
              	<?php if($role['entity_type'] == 'entity' && !$role['is_deleted']):?>
	               <option value='<?php echo $role["entity_id"];?>'><?php echo $role["entity_name"];?></option>";
	             <?php endif;?>
             <?php endforeach;?>
            </select>
          </div>
    </div>
        
    </fieldset>
    <!-- entity Info-->
    <fieldset style='display:none;'>
      <div id="legend" class="">
        <legend class=""><?php echo $this->lang->line('displayinfo'); ?></legend>
    <div class="control-group">
          <!-- entity-->
          <label class="control-label"><?php echo $this->lang->line('entity'); ?></label>
          <div class="controls">
            <select class="input-xlarge" name='entity' id='entity'>
              <option value=''></option>
              {#data.entities}
              <option value='{id}'>{name}</option>";
              {/data.entities}
            </select>
          </div>
          <!-- weight-->
			<label class="control-label" for="weight"><?php echo $this->lang->line('priority'); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge" name='weight' id='weight' value={item.weight}>
          </div>
          
    </div>
        
    </fieldset>
    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button id='submit' class="btn btn-success"><i class="icon-white icon-hand-right"></i> <?php echo $this->lang->line('submit'); ?></button>
          </div>
        </div>
	</div>

</form>
<script>  
       
       function addImage()
        {
          var index  = $('div.imgRow').length;
          $("#imgTemplate").clone().removeClass('hidden').insertAfter("div.imgRow:last");
          $("div.imgRow:last").find('input').attr('name','thumbnail' +　index).attr('id','thumbnail' +　index );
        }
       var validator_messages = {

    	         'price': {

    	             required: "<?php echo $this->lang->line('required_error') . $this->lang->line('price');?>"
    	         },
    	         'productname': {

    	             required: "<?php echo $this->lang->line('required_error') . $this->lang->line('productname');?>"
    	         }
       };
       function validator_show_errors(errorMap,errorList, form){

    	   jQuery('label.ton-error').remove();
    	  
    	   for (var i in errorMap) {

    	       var rst = errorMap[i];

    	         console.log(i, ":", rst);

    	         var selector = i.replace(/\[/ig, '');

    	         selector = selector.replace(/\]/ig, '');

    	       

    	         switch (i)

    	         {    
    	               default:             
    	               $('#' + i).after('<label class="error my-error for_' + selector +  '">' + rst + '</label>');

    	                   break;

    	              }

    	   }

    	  }
       $(document).ready(function(){ 
    	   var add_validator = jQuery('#<?php echo $router . "_" . $action;?>').validate({

    	         ignore: "",

    	         onkeyup: false,//function(element) {},

    	         onfocusout: false,

    	         messages : validator_messages ,

    	         showErrors: function(errorMap, errorList)

    	         {           

    	          validator_show_errors(errorMap, errorList,'#<?php echo $router . "_" . $action;?>');            

    	         },

    	         submitHandler: function(form) {

    	             form.submit();

    	         },           

    	     });

       
           });
        </script>