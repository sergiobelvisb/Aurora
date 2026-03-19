<?php

class Principal extends Controller
{
    /**
     * Constructor de la clase.
     * Llama al constructor de la clase padre.
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Método index que muestra un mensaje de bienvenida.
     */
    public function index()
    {
        $data = [
            'extraCSS' => "<link rel='stylesheet' href='public/css/principal.css'>"
        ];

        $viewUsuario = new Layout('Principal', $data);
    }
}

?>