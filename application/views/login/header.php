<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->config->item('site_name'); ?></title>
    <!-- CSS obligatorios -->
    <!--<link href="<?php //echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">-->
    <!--<link href="<?php //echo base_url('assets/css/datatables.css'); ?>" rel="stylesheet">-->
    <!--<link href="<?php //echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet">-->
    <!--<link href="<?php //echo base_url('assets/css/global.css'); ?>" rel="stylesheet">-->


    <!-- CSS del modulo -->
    <?php
    $mod = $this->uri->segment(1);
    if(!$mod){$mod="login";}
    ?>
    <link href="<?php echo base_url('assets/css/' . $mod . '.css'); ?>" rel="stylesheet">

</head>


<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xs-6">

            </div>


        </div><!-- /row -->
    </div><!-- /container -->
</header>

<div id="wrap">
			