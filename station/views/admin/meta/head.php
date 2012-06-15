

<meta charset="utf-8" />
<!--Css Style here-->

<link rel="stylesheet" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/reset.css" />
<link rel="stylesheet" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/text.css" />
<link rel="stylesheet" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/960.css" />
<link rel="stylesheet" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/style.css" />
<link rel="stylesheet" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/menu.css" />
<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/gray/easyui.css">
<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
<link rel="stylesheet" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/jquery.noty.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/noty_theme_default.css"/>
<link rel="stylesheet" href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/carbo/jquery-ui-1.8.21.custom.css" type="text/css" media="all" />
<link href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/carbo.grid.css" rel="stylesheet" type="text/css" media="all" />
<!--[if lt IE 7]><link href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/carbo.grid.ie6.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->
<link href="<?php echo  base_url().APPPATH.('views/admin/') ?>css/carbo.form.css" rel="stylesheet" type="text/css" media="all" />

<!--Meta tags here -->

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="noindex, follow" />

<!-- Jquey here -->
<script type="text/javascript" src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/jquery-1.7.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>

<script src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/jquery.bbq.js" type="text/javascript"></script>
<script src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/jquery.timepicker.js" type="text/javascript"></script>
<script src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/carbo.grid.js" type="text/javascript"></script>
<script src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/carbo.form.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/jquery.easyui.min.js"></script>
<script src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/formee.js"></script>
<script type="text/javascript" src="<?php echo  base_url().APPPATH.('views/admin/') ?>js/jquery.noty.js"></script>
<style type="text/css">
 
label {
	width: 10em;
	float: left;
}
label.error {
	float: none;
	color: red;
	padding-left: .5em;
	vertical-align: top;
}
legend {
	font-size:16px;
	color:#0099CC;
}
p {
	clear: both;
}
.submit {
	margin-left: 12em;
}
em {
	font-weight: bold;
	padding-right: 1em;
	vertical-align: top;
}
</style>
<script>
/*
$(document).ready(function(){


$("#login_submit").click( 


function(){


name = $("#name").val();
email =  $("#email").val();
passworld = $("#passworld").val();
bio = $("#bio").val();
type = $("#type").val();


$("#setting").validationEngine('attach');


$.post("{base_url}index.php/admin/users_sucess", {"name":name,"passworld":passworld, "email": email, "bio": bio, "type": type},

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
*/
</script> 