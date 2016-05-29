
</div>


<!-- Javascripts Obligatorios para la aplicacion -->
<!--<script src="<?php //echo base_url('assets/js/jquery.js'); ?>"></script>-->
<!--<script src="<?php //echo base_url('assets/js/bootstrap.js'); ?>"></script>-->
<!--<script src="<?php //echo base_url('assets/js/global.js'); ?>"></script>-->
<!--<script src="<?php //echo base_url('assets/js/jquery.dataTables.js'); ?>"></script>-->
<!--<script src="<?php //echo base_url('assets/js/datatables.js'); ?>"></script>-->


<!-- Javascript del Modulo -->
<?php
$mod = $this->uri->segment(1);
if(!$mod){$mod="login";}
?>
<script src="<?php echo base_url('assets/js/' . $mod . '.js'); ?>"></script>

</body>
</html>