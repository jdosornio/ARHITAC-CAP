<div id="content">

    <div class="container">
        <div class="row">
            <h1>Ediciones Curso</h1>
        </div>

        <div class="row">
            <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
                <legend>Registro de ediciones de curso</legend>
                <?php
                $attributes = array("class" => "form-horizontal", "id" => "edicion_cursoform", "name" => "edicion_cursoform");
                echo form_open("edicion_curso/add", $attributes); ?>
                <fieldset>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="curso" class="control-label">Curso</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "curso"';
                                echo form_dropdown('curso', $cursos, set_value('curso'), $attributes); ?>
                                <span class="text-danger"><?php echo form_error('curso'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="lugar" class="control-label">Lugar</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="lugar" name="lugar" placeholder="Lugar de la Edición del Curso" type="text" class="form-control"  value="<?php echo set_value('lugar'); ?>" />
                                <span class="text-danger"><?php echo form_error('lugar'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="fecha_inicial" class="control-label">Fecha de Inicio</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="fecha_inicial" name="fecha_inicial" readonly type="text" class="form-control"  value="<?php echo set_value('fecha_inicial'); ?>" />
                                <span class="text-danger"><?php echo form_error('fecha_inicial'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="fecha_final" class="control-label">Fecha de Terminación</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="fecha_final" name="fecha_final" readonly type="text" class="form-control"  value="<?php echo set_value('fecha_final'); ?>" />
                                <span class="text-danger"><?php echo form_error('fecha_final'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="institucion" class="control-label">Institución</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "institucion"';
                                echo form_dropdown('institucion', $instituciones, set_value('institucion'), $attributes); ?>
                                <span class="text-danger"><?php echo form_error('institucion'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                            <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Enviar" />
                            <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancelar" onClick="location.href='<?php echo base_url('edicion_curso'); ?>'" />
                        </div>
                    </div>
                </fieldset>
                <?php echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>

    <!-- Se agrega aqui para no cargarlo to-do el tiempo-->
    <script>
        $(function() {
            $( "#fecha_inicial" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( '#fecha_final' ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>

</div><!-- #content -->