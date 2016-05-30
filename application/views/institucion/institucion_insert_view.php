<div id="content">

    <div class="container">
        <div class="row">
            <h1>Instituciones</h1>
        </div>
        <div class="row">
            <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
                <legend>Registro de instituciones</legend>

                <?php
                $attributes = array("class" => "form-horizontal", "id" => "institucionform", "name" => "institucionform");
                echo form_open("institucion/add", $attributes);?>
                <fieldset>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="nombre" class="control-label">Nombre</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="nombre" name="nombre" placeholder="Nombre de la Institución" type="text" class="form-control"  value="<?php echo set_value('nombre'); ?>" />
                                <span class="text-danger"><?php echo form_error('nombre'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="descripcion" class="control-label">Teléfono</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="telefono" name="telefono" placeholder="Teléfono de la Institución" type="text" class="form-control"  value="<?php echo set_value('telefono'); ?>" />
                                <span class="text-danger"><?php echo form_error('telefono'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="descripcion" class="control-label">Correo electrónico</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="correo" name="correo" placeholder="someone@example.com" type="text" class="form-control"  value="<?php echo set_value('correo'); ?>" />
                                <span class="text-danger"><?php echo form_error('correo'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="descripcion" class="control-label">Dirección</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="direccion" name="direccion" placeholder="Dirección de la Institución" type="text" class="form-control"  value="<?php echo set_value('direccion'); ?>" />
                                <span class="text-danger"><?php echo form_error('direccion'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                            <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Enviar" />
                            <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancelar" onClick="location.href='<?php echo base_url('institucion'); ?>'"/>
                        </div>
                    </div>
                </fieldset>

                <?php echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>

</div><!-- #content -->