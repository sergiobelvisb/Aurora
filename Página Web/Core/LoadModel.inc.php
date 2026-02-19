<?php
/**
 * Clase LoadModel que se encarga de cargar modelos dinámicamente en el framework MVC.
 * Permite incluir archivos de modelo y crear instancias de las clases de modelo correspondientes. 
 */
class LoadModel
{
    /**
     * Carga un modelo dado su nombre.
     */
    public static function load(string $modelName): object
    {
        // Construir la ruta del archivo del modelo
        $modelPath = 'Model/Model' . $modelName . '.inc.php';
        // Verificar si el archivo del modelo existe
        if (file_exists($modelPath)) {
            // Incluir el archivo del modelo
            require_once $modelPath;
            // Construir el nombre completo de la clase del modelo
            $fullClassName = 'Model' . $modelName;
            // Verificar si la clase existe y crear una instancia
            if (class_exists($fullClassName)) {
                // Retornar una nueva instancia de la clase del modelo
                return new $fullClassName();
            } else {
                // Si la clase no existe, lanzar una excepción
                throw new Exception("La clase $fullClassName no existe en el archivo $modelPath.");
            }
        } else {
            // Si el archivo del modelo no existe, lanzar una excepción
            throw new Exception("El archivo del modelo $modelPath no fue encontrado.");
        }
    }
}

?>


