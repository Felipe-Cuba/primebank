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

    private array $adminRoutes;
    private array $userPublicRoutes;

    private array $permissions;

    private string $appHost;

    private string $currentPage;

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

        define('PAGINAS', [
            1 => 'usuarios',
            2 => 'investimento',
            3 => 'extrato',
            4 => 'home',
            5 => 'emprestimo',
            6 => 'conta',
            7 => 'agencia',
            8 => 'banco'
        ]);

        define('TIPOS_INVESTIMENTO', [
            1 => 'Fundo Imobiliário',
            2 => 'Tesouro Direto',
            3 => 'Renda Variável',
            4 => 'Renda Fixa'
        ]);

        define('TIPOS_PAGAMENTO', [
            1 => 'Saldo primebank',
            2 => 'Cartão de crédito'
        ]);

        $this->loadPermissions();
        $this->loadPublicRoutes();
        $this->loadAdminRoutes();

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
        try {
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
                $this->controller->loadIndex();
            }

            $controllerFilePath = PATH . '/App/Controllers/' . $this->controllerFile;

            if (!file_exists($controllerFilePath)) {
                throw new Exception("Página não encontrada.", 404);
            }

            $nomeClasse = "\\App\\Controllers\\" . $this->controllerName;

            if (!class_exists($nomeClasse)) {
                throw new Exception("Erro na aplicação", 500);
            }

            $objetoController = new $nomeClasse($this);
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
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $errorMessage = $e->getMessage();

            throw new Exception($errorMessage, $statusCode);
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

            if (!$this->controller) {
                $this->controller = 'home';
            }

            $key = array_search($this->controller, PAGINAS);

            if ($key === false) {
                throw new Exception('Pagina não existe', 404);
            }

            $this->currentPage = PAGINAS[$key];

            if ($this->verificaArray($path, 2)) {
                unset($path[0]);
                unset($path[1]);

                $this->params = array_values($path);
            }
        } else {
            Autenticacao::redirectToHome();
        }
    }


    private function loadPermissions()
    {
        $userPermissions = [
            'perfil' => 'Cliente',
            'alterar-senha' => 'Cliente',
            'alterar-documento' => 'Cliente',
            'alterar-email' => 'Cliente'
        ];

        $investimentPermissions = [
            'cadastroInvestimento' => 'Cliente',
            'salvar' => 'Cliente',
            'listaInvestimento' => 'Cliente',
        ];

        $loanPermissions = [
            'cadastroEmprestimo' => 'Cliente',
            'salvar' => 'Cliente',
            'listaEmprestimo' => 'Cliente',
            'pagarParcela' => 'Cliente',
        ];

        $accountPermissions = [
            'transacao' => 'Cliente',
        ];

        $extractPermissions = [
            'extratoConta' => 'Cliente',
        ];

        $this->permissions = [
            PAGINAS[1] => $userPermissions,
            PAGINAS[2] => $investimentPermissions,
            PAGINAS[3] => $extractPermissions,
            PAGINAS[5] => $loanPermissions,
            PAGINAS[6] => $accountPermissions
        ];
    }

    private function loadPublicRoutes()
    {
        $this->userPublicRoutes = [
            'cadastro',
            'login',
            'autenticar',
            'cadastrar'
        ];


    }

    private function loadAdminRoutes()
    {
        $this->adminRoutes = [
            'registro',
            'editar',
            'exclusao',
            'index'
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

        if (in_array($route, $this->userPublicRoutes)) {
            if (Autenticacao::isAuthenticated()) {
                header("Location: {$this->appHost}"); // Redirecionar para a página de boas-vindas
                exit;
            }
            return;
        }

        if ($this->currentPage !== PAGINAS[4]) {

            if (!Autenticacao::isAuthenticated()) {

                Autenticacao::redirectToLogin();


            } else {

                if (in_array($route, $this->adminRoutes)) {
                    Autenticacao::checkPermission(TIPOS_USUARIO[1]);
                } else {
                    if (isset($this->permissions[$this->currentPage][$route])) {
                        $requiredPermission = $this->permissions[$this->currentPage][$route];
                        Autenticacao::checkPermission($requiredPermission);
                    }
                }
            }
        }
    }
}