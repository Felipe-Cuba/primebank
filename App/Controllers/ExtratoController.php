<?php

namespace App\Controllers;

use App\Models\DAO\ContaDAO;
use App\Models\DAO\UsuarioDAO;
use App\Lib\Sessao;
use App\Models\DAO\ExtratoDAO;
use App\Models\Entidades\Extrato;

class ExtratoController extends Controller
{
    public function cadastro()
    {
        $this->render('extrato/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }


    public function salvar()
    {
        /* 
        Esse trecho de código está pegando o primeiro usuário da tabela para criar um extrato com a conta dele
        pois no exato momento ainda não há controle de sessão no sistema.

        ELE SERÁ RETIRADO NA VERSÃO FINAL DO PROJETO
        */
        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->listar();

        if (!count($usuarios)) {
            Sessao::recordMessage('Não existem usuários cadastrados!');
            $this->redirect('/extrato/cadastro');
        }

        $conditions = [
            'id_usuario' => $usuarios[0]->getId()
        ];

        $contaDAO = new ContaDAO();

        $contas = $contaDAO->buscar($conditions);

        if (!count($contas)) {
            Sessao::recordMessage('Não existem contas cadastradas para esse usuário cadastrados!');
            $this->redirect('/extrato/cadastro');
        }
        //  Fim do trecho para buscar uma conta para realizar o cadastro!

        $conta = $contas[0];

        $f = $_POST;
        $Extrato = new Extrato();
        $Extrato->setValor($f['valor']);
        $Extrato->setAcao($f['acao']);
        $Extrato->setIdConta($conta->getId());

        if ($Extrato->getAcao() === "deposito") {
            $conta->setSaldo($conta->getSaldo() + $Extrato->getValor());
            $contaDAO->atualizar($conta);
        }

        if ($Extrato->getAcao() === "saque" || $Extrato->getAcao() === "pagamento") {
            if ($conta->getSaldo() < $Extrato->getValor()) {
                Sessao::recordMessage('Saldo insuficiente ');
                $this->redirect('/extrato/cadastro');
            } else {
                $conta->setSaldo($conta->getSaldo() - $Extrato->getValor());
                $contaDAO->atualizar($conta);
            }
        }

        Sessao::recordForm($f);
        $ExtratoDAO = new ExtratoDAO();
        if ($ExtratoDAO->salvar($Extrato)) {
            $this->redirect('/extrato');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }
}