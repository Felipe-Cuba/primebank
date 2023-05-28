<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\ContaDAO;
use App\Models\Entidades\Conta;

class ContaController extends Controller{
    public function cadastro()
    {
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

        Sessao::recordForm($f);
        $ContaDAO = new ContaDAO();

        if ($ContaDAO->salvar($Conta)) {
            $this->redirect('/conta');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }

} 
} 