<?php

namespace App;

use App\Controllers\HomeController;
use App\Lib\Autenticacao;
use Exception;

class App
{
    private $controller;
    private $controllerFile;
    private $action;
    private $params;

    private array $userPermissions;
    private array $userPublicRoutes;

    private string $appHost;

    public $controllerName;

    public function __construct()
    {
        /*
         * Constantes do sistema
         */
        $this->appHost = "/primebank";

        define('APP_HOST', $_SERVER['HTTP_HOST'] . $this->appHost);
        define('PATH', realpath('./'));
        define('TITLE', "PrimeBank");
        define('DB_HOST', "localhost");
        define('DB_USER', "root");
        define('DB_PASSWORD', "");
        define('DB_NAME', "primebank");
        define('DB_DRIVER', "mysql");

        define('TIPOS_CONTA', [
            1 => 'Conta Corrente',
            2 => 'Conta Poupança',
            3 => 'Conta Investimento'
        ]);

        define('TIPOS_TRANSACAO', [
            1 => 'Saque',
            2 => 'Depósito',
            3 => 'Pagamento'
        ]);

        define('TIPOS_USUARIO', [
            1 => 'Administrador',
            2 => 'Cliente'
        ]);

        $this->loadPermissions();
        $this->loadPublicRoutes();

        $this->url();
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function run()
    {
        if ($this->controller) {
            $this->controllerName = ucwords($this->controller) . 'Controller';
            $this->controllerName = preg_replace('/[^a-zA-Z]/i', '', $this->controllerName);
        } else {
            $this->controllerName = "HomeController";
        }

        $this->controllerFile = $this->controllerName . '.php';
        $this->action = preg_replace('/[^a-zA-Z]/i', '', $this->action);

        if (!$this->controller) {
            $this->controller = new HomeController($this);
            $this->controller->index();
        }

        if (!file_exists(PATH . '/App/Controllers/' . $this->controllerFile)) {
            throw new Exception("Página não encontrada.", 404);
        }

        $nomeClasse = "\\App\\Controllers\\" . $this->controllerName;
        $objetoController = new $nomeClasse($this);

        if (!class_exists($nomeClasse)) {
            throw new Exception("Erro na aplicação", 500);
        }

        $this->checkAuthenticationAndPermission();

        if (method_exists($objetoController, $this->action)) {
            $objetoController->{$this->action}($this->params);
            return;
        } else if (!$this->action && method_exists($objetoController, 'index')) {
            $objetoController->index($this->params);
            return;
        } else {
            throw new Exception("Página não encontrada", 404);
        }
    }

    public function url()
    {

        if (isset($_GET['url'])) {

            $path = $_GET['url'];
            $path = rtrim($path, '/');
            $path = filter_var($path, FILTER_SANITIZE_URL);

            $path = explode('/', $path);

            $this->controller = $this->verificaArray($path, 0);
            $this->action = $this->formatActionName($this->verificaArray($path, 1));

            if ($this->verificaArray($path, 2)) {
                unset($path[0]);
                unset($path[1]);

                $this->params = array_values($path);
            }
        }
    }

    private function loadPermissions()
    {
        $this->userPermissions = [
            'registro' => 'Administrador',
            'editar' => 'Administrador',
            'exclusao' => 'Administrador',
            'index' => 'Administrador',
            'perfil' => 'Cliente',
            'alterar-senha' => 'Cliente',
            'alterar-documento' => 'Cliente',
            'alterar-email' => 'Cliente'
        ];
    }

    private function loadPublicRoutes()
    {
        $this->userPublicRoutes = [
            'cadastro',
            'login'
        ];
    }

    private function verificaArray($array, $key)
    {
        if (isset($array[$key]) && !empty($array[$key])) {
            return $array[$key];
        }
        return null;
    }

    private function formatActionName($action)
    {
        $parts = explode('-', $action);
        $formattedAction = '';

        foreach ($parts as $part) {
            $formattedAction .= ucfirst($part);
        }

        return lcfirst($formattedAction);
    }

    private function checkAuthenticationAndPermission()
    {
        $route = !isset($this->action) || $this->action === '' ? 'index' : $this->action;


        if ($this->controller === 'usuarios') {

            if (in_array($route, $this->userPublicRoutes)) {
                if (Autenticacao::isAuthenticated()) {
                    header("Location: {$this->appHost}"); // Redirecionar para a página de boas-vindas
                    exit;
                }
                return;
            }

            if (isset($this->userPermissions[$route])) {
                $requiredPermission = $this->userPermissions[$route];
                Autenticacao::checkPermission($requiredPermission);
            }

        }
    }
}