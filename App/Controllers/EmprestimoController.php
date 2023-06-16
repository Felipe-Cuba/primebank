<?php

namespace App\Controllers;

use App\Models\DAO\ContaDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\EmprestimoDAO;
use App\Models\Entidades\Emprestimo;
use App\Models\Validacao\EmprestimoValidador;

class EmprestimoController extends Controller
{

    public function index()
    {
        $exmprestimoDAO = new EmprestimoDAO();
        $contaDAO = new ContaDAO();

        self::setViewParam('listaEmprestimos', $exmprestimoDAO->listar());
        self::setViewParam('listaContas', $contaDAO->listar());

        $this->render('/emprestimo/index');

        Sessao::clearMessage();
    }
    // public function registro()
    // {
    //     $this->render('emprestimo/registro');

    //     Sessao::clearForm();
    //     Sessao::clearError();
    //     Sessao::clearMessage();
    // }
    // public function salvar()
    // {
    //     /*
    //    Esse trecho de código está pegando o primeiro usuário da tabela para criar um emprestimo com a conta dele
    //    pois no exato momento ainda não há controle de sessão no sistema.

    //    ELE SERÁ RETIRADO NA VERSÃO FINAL DO PROJETO
    //    */
    //     $usuarioDAO = new UsuarioDAO();
    //     $usuarios = $usuarioDAO->listar();

    //     if (!count($usuarios)) {
    //         Sessao::recordMessage('Não existem usuários cadastrados!');
    //         $this->redirect('/emprestimo/registro');
    //     }

    //     $conditions = [
    //         'id_usuario' => $usuarios[0]->getId()
    //     ];

    //     $contaDAO = new ContaDAO();

    //     $contas = $contaDAO->buscar($conditions);

    //     if (!count($contas)) {
    //         Sessao::recordMessage('Não existem contas cadastradas para esse usuário cadastrados!');
    //         $this->redirect('/emprestimo/registro');
    //     }
    //     //  Fim do trecho para buscar uma conta para realizar o cadastro!
    //     $conta = $contas[0];
    //     $f = $_POST;
    //     $Emprestimo = new Emprestimo();
    //     $Emprestimo->setValor($f['valor']);
    //     $Emprestimo->setTaxa($f['taxa']);
    //     $Emprestimo->setParcelas($f['parcelas']);
    //     $Emprestimo->setParcelasPagas($f['parcelasPagas']);
    //     $Emprestimo->setIdConta($conta->getId());

    //     Sessao::recordForm($f);
    //     $EmprestimoDAO = new EmprestimoDAO();
    //     if ($EmprestimoDAO->salvar($Emprestimo)) {
    //         $this->redirect('/emprestimo');
    //     } else {
    //         Sessao::recordMessage('Ocorreu um erro!');
    //     }
    // }

    // public function edicao($params)
    // {
    //     $id = $params[0];

    //     $emprestimoDAO = new EmprestimoDAO();

    //     $emprestimo = $emprestimoDAO->buscaId($id);

    //     if (!$emprestimo) {
    //         Sessao::recordMessage("Emprestimo Inexistente!");
    //         $this->redirect('/emprestimo');
    //     }

    //     self::setViewParam('emprestimo', $emprestimo);

    //     $this->render('/emprestimo/editar');

    //     Sessao::clearMessage();
    // }

    // public function atualizar()
    // {
    //     $f = $_POST;
    //     print_r($f);
    //     $emprestimo = new Emprestimo();
    //     $emprestimo->setId($f['id']);
    //     $emprestimo->setIdConta($f['id_conta']);
    //     $emprestimo->setTaxa($f['taxa']);
    //     $emprestimo->setParcelas($f['parcelas']);
    //     $emprestimo->setParcelasPagas($f['parcelas_pagas']);
    //     $emprestimo->setValor($f['valor']);

    //     Sessao::recordForm($f);

    //     $emprestimoValidador = new EmprestimoValidador();
    //     $resultadoValidacao = $emprestimoValidador->validar($emprestimo);

    //     if ($resultadoValidacao->getErros()) {
    //         Sessao::recordError($resultadoValidacao->getErros());
    //         $this->redirect('/emprestimo/edicao/' . $f['id']);
    //     }

    //     $emprestimoDAO = new EmprestimoDAO();

    //     $emprestimoDAO->atualizar($emprestimo);

    //     Sessao::clearForm();
    //     Sessao::clearMessage();
    //     Sessao::clearError();

    //     $this->redirect('/emprestimo');
    // }

    // public function exclusao($params)
    // {
    //     $id = $params[0];

    //     $emprestimoDAO = new EmprestimoDAO();

    //     $emprestimo = $emprestimoDAO->buscaId($id);

    //     $contaDAO = new ContaDAO();
    //     self::setViewParam('listaContas', $contaDAO->listar());

    //     if (!$emprestimo) {
    //         Sessao::recordMessage("Emprestimo Inexistente!");
    //         $this->redirect('/emprestimo');
    //     }

    //     self::setViewParam('emprestimo', $emprestimo);

    //     $this->render('/emprestimo/exclusao');

    //     Sessao::clearMessage();
    // }

    // public function excluir()
    // {
    //     $f = $_POST;
    //     $emprestimo = new Emprestimo();
    //     $emprestimo->setId($f['id']);

    //     $emprestimoDAO = new EmprestimoDAO();

    //     if (!$emprestimoDAO->excluir($emprestimo)) {
    //         Sessao::recordMessage('Emprestimo Inexistente!');
    //         $this->redirect('/emprestimo');
    //     }

    //     Sessao::recordMessage('Emprestimo excluido com sucesso!');
    //     $this->redirect('/emprestimo');
    // }
}