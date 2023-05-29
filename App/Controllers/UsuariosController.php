<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\Validacao\UsuarioValidador;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('listaUsuarios', $usuarioDAO->listar());

        $this->render('/usuarios/index');

        Sessao::clearMessage();
    }


    public function cadastro()
    {
        $this->render('/usuarios/cadastro');

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
            $this->redirect('/usuarios/cadastro');
        }

        if ($usuarioDAO->salvar($Usuario)) {
            $this->redirect('/usuarios');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }

    public function edicao($params)
    {
        $id = $params[0];

        $usuarioDAO = new UsuarioDAO();

        $usuario = $usuarioDAO->buscaId($id);

        if (!$usuario) {
            Sessao::recordMessage("Usuario inexistente");
            $this->redirect('/usuarios');
        }

        self::setViewParam('usuario', $usuario);

        $this->render('/usuarios/editar');

        Sessao::clearMessage();
    }

    public function atualizar()
    {
        $f = $_POST;
        $Usuario = new Usuario();
        $Usuario->setId($f['id']);
        $Usuario->setNome($f['nome']);
        $Usuario->setEmail($f['email']);
        $Usuario->setSenha($f['senha']);
        $Usuario->setDataNasc($f['data_nasc']);
        $Usuario->setDocumento($f['documento']);
        $Usuario->setTipo(1);

        Sessao::recordForm($_POST);

        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($Usuario);

        if ($resultadoValidacao->getErros()) {
            Sessao::recordError($resultadoValidacao->getErros());
            $this->redirect('/usuarios/edition/' . $f['id']);
        }

        $ususarioDAO = new UsuarioDAO();

        $ususarioDAO->atualizar($Usuario);

        Sessao::clearForm();
        Sessao::clearMessage();
        Sessao::clearError();

        $this->redirect('/usuarios');

    }

    public function exclusao($params)
    {
        $id = $params[0];

        $usuarioDAO = new UsuarioDAO();

        $usuario = $usuarioDAO->buscaId($id);

        if (!$usuario) {
            Sessao::recordMessage("Usuario inexistente");
            $this->redirect('/usuarios');
        }

        self::setViewParam('usuario', $usuario);

        $this->render('/usuarios/exclusao');

        Sessao::clearMessage();
    }

    public function excluir()
    {
        $f = $_POST;
        $usuario = new Usuario();
        $usuario->setId($f['id']);

        $usuarioDAO = new UsuarioDAO();

        if (!$usuarioDAO->excluir($usuario)) {
            Sessao::recordMessage('Usuário Inexistente!');
            $this->redirect('/usuarios');
        }

        Sessao::recordMessage('Usuário excluido com sucesso!');
        $this->redirect('/usuarios');
    }
}