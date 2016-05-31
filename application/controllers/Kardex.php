<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kardex extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('empleado_model');
        $this->load->library('table');
    }
    
    public function index(){
        $this->load->view('menu', array('title' => 'Kardex'));
        $this->load->view('reportes/kardex_view');
        $this->load->view('footer');
    }
    
    public function generar(){
        $this->form_validation->set_rules('numero', 'Número', 'trim|required|numeric|callback_verificar_existencia');
        
        if ($this->form_validation->run() == FALSE){
            //Cargar menu, view y footer
            $this->load->view('menu', array('title' => 'Kardex'));
            $this->load->view('reportes/kardex_view');
            $this->load->view('footer');
        }else{
            $numero = $this->input->post('numero');
            $data['empleado'] = $this->empleado_model->get_empleado($numero);
            $data['departamento'] = $this->empleado_model->get_departamento();
            $data['puesto'] = $this->empleado_model->get_puesto();
            $data['kardex'] = $this->empleado_model->get_kardex($numero);
            $this->load->view('menu', array('title' => 'Kardex'));
            $this->load->view('reportes/kardex_view');
            $this->load->view('reportes/kardex_generado_view', $data);
            $this->load->view('footer');
        }
    }
    
    function verificar_existencia($str){
        if (!$this->empleado_model->exists($str))
        {
            $this->form_validation->set_message('verificar_existencia', 'El número de empleado no existe');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
}