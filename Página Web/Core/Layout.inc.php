<?php
/**
 * Clase Layout que maneja la estructura general de las vistas en el framework MVC.
 * Permite incluir encabezados y pies de página alrededor de las vistas específicas.
 */

class Layout
{
    /**
     * Constructor de la clase Layout.
     * Incluye el encabezado, la vista específica y el pie de página.
     *
     */
    public function __construct(string $view, mixed $data = null)
    {
        // Instanciar el componente HTTP. Se encarga de manejar las solicitudes y respuestas HTTP.
        $http = new HTTPComponent();
        if(file_exists("View/View".$view.".inc.php")){
            if(file_exists("View/Layout/header.inc.php")) require_once "View/Layout/header.inc.php";
            else {
                $viewError = new View('Error');
                die();
            }
            $viewListarUsuarios = new View($view,$data);
            if(file_exists("View/Layout/footer.inc.php")) require_once "View/Layout/footer.inc.php";
            else {
                $viewError = new View('Error');
                die();
            }
        } else {
            $viewError = new View('Error');
            die();
        }
    }
}

?>




