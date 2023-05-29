<?php

namespace App\Controllers;

use App\Models\DAO\AgenciaDAO;
use App\Models\DAO\UsuarioDAO;
use App\Lib\Sessao;
use App\Models\DAO\ContaDAO;
use App\Models\Entidades\Conta;

class ContaController extends Controller
{
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
}