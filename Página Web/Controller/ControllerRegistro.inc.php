<?php
/**
 * Clase Principal que extiende de Controller.
 * Esta clase maneja la lógica para la página principal.
 * Contiene un método index que muestra un mensaje de bienvenida.
 */
class Registro extends Controller
{
    /**
     * Constructor de la clase.
     * Llama al constructor de la clase padre.
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Método index que muestra un mensaje de bienvenida.
     */
    public function index()
    {
        $data = [
            /*'extraCSS' => "<link rel='stylesheet' href='" . $this->http->getUrlBase() . "/public/css/registro.css'> <br> 
            <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />",*/
            'extraCSS' => "<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'> <br>
                           <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'> <br>
                           <link rel='stylesheet' href='" . $this->http->getUrlBase() . "/public/css/registro.css'>",

            /*'extraJS' => "<script src='" . $this->http->getUrlBase() . "/public/js/registro.js'></script> <br>
            <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script> <br>
            <script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'></script>"*/
            'extraJS' => "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script> <br>
                          <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js'></script> <br>
                          <script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js'></script>",

            'hospitales' => require(__DIR__ . '/../data/hospitales.php')
        ];

        $viewUsuario = new Layout('Registro', $data);
    }
}

?>