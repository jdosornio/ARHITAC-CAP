<div id="content">

    <div class="container">
        <div class="row">
            <h1>Instituciones</h1>
        </div>
        <?php echo $this->session->flashdata('msg'); ?>
        <a href="<?php echo base_url('institucion/add'); ?>" type="button" class="btn btn-default"><i class="fa fa-plus" data-placement="bottom" title="Registrar Institución"></i></a>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr class="bg-primary">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($instituciones); $i++) { ?>
                        <tr>
                            <td><?php echo $instituciones[$i]->id; ?></td>
                            <td><?php echo $instituciones[$i]->nombre; ?></td>
                            <td><?php echo $instituciones[$i]->telefono; ?></td>
                            <td><?php echo $instituciones[$i]->correo; ?></td>
                            <td><?php echo $instituciones[$i]->direccion; ?></td>
                            <td><a href="<?php echo base_url('institucion/update') . '/' . $instituciones[$i]->id; ?>" type="button" class="btn btn-default"><i class="fa fa-pencil" data-placement="bottom" title="Modificar"></i></a></td>
                            <td><a href="<?php echo base_url('institucion/delete') . '/' . $instituciones[$i]->id; ?>" type="button" class="btn btn-default"><i class="fa fa-trash" data-placement="bottom" title="Eliminar"></i></a></td>
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