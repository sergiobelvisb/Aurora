<?php

require_once 'Session.inc.php';
/**
 * Class Response
 * 
 * Maneja las respuestas HTTP incluyendo encabezados, códigos de estado y redirecciones.
 */
class Response 
{
    // Propiedades para almacenar los datos de la respuesta
    private Session $session;

    /**
     * Inicializa una nueva instancia de la clase Response.
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * Establece un encabezado HTTP.
     */
    public function setHeader(string $key, string $value): void
    {
        header("$key: $value");
    }

    /**
     * Establece el código de estado HTTP.
     */
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    /**
     * Redirige a una URL específica.
     */
    public function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }

    /**
     * Obtiene la instancia de la sesión.
     */
    public function getSession(): Session
    {
        return $this->session;
    }
}

?>




