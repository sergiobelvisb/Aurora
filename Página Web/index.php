<?php
/**
 * Archivo de entrada principal del framework MVC.
 * Este archivo se encarga de cargar los componentes esenciales del framework,
 * determinar el controlador por defecto y ejecutar la lógica correspondiente.
 */
require_once 'Core/HTTPComponent.inc.php';
require_once 'Core/Controller.inc.php';
require_once 'Core/View.inc.php';
require_once 'Core/Model.inc.php';
require_once 'Core/LoadModel.inc.php';

// Instanciar el componente HTTP. Se encarga de manejar las solicitudes y respuestas HTTP.
$http = new HTTPComponent();

// Determinar el controlador por defecto basado en el parámetro GET 'controller'.
if(isset($http->getRequest()->getGet()['controller']) && !empty($http->getRequest()->getGet()))
    $controller = $http->getRequest()->getGet('controller');
// Si no se especifica ningún controlador, usar 'Login' por defecto
else $controller = 'Principal';

// Incluir el archivo del controlador correspondiente.
if(file_exists('Controller/Controller' . $controller . '.inc.php'))
    require_once 'Controller/Controller' . $controller . '.inc.php';
// Si el archivo no existe, mostrar un mensaje de error.
else {
    $viewError = new Layout('Error');
    die();
}

// Instanciar el controlador por defecto.
$instance = new $controller();
?>