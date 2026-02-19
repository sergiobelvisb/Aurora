<?php

// Archivo que define la clase base Model para la gestión de la base de datos utilizando PDO.
require_once 'env.inc.php';

/**
 * Clase Model que maneja la conexión a la base de datos utilizando PDO.
 * Proporciona métodos para establecer y cerrar la conexión.
 */
class Model 
{
    // Propiedad para almacenar la conexión PDO
    protected $conn;

    /** Constructor de la clase.
     * Establece la conexión a la base de datos al crear una instancia de la clase.
     */
    public function __construct() {
        $this->conn = $this->getConn();
    }

    /** Destructor de la clase.
     * Cierra la conexión a la base de datos cuando la instancia de la clase es destruida.
     */
    public function __destruct() {
        $this->closeConn($this->conn);
    }

    /** Método para obtener la conexión PDO.
     * Intenta establecer una conexión a la base de datos y maneja cualquier excepción que pueda ocurrir.
     *
     * @return PDO La conexión PDO a la base de datos.
     */
    public function getConn(): PDO{
        try {
            global $host, $userBD, $passBD, $database;
            $conn = new PDO('mysql:host='.$host.';dbname='.$database.'', $userBD, $passBD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (!$conn) {
                throw new PDOException("Conexión fallida a la base de datos.");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $conn;
    }

    /** Método para cerrar la conexión PDO.
     * Intenta cerrar la conexión a la base de datos y maneja cualquier excepción que pueda ocurrir.
     *
     * @param PDO $conn La conexión PDO a cerrar.
     */
    public function closeConn(PDO $conn):void {
        try {
            $conn = null;
        } catch (PDOException $e) {
            echo "Error al cerrar la conexión a la base de datos: ";
        }
    }

    public function query(String $query, array $params = []): mixed {
        $res = null;
        if(str_starts_with(trim(strtolower($query)), 'select')) {
            try{
                $stmt = $this->conn->prepare($query);
                $stmt->execute($params);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
        else {
            try{
                $stmt = $this->conn->prepare($query);
                $stmt->execute($params);
                $res = $stmt; 
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
         return $res;
    }
    
}
?>



