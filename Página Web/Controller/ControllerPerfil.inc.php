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
            'hospitales' => $modelo->getHospitales(),
            'userData' => [
                'id' => $id,
                'username' => $modelo->getUsername($id),
                'nombreCompleto' => $modelo->getNombreCompleto($id),
                'email' => $modelo->getEmail($id),
                'hospital' => $modelo->getHospital($id),
                'image' => $modelo->getImage($id),
                'acl' => $modelo->getACL($id)
            ],
            'camposEditables' => [
                'nombreCompleto' => ['label' => 'Nombre completo', 'type' => 'text', 'action' => '/Perfil/cambiarNombre'],
                'email' => ['label' => 'Email', 'type' => 'email', 'action' => '/Perfil/cambiarEmail'],
                'hospital' => ['label' => 'Hospital', 'type' => 'text', 'action' => '/Perfil/cambiarHospital'],
                'password' => ['label' => 'Contraseña', 'type' => 'password', 'action' => '/Perfil/cambiarPassword']
            ]
        ];

        $viewUsuario = new Layout('Perfil', $data);
    }

    public function cambiarFoto(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();
        $id = $this->http->getResponse()->getSession()->get('id');
        $foto = $this->http->getRequest()->getFiles('Foto');

        if($modelo->cambiarFoto($id, $foto)){
            $this->http->getResponse()->redirect($this->http->getUrlBase()."/Perfil");
            return;
        } else {
            $this->index("Error al cambiar la foto de perfil.");
        }
    }

    public function cambiarNombre(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();
        $id = $this->http->getResponse()->getSession()->get('id');
        $nombre = $this->http->getRequest()->getPost('nombreCompleto');

        if($modelo->cambiarNombre($id, $nombre)){
            $this->http->getResponse()->redirect($this->http->getUrlBase()."/Perfil");
            return;
        } else {
            $this->index("Error al cambiar el nombre.");
        }
    }

    public function cambiarEmail(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();
        $id = $this->http->getResponse()->getSession()->get('id');
        $email = $this->http->getRequest()->getPost('email');

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->index("El correo electrónico no es válido.");
            return;
        }

        if($modelo->cambiarEmail($id, $email)){
            $this->http->getResponse()->redirect($this->http->getUrlBase()."/Perfil");
            return;
        } else {
            $this->index("Error al cambiar el correo electrónico.");
        }
    }

    public function cambiarHospital(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        $id = $this->http->getResponse()->getSession()->get('id');
        $hospitalID = $this->http->getRequest()->getPost('hospitalID');

        if($modelo->cambiarHospital($id, $hospitalID)){
            $this->http->getResponse()->redirect($this->http->getUrlBase()."/Perfil");
            return;
        } else {
            $this->index("Error al cambiar el hospital.");
        }
    }

    public function cambiarPassword(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        $id = $this->http->getResponse()->getSession()->get('id');
        $current = $this->http->getRequest()->getPost('current_password');
        $new = $this->http->getRequest()->getPost('new_password');
        $repeat = $this->http->getRequest()->getPost('repeat_password');

        if($new !== $repeat){
            $this->index("La nueva contraseña y la repetición no coinciden.");
            return;
        }

        if($modelo->cambiarPassword($id, $current, $new)){
            $this->http->getResponse()->redirect($this->http->getUrlBase()."/Perfil");
            return;
        } else {
            $this->index("Contraseña actual incorrecta.");
        }
    }

}

?>