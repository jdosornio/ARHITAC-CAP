        <div id="content">
            <div class="container">
                <div class="row">
                    <h1>Kardex</h1>
                </div>
                <div class="row">
                    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
                        <legend>Busqueda de empleados</legend>

                        <?php
                        $attributes = array("class" => "form-inline", "id" => "kardexform", "name" => "kardexform");
                        echo form_open("kardex/generar", $attributes);?>
                        <fieldset>
                            <div class="form-group">
                                <div class="row colbox">
                                    <div class="col-lg-4 col-sm-4">
                                        <label for="numero" class="control-label">Número</label>
                                    </div>
                                    <div class="col-lg-7 col-sm-7">
                                        <input id="numero" name="numero" placeholder="Número de empleado" type="text" class="form-control"  value="<?php echo set_value('numero'); ?>" />
                                        <span class="text-danger"><?php echo form_error('numero'); ?></span>
                                    </div>
                                    <div class="col-lg-1 col-sm-1">
                                        <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value='Buscar' />
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <?php echo form_close(); ?>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                </div>
            </div>

        </div><!-- #content -->