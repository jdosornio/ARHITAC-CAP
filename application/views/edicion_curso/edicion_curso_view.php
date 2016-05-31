<div id="content">

    <div class="container">
        <div class="row">
            <h1>Ediciones Curso</h1>
        </div>
        <?php echo $this->session->flashdata('msg'); ?>
        <a href="<?php echo base_url('edicion_curso/add'); ?>" type="button" class="btn btn-default"><i class="fa fa-plus" data-placement="bottom" title="Registrar Edición de Curso"></i></a>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr class="bg-primary">
                        <th>ID</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Terminación</th>
                        <th>Curso</th>
                        <th>Lugar</th>
                        <th>Institución</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($ediciones_curso); $i++) { ?>
                        <tr>
                            <td><?php echo $ediciones_curso[$i]->id; ?></td>
                            <td><?php echo $ediciones_curso[$i]->fecha_inicial; ?></td>
                            <td><?php echo $ediciones_curso[$i]->fecha_final; ?></td>
                            <td><?php echo $ediciones_curso[$i]->c_nombre; ?></td>
                            <td><?php echo $ediciones_curso[$i]->lugar; ?></td>
                            <td><?php echo $ediciones_curso[$i]->i_nombre; ?></td>
                            <td><a href="<?php echo base_url('edicion_curso/update') . '/' . $ediciones_curso[$i]->id; ?>" type="button" class="btn btn-default"><i class="fa fa-pencil" data-placement="bottom" title="Modificar"></i></a></td>
                            <td><a href="<?php echo base_url('edicion_curso/delete') . '/' . $ediciones_curso[$i]->id; ?>" type="button" class="btn btn-default"><i class="fa fa-trash" data-placement="bottom" title="Eliminar"></i></a></td>
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