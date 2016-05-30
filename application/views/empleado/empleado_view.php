<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARHITAC | Empleado</title>
    <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ARHITAC</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registros <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="empleado">Empleados</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Departamentos</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>
<br><br>
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
</body>
</html>