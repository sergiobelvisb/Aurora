<?php
require_once 'Core/Layout.inc.php';
/**
 * Clase View que maneja la carga de vistas en el framework MVC.
 * Permite incluir archivos de vista y pasar datos a ellos.
 */
class View
{
    // Propiedades de la clase
    protected $template;
    protected $data = array();

    /**
     * Constructor de la clase View.
     * Verifica si el archivo de vista existe y lo incluye.
     * Si se proporcionan datos, los asigna a la propiedad $data.
     *
     * @param string $template Nombre del archivo de vista (sin extensión).
     * @param mixed $data Datos opcionales para pasar a la vista.
     */
    public function __construct(string $template, mixed $data = null)
    {
        // Instanciar el componente HTTP. Se encarga de manejar las solicitudes y respuestas HTTP.
        $http = new HTTPComponent();
        // Verificar si el archivo de vista existe
        if(file_exists('View/View' . $template . '.inc.php')) {
            // Asignar el nombre del archivo de vista y los datos
            $this->template = $template;
            // Asignar datos si se proporcionan
            if($data != null) {
                $this->data = $data;
            }
            
            // Incluir el archivo de vista
            require_once 'View/View' . $this->template . '.inc.php';
        // Si el archivo no existe, mostrar un mensaje de error
        } else {
            $viewError = new View('Error');
            die();
        }
    }
}
?>


