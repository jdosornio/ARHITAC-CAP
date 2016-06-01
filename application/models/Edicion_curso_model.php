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

    function get($arrAttr, $table = 'edicion_curso') {
        return parent::get($table, $arrAttr);
    }

    function add($datos, $tabla = 'edicion_curso') {
        return parent::add($tabla, $datos);
    }

    function update($arrAttr, $datos, $table = '') {
        return parent::update('edicion_curso', $arrAttr, $datos);
    }

    function delete($arrAttr, $table = 'edicion_curso') {
        parent::delete($table, $arrAttr);
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

    function get_empleados($id) {
        $query = $this->db->select("e.numero AS e_num, concat(e.nombre, ' ', e.apellido_paterno, ' ', e.apellido_materno) AS e_nom, p.nombre AS p_nom, d.nombre AS d_nom")
            ->from('empleado AS e')->join('puesto AS p', 'e.puesto_id = p.id')
            ->join('departamento AS d', 'e.departamento_id = d.id')
            ->where("e.numero IN (SELECT empleado_numero FROM edicion_curso_empleado WHERE edicion_curso_id = " . $id . ")")
            ->order_by('e.numero', 'ASC')->get();

        return $query->result();
    }

    function get_empleados_not_in($id) {
        $query = $this->db->select("e.numero AS e_num, concat(e.nombre, ' ', e.apellido_paterno, ' ', e.apellido_materno) AS e_nom, p.nombre AS p_nom, d.nombre AS d_nom")
            ->from('empleado AS e')->join('puesto AS p', 'e.puesto_id = p.id')
            ->join('departamento AS d', 'e.departamento_id = d.id')
            ->where("e.numero NOT IN (SELECT empleado_numero FROM edicion_curso_empleado WHERE edicion_curso_id = " . $id . ")")
            ->order_by('e.numero', 'ASC')->get();

        return $query->result();
    }

}