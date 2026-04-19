<?php
/**
 * Clase Principal que extiende de Controller.
 * Esta clase maneja la lógica para la página principal.
 * Contiene un método index que muestra un mensaje de bienvenida.
 */
class PanelControl extends Controller
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
    public function index(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();
        $id = $this->http->getResponse()->getSession()->get('id');

        $data = [
            'extraCSS' => "<link rel='stylesheet' href='public/css/panelControl.css'>",
            'pacientes' => $modelo->getPacientesbyMedico($id),
            'extraJS' => "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>"
        ];

        $viewUsuario = new Layout('PanelControl', $data);
    }

    public function registrarPaciente(){
        loadModel::load('Usuario');
        $modelo = new ModelUsuario();

        $nombre = $this->http->getRequest()->getPost('nombre');
        $apellidos = $this->http->getRequest()->getPost('apellidos');
        $edad = $this->http->getRequest()->getPost('edad');
        $dni = $this->http->getRequest()->getPost('dni');
        $tel = $this->http->getRequest()->getPost('telefono');
        $fecha = $this->http->getRequest()->getPost('fecha');
        $medicoID = $this->http->getResponse()->getSession()->get('id');

        $nombre = $nombre . " " . $apellidos;

        $modelo->registrarPaciente($nombre, $edad, $dni, $tel, $fecha, $medicoID);
    }

}

?>