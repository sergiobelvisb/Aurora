<?php

require_once 'Request.inc.php';
require_once 'Response.inc.php';

/**
 * Summary of HTTPComponent
 * Maneja las solicitudes y respuestas HTTP.
 * Proporciona acceso a los objetos Request y Response.
 * También incluye un método para obtener la URL base del servidor.
 */
class HTTPComponent 
{
    // Propiedades de la clase
    protected $request;
    protected $response;
    
    /**
     * Constructor de la clase HTTPComponent.
     * Crea instancias de Request y Response.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    /**
     * Obtiene el objeto Request.
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Obtiene el objeto Response.
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * Obtiene la URL base del servidor.
     */
    public function getUrlBase(): string {
        // Protocolo (HTTP o HTTPS)
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";       
        // Nombre del servidor
        $host = $_SERVER['HTTP_HOST'];
        // Ruta del script actual
        $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
        // Construir la URL base
        $baseUrl = $protocol . $host . $scriptPath;
        // Eliminar cualquier '/index.php' o similar al final de la ruta.
        $baseUrl = rtrim($baseUrl, '/index.php');
    
        return $baseUrl;
    }
}

?>




