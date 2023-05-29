<?php

namespace App\Controllers;

use App\Models\DAO\AgenciaDAO;
use App\Models\DAO\UsuarioDAO;
use App\Lib\Sessao;
use App\Models\DAO\ContaDAO;
use App\Models\Entidades\Conta;
use App\Models\Validacao\ContaValidador;

class ContaController extends Controller
{
    public function index()
    {
        $usuarioDAO = new UsuarioDAO();
        $contaDAO = new ContaDAO();
        $agenciaDAO = new AgenciaDAO();

        self::setViewParam('listaUsuarios', $usuarioDAO->listar());
        self::setViewParam('listaAgencias', $agenciaDAO->listar());
        self::setViewParam('listaContas', $contaDAO->listar());

        $this->render('/conta/index');

        Sessao::clearMessage();
    }
    public function cadastro()
    {
        $agenciaDAO = new AgenciaDAO();
        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('agencias', $agenciaDAO->listar());
        self::setViewParam('usuarios', $usuarioDAO->listar());

        $this->render('conta/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }

    public function salvar()
    {
        $f = $_POST;
        $Conta = new Conta();
        $Conta->setNumero($f['numero']);
        $Conta->setSaldo($f['saldo']);
        $Conta->setTipoConta($f['tipo_conta']);
        $Conta->setIdAgencia($f['id_agencia']);
        $Conta->setUsuario($f['id_usuario']);

        Sessao::recordForm($f);
        $ContaDAO = new ContaDAO();

        if ($ContaDAO->salvar($Conta)) {
            $this->redirect('/conta');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }

    }

    public function edicao($params)
    {
        $id = $params[0];

        $contaDAO = new ContaDAO();
        $agenciaDAO = new AgenciaDAO();
        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('agencias', $agenciaDAO->listar());
        self::setViewParam('usuarios', $usuarioDAO->listar());


        $conta = $contaDAO->buscaId($id);

        if (!$conta) {
            Sessao::recordMessage("Conta Inexistente!");
            $this->redirect('/conta');
        }

        self::setViewParam('conta', $conta);

        $this->render('/conta/editar');

        Sessao::clearMessage();
    }

    public function atualizar()
    {
        $f = $_POST;
        print_r($f);
        $conta = new Conta();
        $conta->setId($f['id']);
        $conta->setIdAgencia($f['id_agencia']);
        $conta->setNumero($f['numero']);
        $conta->setSaldo($f['saldo']);
        $conta->setTipoConta($f['tipo_conta']);
        $conta->setUsuario($f['id_usuario']);

        Sessao::recordForm($f);

        $contaValidador = new ContaValidador();
        $resultadoValidacao = $contaValidador->validar($conta);

        if ($resultadoValidacao->getErros()) {
            Sessao::recordError($resultadoValidacao->getErros());
            $this->redirect('/conta/edicao/' . $f['id']);
        }

        $contaDAO = new ContaDAO();

        $contaDAO->atualizar($conta);

        Sessao::clearForm();
        Sessao::clearMessage();
        Sessao::clearError();

        $this->redirect('/conta');
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $contaDAO = new ContaDAO();

        $conta = $contaDAO->buscaId($id);

        if (!$conta) {
            Sessao::recordMessage("Conta Inexistente");
            $this->redirect('/conta');
        }

        self::setViewParam('conta', $conta);

        $this->render('/conta/exclusao');

        Sessao::clearMessage();
    }

    public function excluir()
    {
        $f = $_POST;
        $conta = new Conta();
        $conta->setId($f['id']);

        $contaDAO = new ContaDAO();

        if (!$contaDAO->excluir($conta)) {
            Sessao::recordMessage('Conta Inexistente!');
            $this->redirect('/conta');
        }

        Sessao::recordMessage('Conta excluida com sucesso!');
        $this->redirect('/conta');
    }
}