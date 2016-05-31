        <div id="content">

            <div class="container">
                <div class="row">
                    <h1>Puestos</h1>
                </div>
                <a href="<?php echo base_url('puesto/add'); ?>" type="button" class="btn btn-default"><i class="fa fa-plus" data-placement="bottom" title="Registrar puesto"></i></a>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr class="bg-primary">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($puestos); $i++) { ?>
                                <tr>
                                    <td><?php echo $puestos[$i]->id; ?></td>
                                    <td><?php echo $puestos[$i]->nombre; ?></td>
                                    <td><a href="<?php echo base_url('puesto/update') . '/' . $puestos[$i]->id; ?>" type="button" class="btn btn-default"><i class="fa fa-pencil" data-placement="bottom" title="Modificar"></i></a></td>
                                    <td><a href="<?php echo base_url('puesto/delete') . '/' . $puestos[$i]->id; ?>" type="button" class="btn btn-default"><i class="fa fa-trash" data-placement="bottom" title="Eliminar"></i></a></td>
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