<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\EmprestimoDAO;
use App\Models\Entidades\Emprestimo;

class EmprestimoController extends Controller{
    public function cadastro()
    {
        $this->render('emprestimo/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }
    public function salvar()
    {
        $f = $_POST;
        $Emprestimo = new Emprestimo();
        $Emprestimo->setValor($f['valor']);
        $Emprestimo->setTaxa($f['taxa']);
        $Emprestimo->setParcelas($f['parcelas']);
        $Emprestimo->setParcelasPagas($f['parcelasPagas']);

        Sessao::recordForm($f);
        $EmprestimoDAO = new EmprestimoDAO();
        if ($EmprestimoDAO->salvar($Emprestimo)) {
            $this->redirect('/emprestimo');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }
} 