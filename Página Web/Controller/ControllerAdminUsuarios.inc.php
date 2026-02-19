<?php
/**
 * Clase Principal que extiende de Controller.
 * Esta clase maneja la lógica para la página principal.
 * Contiene un método index que muestra un mensaje de bienvenida.
 */
class AdminUsuarios extends Controller
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

        $usuarios = $modelo->listadoUsuarios();

        $data = [
            'usuarios' => $usuarios
        ];

        $viewUsuario = new Layout('AdminUsuarios', $data);
    }

    public function Usuario(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        $id = $this->http->getRequest()->getGet('id');
        $username = $modelo->getUsername($id);
        $acl = $modelo->getACl($id);

        $data = [
            'id' => $id,
            'nombre' => $username,
            'acl' => $acl
        ];

        $viewUsuario = new Layout('Usuario', $data);
    }
}

?>