<?php
/**
 * Clase Principal que extiende de Controller.
 * Esta clase maneja la lógica para la página principal.
 * Contiene un método index que muestra un mensaje de bienvenida.
 */
class Perfil extends Controller
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
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();
        $id = $this->http->getResponse()->getSession()->get('id');

        $data = [
            'extraCSS' => "<link rel='stylesheet' href='public/css/perfil.css'>",
            'userData' => [
                'id' => $id,
                'username' => $modelo->getUsername($id),
                'nombreCompleto' => $modelo->getNombreCompleto($id),
                'email' => $modelo->getEmail($id),
                'hospital' => $modelo->getHospital($id),
                'acl' => $modelo->getACL($id)
            ]
        ];

        $viewUsuario = new Layout('Perfil', $data);
    }

}

?>