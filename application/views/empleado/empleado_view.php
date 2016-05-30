        <div id="content">

            <div class="container">
                <a href="empleado/add">Registrar empleado</a>
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
                                    <th>Actualizar</th>
                                    <th>Eliminar</th>
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
                                    <td><a href="<?php echo base_url() . "empleado/update/" . $empleados[$i]->numero; ?>">Actualizar</a></td>
                                    <td><a href="<?php echo base_url() . "empleado/delete/" . $empleados[$i]->numero; ?>">Eliminar</a></td>
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