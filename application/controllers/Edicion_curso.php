<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edicion_curso extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('edicion_curso_model');
    }

    public function index() {

        //pagination settings
        $config['base_url'] = base_url('edicion_curso/index');
        $config['total_rows'] = $this->edicion_curso_model->count_rows();
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

        $result = $this->edicion_curso_model->get_ediciones_curso($config["per_page"], $data['page']);
        $data['ediciones_curso'] = $result;

        $data['pagination'] = $this->pagination->create_links();

        //Cargar menu, view y footer
        $this->load->view('menu', array('title' => 'Edición Curso'));
        $this->load->view('edicion_curso/edicion_curso_view',$data);
        $this->load->view('footer');
    }

    function update($id){
        $data['id'] = $id;

        //obtener registro de institucion
        $data['institucion'] = $this->base->get('institucion', array('id' => $id))[0];

        //set validation rules
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|numeric');
        $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
        $this->form_validation->set_rules('direccion', 'Dirección', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            //fail validation
            $this->load->view('menu', array('title' => 'Modificar Institución'));
            $this->load->view('institucion/institucion_update_view', $data);
            $this->load->view('footer');

        }else{
            //pass validation
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'telefono' => $this->input->post('telefono'),
                'correo' => $this->input->post('correo'),
                'direccion' => $this->input->post('direccion'),
            );

            //update employee record
            $this->base->update('institucion', array('id' => $id), $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Institución actualizada exitosamente</div>');

            redirect('institucion');
        }
    }

    function add() {
        //Obtener datos para las listas
        $data['cursos'] = $this->edicion_curso_model->get_cursos();
        $data['instituciones'] = $this->edicion_curso_model->get_instituciones();

        //set validation rules
        $this->form_validation->set_rules('lugar', 'Lugar', 'trim|required');
        $this->form_validation->set_rules('curso', 'Curso', 'callback_verificar_seleccion');
        $this->form_validation->set_rules('institucion', 'Institucion', 'callback_verificar_seleccion');

        if ($this->form_validation->run() == FALSE) {
            //fail validation
            $this->load->view('menu', array('title' => 'Nueva Edición Curso'));
            $this->load->view('edicion_curso/edicion_curso_insert_view');
            $this->load->view('footer');

        } else {
            //pass validation
            $data = array(
                'fecha_inicial' => $this->input->post('fecha_inicial'),
                'fecha_final' => $this->input->post('fecha_final'),
                'curso_id' => $this->input->post('curso'),
                'lugar' => $this->input->post('lugar'),
                'institucion_id' => $this->input->post('institucion')
            );

            //insert the form data into database
            $this->edicion_curso_model->add($data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Edición de Curso registrada exitosamente</div>');

            redirect('edicion_curso');
        }
    }

    function verificar_seleccion($str) {
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

    public function delete($id) {

        $this->base->delete('institucion', array('id' => $id));
        redirect('institucion');
    }
}