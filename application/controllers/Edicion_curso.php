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

    function update($id) {
        $data['id'] = $id;

        //obtener registro de edicion curso
        $data['edicion_curso'] = $this->edicion_curso_model->get(array('id' => $id))[0];

        //Obtener datos para las listas
        $data['cursos'] = $this->edicion_curso_model->get_cursos();
        $data['instituciones'] = $this->edicion_curso_model->get_instituciones();

        //set validation rules
        $this->form_validation->set_rules('lugar', 'Lugar', 'trim|required');
        //Validate that fecha_inicio before fecha_fin
        $this->form_validation->set_rules('fecha_inicial', 'Fecha de Inicio', 'required|callback_validar_fecha_edicion');
        $this->form_validation->set_rules('fecha_final', 'Fecha de Terminación', 'required|callback_validar_fechas');
        $this->form_validation->set_rules('curso', 'Curso', 'callback_verificar_seleccion');
        $this->form_validation->set_rules('institucion', 'Institucion', 'callback_verificar_seleccion');

        if ($this->form_validation->run() == FALSE) {
            //Verificar si todavía se puede modificar
            if (strtotime($data['edicion_curso']->fecha_inicial) >= time()) {
                $data['allow_modify'] = true;
            } else {
                $data['allow_modify'] = false;
                $this->session->set_flashdata('msg', '<div class="alert alert-info text-center">No es posible modificar ediciones de curso pasadas</div>');
            }

            //fail validation
            $this->load->view('menu', array('title' => 'Modificar Edición Curso'));
            $this->load->view('edicion_curso/edicion_curso_update_view', $data);
            $this->load->view('footer');

        }else{
            //pass validation
            $data = array(
                'fecha_inicial' => $this->input->post('fecha_inicial'),
                'fecha_final' => $this->input->post('fecha_final'),
                'curso_id' => $this->input->post('curso'),
                'lugar' => $this->input->post('lugar'),
                'institucion_id' => $this->input->post('institucion')
            );

            //update edicion_curso record
            $this->edicion_curso_model->update(array('id' => $id), $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in text-center"><a href="#" class="close" data-dismiss="alert">&times;</a>Edición de Curso modificado exitosamente!</div>');

            redirect('edicion_curso');
        }
    }

    function add() {
        //Obtener datos para las listas
        $data['cursos'] = $this->edicion_curso_model->get_cursos();
        $data['instituciones'] = $this->edicion_curso_model->get_instituciones();

        //set validation rules
        $this->form_validation->set_rules('lugar', 'Lugar', 'trim|required');
        //Validate that fecha_inicio before fecha_fin
        $this->form_validation->set_rules('fecha_inicial', 'Fecha de Inicio', 'required|callback_validar_fecha_edicion');
        $this->form_validation->set_rules('fecha_final', 'Fecha de Terminación', 'required|callback_validar_fechas');
        $this->form_validation->set_rules('curso', 'Curso', 'callback_verificar_seleccion');
        $this->form_validation->set_rules('institucion', 'Institucion', 'callback_verificar_seleccion');

        if ($this->form_validation->run() == FALSE) {
            //fail validation
            $this->load->view('menu', array('title' => 'Nueva Edición Curso'));
            $this->load->view('edicion_curso/edicion_curso_insert_view', $data);
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
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in text-center"><a href="#" class="close" data-dismiss="alert">&times;</a>Edición de Curso registrado exitosamente!</div>');

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

    function validar_fechas() {
        $fecha_inicial = strtotime($this->input->post('fecha_inicial'));
        $fecha_final = strtotime($this->input->post('fecha_final'));

        //Las fechas son válidas sólo si se registran ediciones futuras y además que no esté antes el final que el inicio
        if ($fecha_inicial <= $fecha_final) {
            return TRUE;
        }
        else {
            $this->form_validation->set_message('validar_fechas', 'La fecha de terminación debe ser después de la fecha de inicio');
            return FALSE;
        }
    }

    function validar_fecha_edicion() {
        $fecha_inicial = strtotime($this->input->post('fecha_inicial'));

        //Las fechas son válidas sólo si se registran ediciones futuras y además que no esté antes el final que el inicio
        if ($fecha_inicial >= time()) {
            return TRUE;
        }
        else {
            $this->form_validation->set_message('validar_fecha_edicion', 'Sólo se pueden registrar ediciones de curso futuras');
            return FALSE;
        }
    }

    function delete($id) {

        if ( $this->edicion_curso_model->get(array('edicion_curso_id' => $id), 'edicion_curso_empleado') ) {
            //Si existen relaciones no eliminar
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in text-center"><a href="#" class="close" data-dismiss="alert">&times;</a>La edición del curso a eliminar tiene empleados registrados!</div>');
        } else {
            $this->edicion_curso_model->delete(array('id' => $id));
        }

        redirect('edicion_curso');
    }

    function ver_lista($id) {
        $data['edicion_curso'] = $this->edicion_curso_model->get(array('id' => $id))[0];
        $data['cursos'] = $this->edicion_curso_model->get_cursos();
        $data['instituciones'] = $this->edicion_curso_model->get_instituciones();
        $data['free_emp'] = $this->edicion_curso_model->get_empleados_not_in($id);

        $data['empleados'] = $this->edicion_curso_model->get_empleados($id);

        $this->load->view('menu', array('title' => 'Lista de Asistencia'));
        $this->load->view('edicion_curso/update_lista_view', $data);
        $this->load->view('footer');
    }

    function remover_empleado($ed_id, $emp_num) {
        
        $this->edicion_curso_model->delete(array('edicion_curso_id' => $ed_id, 'empleado_numero' => $emp_num),
            'edicion_curso_empleado');

        redirect('edicion_curso/ver_lista/' . $ed_id);
    }

    function agregar_empleado($ed_id, $emp_num) {

        $this->edicion_curso_model->add(array('edicion_curso_id' => $ed_id, 'empleado_numero' => $emp_num),
            'edicion_curso_empleado');

        redirect('edicion_curso/ver_lista/' . $ed_id);
    }
}