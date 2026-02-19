<?php
/**
 * Clase Cookie
 * Maneja las cookies de la solicitud HTTP.
 */
class Cookie 
{
    // Propiedades para almacenar las cookies
    private array $cookies;

    /**
     * Constructor de la clase Cookie
     * Inicializa las cookies con los datos de la solicitud HTTP
     */
    public function __construct()
    {
        $this->cookies = $_COOKIE;
    }

    /**
     * Obtiene un valor específico de una cookie o todas si no se proporciona una clave.
     */
    public function getCookie(string $key): mixed
    {
        return $this->cookies[$key] ?? null;
    }
    
    /**
     * Establece una cookie con una clave, valor y tiempo de expiración.
     * Por defecto, el tiempo es de una hora.
     */
    public function setCookie(string $key,string $val, int $time = 3600): void
    {
        setcookie($key, $val, time() + $time);
    }

    /**
     * Elimina una cookie estableciendo su tiempo de expiración en el pasado.
     */
    public function delCookie(string $key): void
    {
        setcookie($key, "", "-1");
    }

    /**
     * Obtiene todas las cookies como un array asociativo.
     */
    public function getAllCookies(): array
    {
        return $this->cookies;
    }
}

?>






