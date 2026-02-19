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
        $usuario = $this->http->getResponse()->getSession()->get('usuario');
        $acl = $this->http->getResponse()->getSession()->get('acl');
        $fotodeperfil = $this->http->getUrlBase() .  $modelo->getImage($id);

        $data = [
            'id' => $id,
            'usuario' => $usuario,
            'acl' => $acl,
            'fotodeperfil' => $fotodeperfil
        ];

        $viewUsuario = new Layout('Perfil', $data);
    }

    public function ConfPerfil(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        $id = $this->http->getResponse()->getSession()->get('id');
        $usuario = $modelo->getUsername($id);
        $acl = $modelo->getACL($id);
        $fotodeperfil = $this->http->getUrlBase() .  $modelo->getImage($id);
        $admin = false;

        if($acl === "admin"){
            $admin = true;
        }

        $data = [
            'id' => $id,
            'usuario' => $usuario,
            'acl' => $acl,
            'fotodeperfil' => $fotodeperfil,
            'admin' => $admin
        ];

        $viewUsuario = new Layout('ConfPerfil', $data);
    }

    public function ActualizarPerfil(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();
        $id = $this->http->getResponse()->getSession()->get('id');
        $usuario = $this->http->getResponse()->getSession()->get('usuario');
        $nuevoNombre = $usuario . ".jpg";

        if ($this->http->getRequest()->getServer("REQUEST_METHOD") === "POST") {
            if($this->http->getRequest()->getFiles() !== 0){
                move_uploaded_file($this->http->getRequest()->getFiles("foto_perfil")["tmp_name"], "public/img/pfp/" . $nuevoNombre);
                $modelo->setImagen($id, $nuevoNombre);
            }

            if($this->http->getRequest()->getPost('username') !== 0){
                $nombre = $this->http->getRequest()->getPost('username');
                $modelo->setUsername($id, $usuario, $nombre);
            }
            
            $this->http->getResponse()->redirect($this->http->getUrlBase()."/Perfil");
        }
    }

}

?>