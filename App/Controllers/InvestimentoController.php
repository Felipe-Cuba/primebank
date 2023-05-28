<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\InvestimentoDAO;
use App\Models\Entidades\Investimento;

class InvestimentoController  extends Controller{
    public function cadastro()
    {
        $this->render('investimento/cadastro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }
    public function salvar()
    {
        $f = $_POST;
        $Investimento = new Investimento(); 
        $Investimento->setTipoInvestimento($f['TipoInvestimento']);
        $Investimento->setValor($f['valor']);
        $Investimento->setTaxa($f['taxa']);

        
        Sessao::recordForm($f);
        $InvestimentoDAO = new InvestimentoDAO();
        if ($InvestimentoDAO->salvar($Investimento)) {
            $this->redirect('/investimento');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }
} 

