        <div id="content">

            <div class="container">
                <div class="row">
                    <h1>Ediciones Curso</h1>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-md-2"></div>
                    <fieldset class="col-md-8">
                        <div class="form-group">
                            <div class="row colbox">
                                <label for="id" class="control-label">ID:</label>
                                <?php echo $edicion_curso->id; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <label for="curso" class="control-label">Curso</label>
                                <?php echo $cursos[$edicion_curso->curso_id]; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <label for="lugar" class="control-label">Lugar</label>
                                <?php echo $edicion_curso->lugar; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <label for="fecha_inicial" class="control-label">Fecha de Inicio</label>
                                <?php echo date('d/m/Y', strtotime($edicion_curso->fecha_inicial)); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <label for="fecha_final" class="control-label">Fecha de Terminación</label>
                                <?php echo date('d/m/Y', strtotime($edicion_curso->fecha_final)); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <label for="institucion" class="control-label">Institución</label>
                                <?php echo $instituciones[$edicion_curso->institucion_id]; ?>
                            </div>
                        </div>

                    </fieldset>
                </div>
                <div class="row">
                    <h3>Empleados</h3>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr class="bg-primary">
                                <th>Número</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Departamento</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($empleados); $i++) { ?>
                                <tr>
                                    <td><?php echo $empleados[$i]->e_num; ?></td>
                                    <td><?php echo $empleados[$i]->e_nom; ?></td>
                                    <td><?php echo $empleados[$i]->p_nom; ?></td>
                                    <td><?php echo $empleados[$i]->d_nom;; ?></td>
                                    <td><a href="<?php echo base_url('edicion_curso/remover_empleado') . '/' . $edicion_curso->id . '/' . $empleados[$i]->e_num; ?>" type="button" class="btn btn-default"><i class="fa fa-trash" data-placement="bottom" title="Remover Empleado"></i></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <h3>Agregar Empleados</h3>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr class="bg-primary">
                                <th>Número</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Departamento</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($free_emp); $i++) { ?>
                                <tr>
                                    <td><?php echo $free_emp[$i]->e_num; ?></td>
                                    <td><?php echo $free_emp[$i]->e_nom; ?></td>
                                    <td><?php echo $free_emp[$i]->p_nom; ?></td>
                                    <td><?php echo $free_emp[$i]->d_nom;; ?></td>
                                    <td><a href="<?php echo base_url('edicion_curso/agregar_empleado') . '/' . $edicion_curso->id . '/' . $free_emp[$i]->e_num; ?>" type="button" class="btn btn-default"><i class="fa fa-plus" data-placement="bottom" title="Agregar Empleado"></i></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br/><br/>
                <div class="form-group">
                    <div class="col-sm-offset-8 col-lg-8 col-sm-8 text-left">
                        <input type="cancel" class="btn btn-danger" value="Cancelar" onClick="location.href='<?php echo base_url('edicion_curso'); ?>'"/>
                    </div>
                </div>
                <br/><br/>

            </div>

        </div><!-- #content -->