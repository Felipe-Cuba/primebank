<?php

namespace App\Controllers;

use App\Models\DAO\AgenciaDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\DAO\ContaDAO;
use App\Models\DAO\ExtratoDAO;
use App\Lib\Sessao;
use App\Models\Entidades\Conta;
use App\Models\Entidades\Extrato;
use App\Models\Validacao\ContaValidador;
use Exception;

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
    public function registro()
    {
        $agenciaDAO = new AgenciaDAO();
        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('agencias', $agenciaDAO->listar());
        self::setViewParam('usuarios', $usuarioDAO->listar());

        $this->render('conta/registro');

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

    public function transacao($params)
    {
        $tipo = $params[0];

        $id = Sessao::get('usuario_id');

        $contaDAO = new ContaDAO();

        $conta = $contaDAO->buscarPorUsuario($id);

        self::setViewParam('tipo_transacao', TIPOS_TRANSACAO[$tipo]);
        self::setViewParam('saldo_conta', $conta->getSaldo());
        self::setViewParam('saldo_conta_formatado', $conta->getSaldoFormatado());

        $this->render('/conta/transacao');

        Sessao::clearForm();
    }

    public function checkIn()
    {
        $f = $_POST;

        $tipoTrasacao = $f['tipo_trasacao'];
        $valor = $f['valor'];

        $id = Sessao::get('usuario_id');

        $contaDAO = new ContaDAO();
        $conta = $contaDAO->buscarPorUsuario($id);

        $saldo = $conta->getSaldo();

        $key = array_search($tipoTrasacao, TIPOS_TRANSACAO);

        if ($key !== false) {
            if ($key !== 2) {
                $isSufficient = $saldo >= $valor;

                if (!$isSufficient) {
                    throw new Exception('Saldo insuficiente', 400);
                }

                $conta->setSaldo($saldo - $valor);
            } else {
                $conta->setSaldo($saldo + $valor);
            }

            $extrato = new Extrato();
            $extrato->setAcao($tipoTrasacao);
            $extrato->setValor($valor);
            $extrato->setIdConta($conta->getId());

            $extratoDAO = new ExtratoDAO();

            if ($extratoDAO->salvar($extrato) && $contaDAO->atualizar($conta)) {
                $this->redirect('/usuarios/perfil');
            } else {
                throw new Exception('Erro interno do servidor', 500);
            }
        } else {
            throw new Exception('Tipo de transação inválida', 400);
        }
    }

}