<?php

namespace App\Controllers;


use App\Lib\Sessao;
use App\Models\DAO\BancoDAO;
use App\Models\Entidades\Banco;
use App\Models\Validacao\BancoValidador;

class BancoController extends Controller
{
    public function index()
    {
        $BancoDAO = new BancoDAO();

        self::setViewParam('listaBancos', $BancoDAO->listar());

        $this->render('/banco/index');

        Sessao::clearMessage();
    }
    public function cadastro()
    {
        $this->render('banco/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }

    public function salvar()
    {
        $f = $_POST;
        $Banco = new Banco();
        $Banco->setNome($f['nome']);
        $Banco->setNumero($f['numero']);

        Sessao::recordForm($f);
        $BancoDAO = new BancoDAO();

        if ($BancoDAO->salvar($Banco)) {
            $this->redirect('/banco');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }

    }

    public function edicao($params)
    {
        $id = $params[0];

        $bancoDAO = new BancoDAO();

        $banco = $bancoDAO->buscaId($id);

        if (!$banco) {
            Sessao::recordMessage("banco inexistente");
            $this->redirect('/banco');
        }

        self::setViewParam('banco', $banco);

        $this->render('/banco/editar');

        Sessao::clearMessage();
    }

    public function atualizar()
    {
        $f = $_POST;
        $banco = new Banco();
        $banco->setId($f['id']);
        $banco->setNome($f['nome']);
        $banco->setNumero($f['numero']);

        Sessao::recordForm($_POST);

        $bancoValidador = new BancoValidador();
        $resultadoValidacao = $bancoValidador->validar($banco);

        if ($resultadoValidacao->getErros()) {
            Sessao::recordError($resultadoValidacao->getErros());
            $this->redirect('/banco/edicao/' . $f['id']);
        }

        $ususarioDAO = new BancoDAO();

        $ususarioDAO->atualizar($banco);

        Sessao::clearForm();
        Sessao::clearMessage();
        Sessao::clearError();

        $this->redirect('/banco');

    }

    public function exclusao($params)
    {
        $id = $params[0];

        $bancoDAO = new BancoDAO();

        $banco = $bancoDAO->buscaId($id);

        if (!$banco) {
            Sessao::recordMessage("banco inexistente");
            $this->redirect('/banco');
        }

        self::setViewParam('banco', $banco);

        $this->render('/banco/exclusao');

        Sessao::clearMessage();
    }

    public function excluir()
    {
        $f = $_POST;
        $banco = new Banco();
        $banco->setId($f['id']);

        $bancoDAO = new BancoDAO();

        if (!$bancoDAO->excluir($banco)) {
            Sessao::recordMessage('Usuário Inexistente!');
            $this->redirect('/banco');
        }

        Sessao::recordMessage('Usuário excluido com sucesso!');
        $this->redirect('/banco');
    }
}