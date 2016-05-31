        <div id="content">

            <div class="container">
                <div class="row">
                    <h1>Empleados</h1>
                </div>
                <?php echo $this->session->flashdata('msg'); ?>
                <a href="<?php echo base_url('empleado/add'); ?>" type="button" class="btn btn-default"><i class="fa fa-plus" data-placement="bottom" title="Registrar Empleado"></i></a>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Número</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Departamento</th>
                                    <th>Puesto</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($empleados); $i++) { ?>
                                <tr>
                                    <td><?php echo $empleados[$i]->numero; ?></td>
                                    <td><?php echo $empleados[$i]->nombre." ".$empleados[$i]->apellido_paterno." ".$empleados[$i]->apellido_materno; ?></td>
                                    <td><?php echo $empleados[$i]->correo; ?></td>
                                    <td><?php echo $empleados[$i]->dpto_nombre; ?></td>
                                    <td><?php echo $empleados[$i]->pto_nombre; ?></td>
                                    <td><a href="<?php echo base_url('empleado/update') . '/' . $empleados[$i]->numero; ?>" type="button" class="btn btn-default"><i class="fa fa-pencil" data-placement="bottom" title="Modificar"></i></a></td>
                                    <td><a href="<?php echo base_url('empleado/delete') . '/' . $empleados[$i]->numero; ?>" type="button" class="btn btn-default"><i class="fa fa-trash" data-placement="bottom" title="Eliminar"></i></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>

        </div><!-- #content -->