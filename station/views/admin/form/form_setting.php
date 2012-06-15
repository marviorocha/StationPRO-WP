<script>

$(document).ready(function(){


$("#login_submit").click( 


function(){


company = $("#company").val();
slogan =  $("#slogan").val();
email = $("#email").val();
description = $("#description").val();
web_url = $("#web_url").val();
type = $("#streaming").val();
type = $("#type").val();
type = $("#type").val();


$("#setting").validationEngine('attach');


$.post("{base_url}index.php/admin/setting_sucess", {"name":name,"passworld":passworld, "email": email, "bio": bio, "type": type},

function(data){
// verifica o retorno


if(name=="" || passworld == "" || email =="" || bio =="" || type ==""  )
{
// igual à 0 ok
noty({"text":"{error}","layout":"topCenter","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});;

}
else
{
noty({"text":"{success}","layout":"topCenter","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":true});;

$("#postada").html(data).css(data).fadeIn(3000);
}

});

});


});
 
</script>
 
<form  id="setting" class="formee" action="javascript:void();" method="post"> 
<input type="hidden" name="id_Settings" value="1">
   <div class="easyui-tabs" style="width:900px;">  
        <div title="<?php echo lang('system_settings') ?>" style="padding:20px;">  
          <fieldset class="grid-8-12">
      
        <div class="grid-11-12">
          <label for=""><?php echo lang('company'); ?></label>
          <input class="validate[required]" id="company" name="company" value="{company}" type="text">
        </div>
        <div class="grid-11-12">
          <label for=""><?php echo lang('slogan'); ?></label>
          <input class="validate[required]"  id="slogan" name="slogan" type="text">
        </div>
        <div class="grid-11-12">
          <label for=""><?php echo lang('email'); ?></label>
          <input class="validate[required][custom[email]]" id="email"  value=""   name="email" type="text">
        </div>
        <div class="grid-11-12">
          <label for=""><?php echo lang('description'); ?></label>
          <textarea rows="3" name="description"  id="description" /></textarea>
        </div>
        <div class="grid-11-12">
          <label for=""><?php echo lang('url'); ?></label>
          <input class="validate[required][custom[url]]" name="web_url"  id="web_url" type="text">
        </div>
        <div class="grid-11-12">
          
        </div>
      </fieldset>
       <fieldset class="grid-8-12">
       <legend><?php echo lang('streaming'); ?></legend>
        <div class="grid-6-12">
          <label for=""><?php echo lang('ip'); ?></label>
          <input class="validate[required]" name="ip"  id="ip" type="text">
        </div>
        <div class="grid-5-12">
          <label for=""><?php echo lang('port'); ?></label>
          <input class="validate[required]"  id="port" name="port" type="text">
        </div>
        <div class="grid-11-12"> </div>
        <div class="grid-11-12">
        <input class="formee-button right" id="login_submit"  type="submit" value="<?php echo lang('button_salve'); ?>" />
        </div>
      </fieldset>
        </div>  
       
       
       
        <div title="<?php echo lang('streaming') ?>" style="padding:20px;" >  
           
        </div>  
      
        <div title="Database"   style="padding:5px;">  
            No full
        </div>  
    </div>  
    <!-- formee-->
   
      </form>