<?php
class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($param_data = [])
    {
        $data = [
            'extraCSS' => "<link rel='stylesheet' href='" . $this->http->getUrlBase() . "/public/css/login.css'>",
            'error' => '',
            'formData' => []
        ];

        if (!empty($param_data)) {
            if (isset($param_data['error'])) {
                $data['error'] = $param_data['error'];
            }
            if (isset($param_data['formData'])) {
                $data['formData'] = $param_data['formData'];
            }
        }

        $viewUsuario = new Layout('Login', $data);
    }

    public function comprobarSesion()
    {
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        if ($this->http->getRequest()->getServer("REQUEST_METHOD") === "POST") {

            $email = trim($this->http->getRequest()->getPost('email'));
            $password = $this->http->getRequest()->getPost('password');

            $formData = ['email' => $email];

            if (empty($email) || empty($password)) {
                $this->index([
                    'error' => 'Por favor, rellena todos los campos.',
                    'formData' => $formData
                ]);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->index([
                    'error' => 'El correo electrónico no tiene un formato válido.',
                    'formData' => $formData
                ]);
                return;
            }

            if (!$modelo->usuarioExiste($email)) {
                $this->index([
                    'error' => 'El correo no está registrado.',
                    'formData' => $formData
                ]);
                return;
            }

            if (!$modelo->comprobarUsuario($email, $password)) {
                $this->index([
                    'error' => 'La contraseña es incorrecta.',
                    'formData' => $formData
                ]);
                return;
            }

            $id = $modelo->getID($email);
            $acl = $modelo->getACL($id);
            $foto = $modelo->getImage($id);
            $nombreCompleto = $modelo->getNombreCompleto($id);

            $this->http->getResponse()->getSession()->set("id", $id);
            $this->http->getResponse()->getSession()->set("email", $email);
            $this->http->getResponse()->getSession()->set("nombreCompleto", $nombreCompleto);
            $this->http->getResponse()->getSession()->set("foto", $foto);
            $this->http->getResponse()->getSession()->set("acl", $acl);

            $this->http->getResponse()->redirect($this->http->getUrlBase() . "/Principal");
            exit;
        }
    }
}
?>