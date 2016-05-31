        <div id="content">

            <div class="container">
                <div class="row">
                    <h1>Cursos</h1>
                </div>
                <?php echo $this->session->flashdata('msg'); ?>
                <a href="<?php echo base_url('curso/add'); ?>" type="button" class="btn btn-default"><i class="fa fa-plus" data-placement="bottom" title="Registrar Curso"></i></a>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr class="bg-primary">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($cursos); $i++) { ?>
                                <tr>
                                    <td><?php echo $cursos[$i]->id; ?></td>
                                    <td><?php echo $cursos[$i]->nombre; ?></td>
                                    <td><?php echo $cursos[$i]->descripcion; ?></td>
                                    <td><a href="<?php echo base_url('curso/update') . '/' . $cursos[$i]->id; ?>" type="button" class="btn btn-default"><i class="fa fa-pencil" data-placement="bottom" title="Modificar"></i></a></td>
                                    <td><a href="<?php echo base_url('curso/delete') . '/' . $cursos[$i]->id; ?>" type="button" class="btn btn-default"><i class="fa fa-trash" data-placement="bottom" title="Eliminar"></i></a></td>
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