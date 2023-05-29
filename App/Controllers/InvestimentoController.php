<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ContaDAO;
use App\Models\DAO\InvestimentoDAO;
use App\Models\Entidades\Investimento;
use App\Models\DAO\UsuarioDAO;

class InvestimentoController extends Controller
{
    public function cadastro()
    {
        $this->render('investimento/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }
    public function salvar()
    {

        /* 
        Esse trecho de código está pegando o primeiro usuário da tabela para criar um investimento com a conta dele
        pois no exato momento ainda não há controle de sessão no sistema.

        ELE SERÁ RETIRADO NA VERSÃO FINAL DO PROJETO
        */
        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->listar();

        if (!count($usuarios)) {
            Sessao::recordMessage('Não existem usuários cadastrados!');
            $this->redirect('/investimento/cadastro');
        }

        $conditions = [
            'id_usuario' => $usuarios[0]->getId()
        ];

        $contaDAO = new ContaDAO();

        $contas = $contaDAO->buscar($conditions);

        if (!count($contas)) {
            Sessao::recordMessage('Não existem contas cadastradas para esse usuário cadastrados!');
            $this->redirect('/investimento/cadastro');
        }

        //  Fim do trecho para buscar uma conta para realizar o cadastro!


        $f = $_POST;
        $Investimento = new Investimento();
        $Investimento->setTipoInvestimento($f['tipo']);
        $Investimento->setValor($f['valor']);
        $Investimento->setTaxa($f['taxa']);
        $Investimento->setIdConta($contas[0]->getId());

        Sessao::recordForm($f);
        $InvestimentoDAO = new InvestimentoDAO();
        if ($InvestimentoDAO->salvar($Investimento)) {
            $this->redirect('/investimento');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }
}