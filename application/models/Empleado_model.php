<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }
    
    function get_departamento(){
        $this->db->select('id');
        $this->db->select('nombre');
        $this->db->from('departamento');
        $query = $this->db->get();
        $result = $query->result();
        
        $id = array('-SELECT-');
        $nombre = array('-SELECT-');
        
        for($i = 0; $i < count($result); $i++){
            array_push($id, $result[$i]->id);
            array_push($nombre, $result[$i]->nombre);
        }
        return $resultado_departamento = array_combine($id, $nombre);
    }
    
    function get_puesto(){
        $this->db->select('id');
        $this->db->select('nombre');
        $this->db->from('puesto');
        $query = $this->db->get();
        $result = $query->result();
        
        $id = array('-SELECT-');
        $nombre = array('-SELECT-');
        
        for($i = 0; $i < count($result); $i++){
            array_push($id, $result[$i]->id);
            array_push($nombre, $result[$i]->nombre);
        }
        return $resultado_puesto = array_combine($id, $nombre);
    }
    
    //fetch employee record by employee no
    function get_empleado($numero)
    {
        $this->db->where('numero', $numero);
        $this->db->from('empleado');
        $query = $this->db->get();
        return $query->result();
    }
    
    //fetch all employee records
    function get_empleados($limit, $start)
    {
        $this->db->select('empleado.*, departamento.nombre as dpto_nombre, puesto.nombre as pto_nombre');
        $this->db->from('empleado');
        $this->db->join('departamento', 'empleado.departamento_id = departamento.id');
        $this->db->join('puesto', 'empleado.puesto_id = puesto.id');
        $this->db->order_by('numero', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_kardex($numero){
        $this->db->select('curso.nombre as cur_nombre, fecha_inicial, fecha_final, institucion.nombre as ins_nombre');
        $this->db->from('empleado');
        $this->db->join('edicion_curso_empleado', 'empleado.numero = edicion_curso_empleado.empleado_numero');
        $this->db->join('edicion_curso', 'edicion_curso.id = edicion_curso_empleado.edicion_curso_id');
        $this->db->join('curso', 'edicion_curso.curso_id = curso.id');
        $this->db->join('institucion', 'edicion_curso.institucion_id = institucion.id');
        $this->db->where('empleado.numero', $numero);
        $this->db->order_by('fecha_inicial', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function delete($numero)
    {
        //delete employee record
        $this->db->where('numero', $numero);
        $this->db->delete('empleado');
        redirect('empleado');
    }
    
    function exists($numero)
    {
        $this->db->where('numero',$numero);
        $query = $this->db->get('empleado');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
}