<?php
    $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
    $this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
?>
<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="description" content="CarboGrid is a PHP datagrid and CRUD written in the CodeIgniter Framework" />
    <meta name="abstract" content="CarboGrid is a PHP datagrid and CRUD written in the CodeIgniter Framework" />
    <meta name="keywords" content="carbogrid, php, datagrid, codeigniter, jquery, jquery-ui, jquery ui, rad, grid, data, rapid application development, crud, create update delete, form generation" />

    <title>CarboGrid - DataGrid and CRUD for CodeIgniter</title>

    <link href="<?php echo base_url(); ?>favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>css/carbo/jquery-ui-1.8.21.custom.css" type="text/css" media="all" />

    <link href="<?php echo base_url(); ?>css/carbo.grid.css" rel="stylesheet" type="text/css" media="all" />
    <!--[if lt IE 7]><link href="<?php echo base_url(); ?>css/carbo.grid.ie6.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->
    <link href="<?php echo base_url(); ?>css/carbo.form.css" rel="stylesheet" type="text/css" media="all" />

    <link href="<?php echo base_url(); ?>css/960.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
<?php $this->load->view('header'); ?>
<?php $this->load->view('content'); ?>
<?php $this->load->view('footer'); ?>
</div>

<script src="http://code.jquery.com/jquery-1.7.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>js/jquery.bbq.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.timepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/carbo.grid.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/carbo.form.js" type="text/javascript"></script>

</body>

</html>

