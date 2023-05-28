<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\AgenciaDAO;
use App\Models\Entidades\Agencia;

class AgenciaController extends Controller{
    public function cadastro()
    {
        $this->render('agencia/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }


public function salvar()
{
    $f = $_POST;
    $Agencia = new Agencia();
    $Agencia ->setNome($f['nome']);

    Sessao::recordForm($f);
    $AgenciaDAO = new AgenciaDAO();

    if ($AgenciaDAO->salvar($Agencia)) {
        $this->redirect('/agencia');
    } else {
        Sessao::recordMessage('Ocorreu um erro!');
    }
}
}