<?php
/**
 * Clase Principal que extiende de Controller.
 * Esta clase maneja la lógica para la página principal.
 * Contiene un método index que muestra un mensaje de bienvenida.
 */
class Tienda extends Controller
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
    public function index(){
        loadModel::load('Producto');
        $modeloTienda = new ModelProducto();

        LoadModel::load('Usuario');
        $modeloUsuario = new ModelUsuario();

        $acl = $this->http->getResponse()->getSession()->get('acl');
        $pagina = 1;
        $totalPaginas = 5;
        $productos = $modeloTienda->listadoProductos();
        $categorias = $modeloTienda->listadoCategorias();
        $fotodeperfil = $modeloUsuario->getImage($this->http->getResponse()->getSession()->get('id'));

        $fotodeperfil = $this->http->getUrlBase() . $fotodeperfil;

        $data = [
            'acl' => $acl,
            'pagina' => $pagina,
            'totalPaginas' => $totalPaginas,
            'productos' => $productos,
            'categorias' => $categorias,
            'fotodeperfil' => $fotodeperfil
        ];

        $viewUsuario = new Layout('Tienda', $data);
    }
}

?>