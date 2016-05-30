<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARHITAC | Empleados</title>
    <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/jquery-ui-1.11.4/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('assets/js/jquery-1.12.4.js'); ?>"></script>
    <script src="<?php echo base_url('assets/jquery-ui-1.11.4/jquery-ui.min.js'); ?>"></script>
        
    <style type="text/css">
    .colbox {
        margin-left: 0px;
        margin-right: 0px;
    }
    </style>    
</head>
<body>
<div class="container">
    
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Registro de empleados</legend>
        <?php 
        $attributes = array("class" => "form-horizontal", "id" => "empleadoform", "name" => "empleadoform");
        echo form_open("empleado/add", $attributes);?>
        <fieldset>
            
            <div class="form-group">
            <div class="row colbox">
            
            <div class="col-lg-4 col-sm-4">
                <label for="numero" class="control-label">Número</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="numero" name="numero" placeholder="numero" type="text" class="form-control"  value="<?php echo set_value('numero'); ?>" />
                <span class="text-danger"><?php echo form_error('numero'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="nombre" class="control-label">Nombre</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="nombre" name="nombre" placeholder="nombre" type="text" class="form-control"  value="<?php echo set_value('nombre'); ?>" />
                <span class="text-danger"><?php echo form_error('nombre'); ?></span>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="apellido_paterno" class="control-label">Apellido paterno</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="apellido_paterno" name="apellido_paterno" placeholder="apellido_paterno" type="text" class="form-control"  value="<?php echo set_value('apellido_paterno'); ?>" />
                <span class="text-danger"><?php echo form_error('apellido_paterno'); ?></span>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="apellido_materno" class="control-label">Apellido materno</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="apellido_materno" name="apellido_materno" placeholder="apellido_materno" type="text" class="form-control"  value="<?php echo set_value('apellido_materno'); ?>" />
                <span class="text-danger"><?php echo form_error('apellido_materno'); ?></span>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="correo" class="control-label">Correo electrónico</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="correo" name="correo" placeholder="correo" type="text" class="form-control"  value="<?php echo set_value('correo'); ?>" />
                <span class="text-danger"><?php echo form_error('correo'); ?></span>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="departamento" class="control-label">Departamento</label>
            </div>
            <div class="col-lg-8 col-sm-8">
            
                <?php
                $attributes = 'class = "form-control" id = "departamento"';
                echo form_dropdown('departamento',$departamento,set_value('departamento'),$attributes);?>
                <span class="text-danger"><?php echo form_error('departamento'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="puesto" class="control-label">Puesto</label>
            </div>
            <div class="col-lg-8 col-sm-8">
            
                <?php
                $attributes = 'class = "form-control" id = "puesto"';
                echo form_dropdown('puesto',$puesto, set_value('puesto'), $attributes);?>
                
                <span class="text-danger"><?php echo form_error('puesto'); ?></span>
            </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Enviar" />
                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancelar" onClick="location.href='<?php echo base_url(); ?>empleado'"/>
            </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>
</div>
</body>
</html>