<?php

class Registro extends Controller
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
    public function index($param_data = ""){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        $data = [
            'extraCSS' => "<link rel='stylesheet' href='" . $this->http->getUrlBase() . "/public/css/registro.css'>",
            'hospitales' => $modelo->getHospitales(),
            'error' => ""
        ];

        if($param_data !== ""){
            $data['error'] = $param_data;
        }

        $viewUsuario = new Layout('Registro', $data);
    }

    public function registrarUsuario(){

        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        if ($this->http->getRequest()->getServer("REQUEST_METHOD") === "POST") {

            $username  = $this->http->getRequest()->getPost('username');
            $nombre    = $this->http->getRequest()->getPost('nombre');
            $apellidos = $this->http->getRequest()->getPost('apellidos');
            $email     = $this->http->getRequest()->getPost('email');
            $password  = $this->http->getRequest()->getPost('password');
            $password2 = $this->http->getRequest()->getPost('password2');
            $hospital  = $this->http->getRequest()->getPost('hospital');

            $nombre = $nombre . " " . $apellidos;


            /* VALIDACIONES */

            if(empty($username) || empty($nombre) || empty($email) || empty($password) || empty($hospital)){
                $this->index("Todos los campos obligatorios deben rellenarse.");
                return;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $this->index("El correo electrónico no es válido.");
                return;
            }

            if($password !== $password2){
                $this->index("Las contraseñas no coinciden.");
                return;
            }

            if($modelo->existeEmail($email)){
                $this->index("Ya existe una cuenta con ese correo.");
                return;
            }

            if($modelo->existeUsername($username)){
                $this->index("Ese nombre de usuario ya está en uso.");
                return;
            }


            /* REGISTRO */

            $res = $modelo->registrarUsuario(
                $username,
                $nombre,
                $email,
                $password,
                $hospital
            );

            if($res){
                $this->http->getResponse()->redirect($this->http->getUrlBase()."/Login");
                exit;
            } else {
                $this->index("Error al registrar el usuario.");
            }
        }
    }
}

?>