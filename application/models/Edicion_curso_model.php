<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'Base.php';

class Edicion_curso_model extends Base {
    function __construct() {
        parent::__construct();
    }

    function count_rows($table = '') {
        return parent::count_rows('edicion_curso');
    }

    function get_ediciones_curso($limit, $start) {
        $query = $this->db->select('ec.id, ec.fecha_inicial, ec.fecha_final, c.nombre AS c_nombre, ec.lugar, i.nombre AS i_nombre')
            ->from('edicion_curso AS ec')->join('curso AS c', 'ec.curso_id = c.id')
            ->join('institucion AS i', 'ec.institucion_id = i.id')
            ->order_by('ec.id', 'AS')->limit($limit, $start)->get();

        return $query->result();
    }

    function add($datos, $tabla = '') {
        return parent::add('edicion_curso', $datos);
    }

    function get_cursos() {
        $query = $this->db->select('id, nombre')->get('curso');
        $result = $query->result();

        $ids = array('-SELECT-');
        $nombres = array('-SELECT-');

        for($i = 0; $i < count($result); $i++) {
            array_push($ids, $result[$i]->id);
            array_push($nombres, $result[$i]->nombre);
        }
        return array_combine($ids, $nombres);
    }

    function get_instituciones() {
        $query = $this->db->select('id, nombre')->get('institucion');
        $result = $query->result();

        $ids = array('-SELECT-');
        $nombres = array('-SELECT-');

        for($i = 0; $i < count($result); $i++) {
            array_push($ids, $result[$i]->id);
            array_push($nombres, $result[$i]->nombre);
        }
        return array_combine($ids, $nombres);
    }
//
//    //fetch employee record by employee no
//    function get_empleado($numero)
//    {
//        $this->db->where('numero', $numero);
//        $this->db->from('empleado');
//        $query = $this->db->get();
//        return $query->result();
//    }
//
//    function delete($numero)
//    {
//        //delete employee record
//        $this->db->where('numero', $numero);
//        $this->db->delete('empleado');
//        redirect('empleado');
//    }

}