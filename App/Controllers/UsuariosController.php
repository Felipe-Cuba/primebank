<?php

namespace App\Controllers;

use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Conta;
use App\Models\DAO\AgenciaDAO;
use App\Models\DAO\ContaDAO;
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

    public function perfil()
    {
        $id = Sessao::get('usuario_id');

        $usuarioDAO = new UsuarioDAO();
        $contaDAO = new ContaDAO();

        $usuario = $usuarioDAO->buscaId($id);

        $conta = $contaDAO->buscarPorUsuario($id);



        self::setViewParam('usuario', $usuario);
        self::setViewParam('conta', $conta);

        $this->render('/usuarios/perfil');
        Sessao::clearMessage();
    }

    public function cadastro()
    {
        $agenciaDAO = new AgenciaDAO();
        self::setViewParam('agencias', $agenciaDAO->listar());


        $this->render('/usuarios/cadastro');
        Sessao::clearMessage();
    }

    public function cadastrar()
    {
        $f = $_POST;

        $Usuario = new Usuario();
        $Usuario->setNome($f['nome']);
        $Usuario->setEmail($f['email']);
        $Usuario->setSenha($f['senha']);
        $Usuario->setDataNasc($f['data_nasc']);
        $Usuario->setDocumento($f['documento']);
        $Usuario->setTipo(2);

        Sessao::recordForm($f);

        $usuarioDAO = new UsuarioDAO();

        if ($usuarioDAO->emailExists($f['email'])) {
            Sessao::recordMessage('Email existente!');
            $this->redirect('/usuarios/cadastro');
        }

        $usuarioId = $usuarioDAO->salvar($Usuario);

        if ($usuarioId !== null) {
            $Usuario->setId($usuarioId);

            $ContaDAO = new ContaDAO();

            $Conta = new Conta();

            $Conta->setIdAgencia($f['agencia']);
            $Conta->setTipoConta($f['tipo_conta']);
            $Conta->setSaldo(0);
            $Conta->setUsuario($Usuario->getId());
            $Conta->setNumero($ContaDAO->generateAccountNumber());

            if ($ContaDAO->salvar($Conta)) {
                $this->redirect("usuarios/perfil?id={$Usuario->getId()}");
            } else {
                Sessao::recordMessage('Ocorreu um erro!');
            }
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }


    public function registro()
    {
        $this->render('/usuarios/registro');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }

    public function registrar()
    {
        $f = $_POST;
        $Usuario = new Usuario();
        $Usuario->setNome($f['nome']);
        $Usuario->setEmail($f['email']);
        $Usuario->setSenha($f['senha']);
        $Usuario->setDataNasc($f['data_nasc']);
        $Usuario->setDocumento($f['documento']);
        $Usuario->setTipo($f['tipo_usuario']);

        Sessao::recordForm($f);

        $usuarioDAO = new UsuarioDAO();

        if ($usuarioDAO->emailExists($f['email'])) {
            Sessao::recordMessage('Email existente!');
            $this->redirect('/usuarios/registro');
        }

        if ($usuarioDAO->salvar($Usuario)) {
            $this->redirect('/usuarios');
        } else {
            Sessao::recordMessage('Ocorreu um erro!');
        }
    }

    public function login()
    {
        $this->render('/usuarios/login');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }

    public function logout()
    {
        Sessao::destroy();

        $this->redirect('/home');
    }

    public function autenticar()
    {
        $f = $_POST;

        if (isset($f['documento']) && isset($f['senha'])) {
            $documento = $f['documento'];
            $senha = $f['senha'];

            $usuarioDAO = new UsuarioDAO();

            $usuario = $usuarioDAO->buscarUsuario(['documento' => $documento, 'senha' => $senha]);

            if ($usuario) {
                // Inicia a sessão e armazena o ID do usuário logado
                Sessao::init();
                Sessao::set('usuario_id', $usuario->getId());
                Sessao::set('usuario_nome', $usuario->getNome());
                Sessao::set('usuario_tipo', TIPOS_USUARIO[$usuario->getTipo()]);

                if ($usuario->getTipo() === 2) {
                    $this->redirect('/usuarios/perfil');
                } else {
                    $this->redirect('/home');

                }

                // Redireciona para a página de perfil do usuário
            } else {
                // Caso o login seja inválido, exibe uma mensagem de erro
                Sessao::recordMessage('Email ou senha inválidos!');
                $this->redirect('/usuarios/login');
            }
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
            $this->redirect('/usuarios/edicao/' . $f['id']);
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

    public function alterarSenha($params)
    {
        $this->render('/usuarios/alterar-senha');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }

    public function alterarDocumento($params)
    {
        $this->render('/usuarios/alterar-documento');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }

    public function alterarEmail($params)
    {
        $this->render('/usuarios/alterar-email');

        Sessao::clearForm();
        Sessao::clearError();
        Sessao::clearMessage();
    }

    public function change()
    {
        $id = Sessao::get('usuario_id');

        $usuarioDAO = new UsuarioDAO();

        $usuario = $usuarioDAO->buscaId($id);

        $f = $_POST;

        $currentPassword = $usuario->getSenha();

        if (isset($f['nova_senha']) && isset($f['senha_antiga'])) {
            $senhaAntiga = $f['senha_antiga'];
            $novaSenha = $f['nova_senha'];



            if ($currentPassword === $senhaAntiga) {
                $usuario->setSenha($novaSenha);
            } else {
                $this->redirect('/usuarios/alterar-senha?wrong=true');
            }

        } else if (isset($f['novo_email']) && isset($f['senha'])) {
            $novoEmail = $f['novo_email'];
            $senhaEmail = $f['senha'];


            if ($currentPassword === $senhaEmail) {

                if ($usuarioDAO->emailExists($novoEmail)) {
                    $this->redirect('/usuarios/alterar-email?wrong_email=true');
                } else {
                    $usuario->setEmail($novoEmail);
                }

            } else {
                $this->redirect('/usuarios/alterar-email?wrong=true');
            }

        } else if (isset($f['novo_documento']) && isset($f['senha'])) {
            $novoDocumento = $f['novo_documento'];
            $senhaDocumento = $f['senha'];


            if ($currentPassword === $senhaDocumento) {

                if ($usuarioDAO->documentExists($novoDocumento)) {
                    $this->redirect('/usuarios/alterar-documento?wrong_document=true');
                } else {
                    $usuario->setDocumento($novoDocumento);
                }

            } else {
                $this->redirect('/usuarios/alterar-documento?wrong=true');
            }

        } else {
            Sessao::destroy();
            $this->redirect('/home');
        }

        $usuarioDAO->atualizar($usuario);

        $this->redirect('/usuarios/perfil');
    }
}