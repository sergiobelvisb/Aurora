<?php
/**
 * Clase Principal que extiende de Controller.
 * Esta clase maneja la lógica para la página principal.
 * Contiene un método index que muestra un mensaje de bienvenida.
 */
class Login extends Controller
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
    public function index($param_data = [])
    {
        $http = new HTTPComponent();

        $data = [
            'extraCSS' => "<link rel='stylesheet' href='" . $this->http->getUrlBase() . "/public/css/login.css'>",
            'error' => ""
        ];

        if($param_data !== ""){
            $data['error'] = $param_data;
        }

        $viewUsuario = new Layout('Login', $data);
    }

    public function comprobarSesion(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        if ($this->http->getRequest()->getServer("REQUEST_METHOD") === "POST") {
            $email = $this->http->getRequest()->getPost('email');
            $password = $this->http->getRequest()->getPost('password');            

            if($modelo->comprobarUsuario($email, $password)){
                $id = $modelo->getID($email);
                $acl = $modelo->getACL($id);

                $this->http->getResponse()->getSession()->set("id", $id);
                $this->http->getResponse()->getSession()->set("email", $email);
                $this->http->getResponse()->getSession()->set("acl", $acl);
                
                if($acl == "Administrador"){
                    $this->http->getResponse()->redirect($this->http->getUrlBase()."/Principal");
                } else {
                    $this->http->getResponse()->redirect($this->http->getUrlBase()."/Principal"); // Cambiar según sea el usuario Administrador o no
                }
                exit;
            } else {
                $data = [
                    'error' => 'Credenciales Inválidas. Inténtalo de nuevo.'
                ];
                $this->index($data['error']);
            }
        }
    }
}

?>