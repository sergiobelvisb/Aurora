<?php
/**
 * Maneja las operaciones de sesión en PHP.
 */
class Session 
{
    /**
     * Inicializa la sesión si no está ya iniciada.
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    /**
     * Establece un valor en la sesión.
     */
    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Obtiene un valor de la sesión.
     */
    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Obtiene todos los valores de la sesión.
     */
    public function getAll(): array
    {
        return $_SESSION;
    }
    /**
     * Elimina un valor de la sesión.
     */
    public function unset(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destruye la sesión actual.
     */
    public function destroy(): void
    {
        session_unset();
        session_destroy();
    }

    /**
     * Verifica si una clave existe en la sesión.
     */
   public function exists(string $key): bool
   {
       return isset($_SESSION[$key]);
   }

    /**
     * Regenera el ID de la sesión.
     */
   public function regenerateId(bool $deleteOldSession = false): void
   {
       session_regenerate_id($deleteOldSession);
   }

    /**
     * Obtiene el ID de la sesión actual.
     */
   public function id(): string
   {
       return session_id();
   }
}

?>



