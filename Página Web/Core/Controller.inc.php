<?php

/**
 * Clase base para los controladores del framework.
 * Esta clase maneja la lógica para invocar métodos basados en parámetros de la URL.
 */
class Controller
{
    /**
     * Constructor de la clase.
     * Verifica si hay una acción especificada en los parámetros GET
     * y llama al método correspondiente si existe.
     * Si no se especifica ninguna acción, llama al método 'index' por defecto.
     * Si el método no existe, muestra un mensaje de error.
     */
    public function __construct()
    {
        $this->http = new HTTPComponent();
        // Verificar si se ha especificado una acción en los parámetros GET
        if(isset($this->http->getRequest()->getGet()['action']) && !empty($this->http->getRequest()->getGet('action')))
            $action = $this->http->getRequest()->getGet('action');
        // Si no se especifica ninguna acción, usar 'index' por defecto
        else $action = "index";

        // Verificar si el método existe en la clase actual    
        if(method_exists($this, $action)) $this->$action();
        // Si el método no existe, mostrar un mensaje de error
        else $this->notFound();        
    }

    /**
     * Método que se llama cuando la acción no se encuentra.
     * Muestra un mensaje de error indicando que la acción no existe.
     */
    public function notFound():void
    {
        $viewError = new View('Error');
        die();
    }
}
?>


