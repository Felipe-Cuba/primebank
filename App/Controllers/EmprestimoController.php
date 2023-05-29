<?php

namespace App\Controllers;

use App\Models\DAO\ContaDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\EmprestimoDAO;
use App\Models\Entidades\Emprestimo;

class EmprestimoController extends Controller
{
    public function cadastro()
    {
        $this->render('emprestimo/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }
    public function salvar()
    {
        /* 
       Esse trecho de código está pegando o primeiro usuário da tabela para criar um emprestimo com a conta dele
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
        $Emprestimo = new Emprestimo();
        $Emprestimo->setValor($f['valor']);
        $Emprestimo->setTaxa($f['taxa']);
        $Emprestimo->setParcelas($f['parcelas']);
        $Emprestimo->setParcelasPagas($f['parcelasPagas']);
        $Emprestimo->setIdConta($conta->getId());

        Sessao::recordForm($f);
        $EmprestimoDAO = new EmprestimoDAO();
        if ($EmprestimoDAO->salvar($Emprestimo)) {
            $this->redirect('/emprestimo');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }
}