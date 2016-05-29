<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * Método llamado por defecto al cargar el controlador. Sirve para
     * validar si existe un error al iniciar sesión o para redireccionar al
     * dashboard del usuario en caso de ya haber iniciado sesión
     */
    public function index() {

//        if(!$this->session->userdata('USER_LOGIN')) {
//            //si no se ha iniciado sesión y hay un error, mostrarlo
//            $this->load->view('login/header');
//
//            if ($this->session->userdata('ERROR')) {
//                $data["error"] = $this->session->userdata('ERROR');
//                $this->load->view('error', $data);
//            }
//
//            $this->load->view('login/main');
//            $this->load->view('login/footer');
//
//            $this->session->sess_destroy();
//        } else {
//            //Redireccionar al dashboard
//            redirect('dashboard');
//        }

        $this->load->model('base');

        $departamentos = $this->base->get_all('departamento');

        if ($departamentos) {
            foreach ($departamentos as $dept) {
                echo $dept->id . ' ' . $dept->nombre . '<br/>';
            }
        }

        //Datos empleado
        $empleado = array(
            'numero' => '123458',
            'nombre' => 'JUAN',
            'apellido_paterno' => 'PEREZ',
            'apellido_materno' => 'HERNANDEZ',
            'correo' => 'juan.perez@arhitac.com',
            'puesto_id' => 6,
            'departamento_id' => 7
        );

        $err = $this->base->add('empleado', $empleado);

        echo 'Error: ' . $err . '<br/><br/>';

        $puestos = $this->base->get('puesto', array('nombre LIKE' => 'GER%'));

        if ($puestos) {
            foreach ($puestos as $p) {
                echo $p->id . ' ' . $p->nombre . '<br/>';
            }
        }

        //$this->base->update('puesto', array('id' => 5), array('nombre' => 'cio'));

        //$this->base->delete('puesto', array('id' => 5));

    }

    /**
     * Este método sirve para validar la autentificación de un usuario en el
     * sistema, redireccionando al dashboard en caso de éxito o al main de
     * login en caso contrario
     */
    public function auth() {
//        $this->load->model("base");
//
//        //Obtiene el arreglo de los usuarios que cumplan con el nombre de
//        // usuario especificado y la contraseña (uno o ninguno)
//        $usuarios = $this->base->get('usuario',
//            array('usuario' => strtolower($this->input->post('user')),
//                'activo' => true,
//                'contrasena' => sha1($this->input->post('pass'))));
//
//        //Si hubo resultados
//        if($usuarios) {
//
//            //Obtener los datos del participante (empleado)
//            $participante = $this->base->get('participante',
//                array('rpe' => $usuarios[0]->rpe))[0];
//
//            //Guardar los datos del usuario en la sesión
//            $this->session->set_userdata('USER_NAME', $participante->nombre);
//            $this->session->set_userdata('USER_LOGIN', $usuarios[0]->usuario);
//            $this->session->set_userdata('RPE', $usuarios[0]->rpe);
//            $this->session->set_userdata('USER_TYPE', $usuarios[0]->tipo);
//            $this->session->set_userdata('DEPARTMENT_ID',
//                $participante->idDepartamento);
//            $this->session->set_userdata('USER_EMAIL', $participante->email);
//
//            //crear filtros
//            $this->session->set_userdata('FILTRO_NOCHECKS_FECHA1', date("Y-m-d"));
//
//            redirect('dashboard');
//        }
//        else {
//            //Redireccionar al main de login
//            $error = "Usuario o Contraseña incorrectos!!";
//            $this->session->set_userdata('ERROR', $error);
//            redirect('login');
//        }

    }


    //logout del sistema
    public function logout(){
//        $this->session->sess_destroy();
//        redirect("login");
    }


    //forma para enviar correo y resetear el password
    public function pass_forgot(){

    }


    //resetear el password del usuario
    public function pass_reset(){

    }

}