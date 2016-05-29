


<div class="container">

    <div class="form-signin">
        <?php echo form_open('login/auth'); ?><div class="input-group margin-bottom-sm">
            <h3 class="form-signin-heading"><?php echo $this->config->item('site_name'); ?></h3>
            <input type="text" class="form-control" placeholder="Nombre de Usuario" name="user" required autofocus/>
            <input type="password" class="form-control" placeholder="Contraseña" name="pass" required/>
            <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
            <?php echo form_close(); ?>
        </div>


    </div> <!-- /container -->
