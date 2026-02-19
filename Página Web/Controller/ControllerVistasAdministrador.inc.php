<?php
/**
 * Clase Principal que extiende de Controller.
 * Esta clase maneja la lógica para la página principal.
 * Contiene un método index que muestra un mensaje de bienvenida.
 */
class VistasAdministrador extends Controller
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
        $usuario = $this->http->getResponse()->getSession()->get('usuario');
        $data = [
            'usuario' => $usuario
        ];
        $viewUsuario = new Layout('VistasAdministrador', $data);
    }
}

?>