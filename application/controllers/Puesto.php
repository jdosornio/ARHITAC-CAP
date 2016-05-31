<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puesto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('base');
    }

    public function index() {

        //pagination settings
        $config['base_url'] = base_url('puesto/index');
        $config['total_rows'] = $this->base->count_rows('puesto');
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

        $result = $this->base->paginate('puesto', $config["per_page"], $data['page']);
        $data['puestos'] = $result;

        $data['pagination'] = $this->pagination->create_links();

        //Cargar menu, view y footer
        $this->load->view('menu', array('title' => 'Puesto'));
        $this->load->view('puesto/puesto_view',$data);
        $this->load->view('footer');
    }

    function update($id){
        $data['id'] = $id;

        //obtener registro de puesto
        $data['puesto'] = $this->base->get('puesto', array('id' => $id))[0];

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            //fail validation
            $this->load->view('menu', array('title' => 'Modificar puesto'));
            $this->load->view('puesto/puesto_update_view', $data);
            $this->load->view('footer');

        }else{
            //pass validation
            $data = array(
                'nombre' => $this->input->post('nombre')
            );

            //update employee record
            $this->base->update('puesto', array('id' => $id), $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Puesto actualizado exitosamente</div>');

            redirect('puesto');
        }
    }

    function add() {

        //set validation rules
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            //fail validation
            $this->load->view('menu', array('title' => 'Nuevo puesto'));
            $this->load->view('puesto/puesto_insert_view');
            $this->load->view('footer');

        } else {
            //pass validation
            $data = array(
                'nombre' => $this->input->post('nombre')
            );

            //insert the form data into database
            $this->base->add('puesto', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Puesto registrado exitosamente</div>');

            redirect('puesto');
        }
    }

    public function delete($id){

        $this->base->delete('puesto', array('id' => $id));
        redirect('puesto');
    }
}