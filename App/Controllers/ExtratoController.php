<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\ExtratoDAO;
use App\Models\Entidades\Extrato;

class ExtratoController extends Controller{
    public function cadastro()
    {
        $this->render('extrato/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }


    public function salvar()
    {
        $f = $_POST;
        $Extrato = new Extrato();
        $Extrato->setValor($f['valor']);
        $Extrato->setAcao($f['Acao']);
        $Extrato->setDataCadastro($f['data']);

        Sessao::recordForm($f);
        $ExtratoDAO = new ExtratoDAO();
        if ($ExtratoDAO->salvar($Extrato)) {
            $this->redirect('/extrato');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }
} 