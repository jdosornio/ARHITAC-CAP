<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase: ModeloBase
 * Version: 1.2.0
 *
 * Esta clase es utilizada para proporcionar un CRUD genérico utilizando
 * librerías de CodeIgniter.
 * Para consultas más específicas se puede crear un modelo más específico
 *
 * Autor: Jesús Donaldo Osornio Hernández
 */
class Base extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->db_debug = true;
    }
    /**
     * Este método sirve para obtener los elementos de una tabla que cumplan
     * con un atributo dado
     *
     * @param $tabla El nombre de la tabla donde se hará la consulta
     * @param $arrAttr El arreglo asociativo utilizado para enviar el nombre
     * de los atributos y sus valores para utilizarse como condición para
     * obtener los registros
     * @return mixed Regresa un arreglo de objetos con los datos de cada fila
     * retornada o un arreglo vacío en caso de no existir registros
     */
    public function get($tabla, $arrAttr) {
        //Ejecuta un query que obtiene los elementos que coincidan con el valor
        $query = $this->db->where($arrAttr)->get($tabla);

        return $query->result();
    }

    /**
     * Este método sirve para obtener todos los elementos de una tabla.
     *
     * @param $tabla El nombre de la tabla donde se hará la consulta
     * @param string $attrOrden El nombre del atributo con el que se ordenará
     * la tabla, por defecto es "id"
     *
     * @return mixed Regresa un arreglo de objetos con los datos de cada fila
     * retornada o un arreglo vacío en caso de no existir registros
     */
    public function get_all($tabla, $attrOrden = 'id') {
        //Ejecuta un query que obtiene todos los elementos ordenados ASC
        $query = $this->db->order_by($attrOrden, 'ASC')->get($tabla);

        return $query->result();
    }

    /**
     * Consulta general con paginación
     *
     * @param $table: el nombre de la tabla
     * @param $limit: la cantidad de registros a devolver
     * @param $start: desde que registro se devolverá
     * @param string $orderAttr: El nombre de la columna por la cual se ordenará
     * @return mixed: las filas del query resultante
     */
    public function paginate($table, $limit, $start, $orderAttr = 'id') {
        $query = $this->db->limit($limit, $start)->order_by($orderAttr, 'ASC')->get($table);

        return $query->result();
    }

    /**
     * Este método permite insertar los datos deseados en la tabla especificada
     *
     * @param $tabla El nombre de la tabla donde se insertarán los datos
     * @param $datos El arreglo asociativo o el objeto que contiene los datos a
     * insertar
     * @return el error en caso de existir. (0 es sin errores)
     */
    public function add($tabla, $datos) {
        //Evitar que haya errores, después se utilizará la variable de config
        $this->db->db_debug = false;

        //Ejecuta un query que inserta los datos en la tabla especificada
        $this->db->insert($tabla, $datos);

        $error = $this->db->error();

        //Ver que tipo de error puede ser...
        if(strpos($error['message'],'UNIQUE')) {
            //Error de tipo valor UNIQUE repetido
            return 1;
        }
        else if($error['code'] === 1062) {
            //Error de tipo registro duplicado
            return 2;
        }
        else if(strpos($error['message'], 'foreign')) {
            //Error de tipo llave foránea no existente
            return 3;
        }
        else {
            return $error['message'];
        }

    }

    /**
     * Este método permite actualizar los datos del registro(s) deseado en la
     * tabla especificada
     *
     * @param $tabla El nombre de la tabla donde se actualizarán los datos
     * @param $arrAttr El arreglo asociativo utilizado para enviar el nombre
     * de los atributos y sus valores para utilizarse como condición para
     * actualizar los datos
     * @param $datos El arreglo asociativo o el objeto que contiene los datos
     * modificados para guardarlos
     * @return el error en caso de existir (0 es sin errores)
     */
    public function update($tabla, $arrAttr, $datos) {
        //Evitar que haya errores, después se utilizará la variable de config
        $this->db->db_debug = false;

        $this->db->where($arrAttr)->update($tabla, $datos);

        $error = $this->db->error();

        //Ver que tipo de error puede ser...
        if(strpos($error['message'],'UNIQUE')) {
            //Error de tipo valor UNIQUE repetido
            return 1;
        }
        else if($error['code'] === 1062) {
            //Error de tipo registro duplicado
            return 2;
        }
        else if(strpos($error['message'], 'foreign')) {
            //Error de tipo llave foránea no existente
            return 3;
        }
        else {
            return $error['message'];
        }
    }

    /**
     * Este método elimina el registro(s) deseado de la tabla especificada
     *
     * @param $tabla El nombre de la tabla de donde se borrará el registro
     * @param $arrAttr Un arreglo asociativo conteniendo el nombre del
     * atributo junto con su valor para eliminarlo de la base de datos
     * (normalmente la llave primaria)
     */
    public function delete($tabla, $arrAttr) {
        $this->db->delete($tabla, $arrAttr);
    }

    /**
     * Tiene la misma función que delete. Pero lo hace con múltiples ids y en
     * una misma transacción
     *
     * @param $tabla El nombre de la tabla de donde se borrarán los registros
     * @param $arrIds Un arreglo de arreglo asociativos conteniendo el nombre
     * del atributo con su valor para eliminarlo de la base de datos
     * (normalmente la llave primaria)
     */
    public function multi_delete($tabla, $arrIds) {
        $this->db->trans_begin();
        //Delete all elements
        foreach($arrIds as $idArr) {
            $this->delete($tabla, $idArr);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }

    /**
     * Regresa el total de filas en esta tabla
     *
     * @param $tabla El nombre de la tabla en la que se contarán sus filas
     * @return mixed El total de filas en la tabla
     */
    public function count_rows($tabla) {

        return $this->db->count_all($tabla);
    }
}