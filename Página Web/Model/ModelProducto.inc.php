<?php

class ModelProducto extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function listadoProductos(){
        return $this->query("SELECT * FROM productos");
    }

    public function listadoCategorias(){
        $res = $this->query("SELECT DISTINCT categoria FROM productos");
        return array_column($res, 'categoria');
    }

}

?>