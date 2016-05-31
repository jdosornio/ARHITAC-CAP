<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARHITAC | <?php echo $title; ?></title>
    <link href="<?php echo base_url('assets/jquery-ui-1.11.4/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/font-awesome-4.6.3/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/pageStyle.css'); ?>" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url('assets/js/jquery-1.12.4.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('assets/jquery-ui-1.11.4/jquery-ui.min.js'); ?>"></script>
</head>
<body>
    <div id="wrapper">
    
        <div id="header">

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">ARHITAC</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registros <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('empleado'); ?>">Empleados</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('curso'); ?>">Cursos</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('puesto'); ?>">Puestos</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('departamento'); ?>">Departamentos</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('institucion'); ?>">Instituciones</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('edicion_curso'); ?>">Ediciones de Curso</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url('kardex'); ?>">Kardex</a>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <br><br>

    </div><!-- #header -->