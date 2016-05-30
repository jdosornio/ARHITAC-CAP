<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'printable');
        mywindow.document.write('<html><head>');
        $("link[type='text/css']").each(function() {
            var stylesheet = $(this).clone().wrap("<div />").parent().html();
            mywindow.document.write(stylesheet);
        });
        mywindow.document.write('</head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
    <div class="container" id="printable">
        <div class="row">
            <div class="col-md-2"></div>
            <fieldset class="col-md-8">
                <div class="form-group">
                <div class="row colbox">
                    <label for="numero" class="control-label">Número:</label>
                    <?php echo $empleado[0]->numero; ?>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                    <label for="nombre" class="control-label">Nombre</label>
                    <?php echo $empleado[0]->nombre." ".$empleado[0]->apellido_paterno." ".$empleado[0]->apellido_materno; ?>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                    <label for="correo" class="control-label">Correo electrónico</label>
                    <?php echo $empleado[0]->correo; ?>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                    <label for="departamento" class="control-label">Departamento</label>
                    <?php echo $departamento[$empleado[0]->departamento_id];?>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                    <label for="puesto" class="control-label">Puesto</label>
                    <?php echo $puesto[$empleado[0]->puesto_id];?>
                    <div class="pull-right">
                        <button onclick="PrintElem('#printable')" class="btn btn-default"><i class="fa fa-print" data-placement="bottom" title="Imprimir kardex"></i></button>
                    </div>
                </div>
                </div>
            </fieldset>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr class="bg-primary">
                        <th>Curso</th>
                        <th>Fecha inicial</th>
                        <th>Fecha final</th>
                        <th>Institución</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($kardex); $i++) { ?>
                        <tr>
                            <td><?php echo $kardex[$i]->cur_nombre; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($kardex[$i]->fecha_inicial)); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($kardex[$i]->fecha_final)); ?></td>
                            <td><?php echo $kardex[$i]->ins_nombre; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<br></br>
<br></br>