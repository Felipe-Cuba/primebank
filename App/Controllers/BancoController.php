<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\BancoDAO;
use App\Models\Entidades\Banco;

class BancoController extends Controller{
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
}