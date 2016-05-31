<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('empleado_model');
    }
    
    public function index(){
        
        //pagination settings
        $config['base_url'] = base_url('empleado/index');
        $config['total_rows'] = $this->db->count_all('empleado');
        $config['per_page'] = 15;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $result = $this->empleado_model->get_empleados($config["per_page"], $data['page']);           
        $data['empleados'] = $result;

        $data['pagination'] = $this->pagination->create_links();

        //Cargar menu, view y footer
        $this->load->view('menu', array('title' => 'Empleado'));
        $this->load->view('empleado/empleado_view',$data);
        $this->load->view('footer');
    }
    
    function update($numero){
        $data['numero'] = $numero;
        
        //fetch employee record for the given employee no
        $data['empleado'] = $this->empleado_model->get_empleado($numero);
        
        //Obtener datos para las listas
        $data['departamento'] = $this->empleado_model->get_departamento();
        $data['puesto'] = $this->empleado_model->get_puesto();
        
        //set validation rules
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|callback_verificar_letras_espacio');
        $this->form_validation->set_rules('apellido_paterno', 'Apellido paterno', 'trim|required|callback_verificar_letras_espacio');
        $this->form_validation->set_rules('apellido_materno', 'Apellido materno', 'trim|required|callback_verificar_letras_espacio');
        $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
        $this->form_validation->set_rules('departamento', 'Departamento', 'callback_varificar_seleccion');
        $this->form_validation->set_rules('puesto', 'Puesto', 'callback_varificar_seleccion');
        
        if ($this->form_validation->run() == FALSE){
            //fail validation
            $this->load->view('menu', array('title' => 'Modificar Empleado'));
            $this->load->view('empleado/empleado_update_view', $data);
            $this->load->view('footer');

        }else{
            //pass validation
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'apellido_paterno' => $this->input->post('apellido_paterno'),
                'apellido_materno' => $this->input->post('apellido_materno'),
                'correo' => $this->input->post('correo'),
                'departamento_id' => $this->input->post('departamento'),
                'puesto_id' => $this->input->post('puesto')
            );

            //update employee record
            $this->db->where('numero', $numero);
            $this->db->update('empleado', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Empleado actualizado exitosamente</div>');
            redirect('empleado');
        }
    }
    
    function add(){
        //Obtener datos para las listas
        $data['departamento'] = $this->empleado_model->get_departamento();
        $data['puesto'] = $this->empleado_model->get_puesto();
        
        //set validation rules
        $this->form_validation->set_rules('numero', 'Número', 'trim|required|numeric|callback_verificar_existencia');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|callback_verificar_letras_espacio');
        $this->form_validation->set_rules('apellido_paterno', 'Apellido paterno', 'trim|required|callback_verificar_letras_espacio');
        $this->form_validation->set_rules('apellido_materno', 'Apellido materno', 'trim|required|callback_verificar_letras_espacio');
        $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
        $this->form_validation->set_rules('departamento', 'Departamento', 'callback_verificar_seleccion');
        $this->form_validation->set_rules('puesto', 'Puesto', 'callback_verificar_seleccion');
        
        if ($this->form_validation->run() == FALSE){
            //fail validation
            $this->load->view('menu', array('title' => 'Nuevo Empleado'));
            $this->load->view('empleado/empleado_insert_view', $data);
            $this->load->view('footer');

        }else{
            //pass validation
            $data = array(
                'numero' => $this->input->post('numero'),
                'nombre' => $this->input->post('nombre'),
                'apellido_paterno' => $this->input->post('apellido_paterno'),
                'apellido_materno' => $this->input->post('apellido_materno'),
                'correo' => $this->input->post('correo'),
                'departamento_id' => $this->input->post('departamento'),
                'puesto_id' => $this->input->post('puesto')
            );

            //insert the form data into database
            $this->db->insert('empleado', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Empleado registrado exitosamente</div>');
            redirect('empleado');
        }
    }
    
    function verificar_seleccion($str){
        if ($str == '-SELECT-')
        {
            $this->form_validation->set_message('verificar_seleccion', 'Debe seleccionar un %s');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function verificar_letras_espacio($str)
    {
        if (!preg_match("/^([a-zñÑáéíóú ])+$/i", $str))
        {
            $this->form_validation->set_message('verificar_letras_espacio', 'Este campo solo permite letras y espacios');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function verificar_existencia($str){
        if ($this->empleado_model->exists($str))
        {
            $this->form_validation->set_message('verificar_existencia', 'El número de empleado ya existe');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    
    public function delete($numero){
        $this->empleado_model->delete($numero);
    } 
}