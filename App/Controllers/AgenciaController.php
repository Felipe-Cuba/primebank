<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AgenciaDAO;
use App\Models\Entidades\Agencia;
use App\Models\DAO\BancoDAO;

class AgenciaController extends Controller
{
    public function cadastro()
    {
        $bancoDAO = new BancoDAO();

        self::setViewParam('bancos', $bancoDAO->listar());

        $this->render('agencia/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }


    public function salvar()
    {
        $f = $_POST;
        $Agencia = new Agencia();
        $Agencia->setNome($f['nome']);
        $Agencia->setNumero($f['numero']);
        $Agencia->setIdBanco($f['banco']);

        Sessao::recordForm($f);
        $AgenciaDAO = new AgenciaDAO();

        if ($AgenciaDAO->salvar($Agencia)) {
            $this->redirect('/agencia');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }
}