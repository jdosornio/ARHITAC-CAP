        <div id="content">

            <div class="container">
                <div class="row">
                    <h1>Cursos</h1>
                </div>
                <div class="row">
                    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
                        <legend>Modificar curso</legend>
                        
                        <?php
                        $attributes = array("class" => "form-horizontal", "id" => "cursoform", "name" => "cursoform");
                        echo form_open('curso/update/' . $id, $attributes);?>
                        <fieldset>

                            <div class="form-group">
                                <div class="row colbox">

                                    <div class="col-lg-4 col-sm-4">
                                        <label for="id" class="control-label">ID</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8">
                                        <input id="id" name="id" type="text" disabled="disabled" class="form-control" value="<?php echo $curso->id; ?>" />
                                        <span class="text-danger"><?php echo form_error('id'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row colbox">
                                    <div class="col-lg-4 col-sm-4">
                                        <label for="nombre" class="control-label">Nombre</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8">
                                        <input id="nombre" name="nombre" placeholder="Nombre del Curso" type="text" class="form-control"  value="<?php echo $curso->nombre; ?>" />
                                        <span class="text-danger"><?php echo form_error('nombre'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row colbox">
                                    <div class="col-lg-4 col-sm-4">
                                        <label for="descripcion" class="control-label">Descripción</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8">
                                        <input id="descripcion" name="descripcion" placeholder="Descripción del Curso" type="text" class="form-control"  value="<?php echo $curso->descripcion; ?>" />
                                        <span class="text-danger"><?php echo form_error('descripcion'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Modificar" />
                                    <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancelar" onClick="location.href='<?php echo base_url('curso'); ?>'"/>
                                </div>
                            </div>
                        </fieldset>

                        <?php echo form_close(); ?>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                </div>
            </div>

        </div><!-- #content -->