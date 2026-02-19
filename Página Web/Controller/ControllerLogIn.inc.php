<?php
/**
 * Clase Principal que extiende de Controller.
 * Esta clase maneja la lógica para la página principal.
 * Contiene un método index que muestra un mensaje de bienvenida.
 */
class LogIn extends Controller
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
        $viewUsuario = new Layout('LogIn');
    }

    public function Login(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        if ($this->http->getRequest()->getServer("REQUEST_METHOD") === "POST") {
            $username = $this->http->getRequest()->getPost('username');
            $password = $this->http->getRequest()->getPost('password');
            

            if($modelo->comprobarUsuario($username, $password)){
                $id = $modelo->getID($username);
                $acl = $modelo->getACL($id);

                $this->http->getResponse()->getSession()->set("id", $id);
                $this->http->getResponse()->getSession()->set("usuario", $username);
                $this->http->getResponse()->getSession()->set("acl", $acl);
                
                if($acl == "admin"){
                    $this->http->getResponse()->redirect($this->http->getUrlBase()."/VistasAdministrador");
                } else {
                    $this->http->getResponse()->redirect($this->http->getUrlBase()."/Tienda");
                }
                exit;
            } else {
                $data = ['error' => 'Credenciales Inválidas. Inténtalo de nuevo.'];
                $viewLogin = new Layout('LogIn', $data);
            }
        }
    }
}

?>