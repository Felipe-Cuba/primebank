<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;

class UsersController extends Controller
{
    public function index()
    {
        $this->render('users/index');
    }


    public function register()
    {
        $this->render('users/register');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }

    public function salvar()
    {
        $f = $_POST;
        $Usuario = new Usuario();
        $Usuario->setNome($f['nome']);
        $Usuario->setEmail($f['email']);
        $Usuario->setSenha($f['senha']);
        $Usuario->setDataNasc($f['data_nasc']);
        $Usuario->setDocumento($f['documento']);
        $Usuario->setTipo(1);

        Sessao::recordForm($f);

        $usuarioDAO = new UsuarioDAO();

        if ($usuarioDAO->emailExists($f['email'])) {
            Sessao::recordMessage('Email existente!');
            $this->redirect('/users/register');
        }

        if ($usuarioDAO->salvar($Usuario)) {
            $this->redirect('/users');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }
}