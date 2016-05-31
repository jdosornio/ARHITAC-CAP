<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departamento extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('base');
    }

    public function index() {

        //pagination settings
        $config['base_url'] = base_url('departamento/index');
        $config['total_rows'] = $this->base->count_rows('departamento');
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

        $result = $this->base->paginate('departamento', $config["per_page"], $data['page']);
        $data['departamentos'] = $result;

        $data['pagination'] = $this->pagination->create_links();

        //Cargar menu, view y footer
        $this->load->view('menu', array('title' => 'departamento'));
        $this->load->view('departamento/departamento_view',$data);
        $this->load->view('footer');
    }

    function update($id){
        $data['id'] = $id;

        //obtener registro de departamento
        $data['departamento'] = $this->base->get('departamento', array('id' => $id))[0];

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            //fail validation
            $this->load->view('menu', array('title' => 'Modificar departamento'));
            $this->load->view('departamento/departamento_update_view', $data);
            $this->load->view('footer');

        }else{
            //pass validation
            $data = array(
                'nombre' => $this->input->post('nombre')
            );

            //update employee record
            $this->base->update('departamento', array('id' => $id), $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in text-center"><a href="#" class="close" data-dismiss="alert">&times;</a>Departamento modificado exitosamente!</div>');

            redirect('departamento');
        }
    }

    function add() {

        //set validation rules
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            //fail validation
            $this->load->view('menu', array('title' => 'Nuevo departamento'));
            $this->load->view('departamento/departamento_insert_view');
            $this->load->view('footer');

        } else {
            //pass validation
            $data = array(
                'nombre' => $this->input->post('nombre')
            );

            //insert the form data into database
            $this->base->add('departamento', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in text-center"><a href="#" class="close" data-dismiss="alert">&times;</a>Departamento registrado exitosamente!</div>');

            redirect('departamento');
        }
    }

    public function delete($id){

        if ( $this->base->get('empleado', array('departamento_id' => $id)) ) {
            //Si existen relaciones no eliminar
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in text-center"><a href="#" class="close" data-dismiss="alert">&times;</a>El departamento a eliminar tiene empleados registrados!</div>');
        } else {
            $this->base->delete('departamento', array('id' => $id));
        }

        redirect('departamento');
    }
}