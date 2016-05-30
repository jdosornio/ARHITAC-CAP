<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institucion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('base');
    }

    public function index() {

        //pagination settings
        $config['base_url'] = base_url('institucion/index');
        $config['total_rows'] = $this->base->count_rows('institucion');
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

        $result = $this->base->paginate('institucion', $config["per_page"], $data['page']);
        $data['instituciones'] = $result;

        $data['pagination'] = $this->pagination->create_links();

        //Cargar menu, view y footer
        $this->load->view('menu', array('title' => 'Institución'));
        $this->load->view('institucion/institucion_view',$data);
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

        //set validation rules
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|numeric');
        $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
        $this->form_validation->set_rules('direccion', 'Dirección', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            //fail validation
            $this->load->view('menu', array('title' => 'Nueva Institución'));
            $this->load->view('institucion/institucion_insert_view');
            $this->load->view('footer');

        } else {
            //pass validation
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'telefono' => $this->input->post('telefono'),
                'correo' => $this->input->post('correo'),
                'direccion' => $this->input->post('direccion'),
            );

            //insert the form data into database
            $this->base->add('institucion', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Institución registrada exitosamente</div>');

            redirect('institucion');
        }
    }

    public function delete($id) {

        $this->base->delete('institucion', array('id' => $id));
        redirect('institucion');
    }
}