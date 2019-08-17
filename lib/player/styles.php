<?php require('../../../../../wp-load.php');
require('../../classes/scssphp/scss.inc.php');

global $wpdb;

use ScssPhp\ScssPhp\Compiler;

$scss = new Compiler();

$arquivo = file_get_contents('styles.scss');

$arquivo = str_replace('$padrao', '', $arquivo);

 


$style = $scss->compile($arquivo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    <?php echo  $style  ?>
    </style>

</head>
<body>
  

<div>
<p>
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi hic unde rerum vitae, similique eaque ipsa, nam quos accusamus expedita nulla pariatur ad eum ipsam doloremque, laboriosam non dignissimos amet!

</p>
</div>


   </body>

</html>