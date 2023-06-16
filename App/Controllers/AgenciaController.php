<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AgenciaDAO;
use App\Models\Entidades\Agencia;
use App\Models\DAO\BancoDAO;
use App\Models\Validacao\AgenciaValidador;

class AgenciaController extends Controller
{

    public function index()
    {
        $agenciaDAO = new AgenciaDAO();
        $bancoDAO = new BancoDAO();

        self::setViewParam('listaAgencias', $agenciaDAO->listar());
        self::setViewParam('listaBancos', $bancoDAO->listar());

        $this->render('/agencia/index');

        Sessao::clearMessage();
    }
    public function registro()
    {
        $bancoDAO = new BancoDAO();

        self::setViewParam('bancos', $bancoDAO->listar());

        $this->render('agencia/registro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }


    public function salvar()
    {
        $f = $_POST;
        $Agencia = new Agencia();
        $Agencia->setNome($f['nome']);
        $Agencia->setNumero($f['numero']);
        $Agencia->setIdBanco($f['banco']);

        Sessao::recordForm($f);
        $AgenciaDAO = new AgenciaDAO();

        if ($AgenciaDAO->salvar($Agencia)) {
            $this->redirect('/agencia');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }

    public function edicao($params)
    {
        $id = $params[0];

        $agenciaDAO = new AgenciaDAO();
        $bancoDAO = new BancoDAO();

        $agencia = $agenciaDAO->buscaId($id);

        if (!$agencia) {
            Sessao::recordMessage("agencia inexistente");
            $this->redirect('/agencia');
        }

        self::setViewParam('agencia', $agencia);

        $bancos = $bancoDAO->listar();
        self::setViewParam('bancos', $bancos);

        $this->render('/agencia/editar');

        Sessao::clearMessage();
    }

    public function atualizar()
    {
        $f = $_POST;
        $agencia = new Agencia();
        $agencia->setId($f['id']);
        $agencia->setNome($f['nome']);
        $agencia->setNumero($f['numero']);
        $agencia->setIdBanco($f['id_banco']);

        Sessao::recordForm($_POST);

        $agenciaValidador = new AgenciaValidador();
        $resultadoValidacao = $agenciaValidador->validar($agencia);

        if ($resultadoValidacao->getErros()) {
            Sessao::recordError($resultadoValidacao->getErros());
            $this->redirect('/agencia/edicao/' . $f['id']);
        }

        $ususarioDAO = new AgenciaDAO();

        $ususarioDAO->atualizar($agencia);

        Sessao::clearForm();
        Sessao::clearMessage();
        Sessao::clearError();

        $this->redirect('/agencia');

    }

    public function exclusao($params)
    {
        $id = $params[0];

        $agenciaDAO = new AgenciaDAO();

        $agencia = $agenciaDAO->buscaId($id);

        if (!$agencia) {
            Sessao::recordMessage("Agencia Inexistente");
            $this->redirect('/agencia');
        }

        self::setViewParam('agencia', $agencia);

        $this->render('/agencia/exclusao');

        Sessao::clearMessage();
    }

    public function excluir()
    {
        $f = $_POST;
        $agencia = new Agencia();
        $agencia->setId($f['id']);

        $agenciaDAO = new AgenciaDAO();

        if (!$agenciaDAO->excluir($agencia)) {
            Sessao::recordMessage('Agencia Inexistente!');
            $this->redirect('/agencia');
        }

        Sessao::recordMessage('Agencia excluida com sucesso!');
        $this->redirect('/agencia');
    }
}