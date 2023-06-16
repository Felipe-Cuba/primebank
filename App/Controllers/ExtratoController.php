<?php

namespace App\Controllers;

use App\Models\DAO\ContaDAO;
// use App\Models\DAO\UsuarioDAO;
use App\Lib\Sessao;
use App\Models\DAO\ExtratoDAO;
// use App\Models\Entidades\Extrato;
// use App\Models\Validacao\ExtratoValidador;

class ExtratoController extends Controller
{
    public function index()
    {
        $extratoDAO = new ExtratoDAO();
        $contaDAO = new ContaDAO();

        self::setViewParam('listaExtratos', $extratoDAO->listar());
        self::setViewParam('listaContas', $contaDAO->listar());

        $this->render('/extrato/index');

        Sessao::clearMessage();
    }

    public function extratoConta()
    {

        $id = Sessao::get('usuario_id');

        $extratoDAO = new ExtratoDAO();
        $contaDAO = new ContaDAO();

        $conta = $contaDAO->buscarPorUsuario($id);

        $extratos = $extratoDAO->buscar(['id_conta' => $conta->getId()]);



        self::setViewParam('listaExtratos', $extratos);
        self::setViewParam('contaExtrato', $conta);

        $this->render('/extrato/extrato-conta');

        Sessao::clearMessage();
    }

    // public function registro()
    // {
    //     $this->render('extrato/registro');

    //     Sessao::clearForm();
    //     Sessao::clearError();
    //     Sessao::clearMessage();
    // }


    // public function salvar()
    // {
    //     /*
    //     Esse trecho de código está pegando o primeiro usuário da tabela para criar um extrato com a conta dele
    //     pois no exato momento ainda não há controle de sessão no sistema.

    //     ELE SERÁ RETIRADO NA VERSÃO FINAL DO PROJETO
    //     */
    //     $usuarioDAO = new UsuarioDAO();
    //     $usuarios = $usuarioDAO->listar();

    //     if (!count($usuarios)) {
    //         Sessao::recordMessage('Não existem usuários cadastrados!');
    //         $this->redirect('/extrato/registro');
    //     }

    //     $conditions = [
    //         'id_usuario' => $usuarios[0]->getId()
    //     ];

    //     $contaDAO = new ContaDAO();

    //     $contas = $contaDAO->buscar($conditions);

    //     if (!count($contas)) {
    //         Sessao::recordMessage('Não existem contas cadastradas para esse usuário cadastrados!');
    //         $this->redirect('/extrato/registro');
    //     }
    //     //  Fim do trecho para buscar uma conta para realizar o cadastro!

    //     $conta = $contas[0];

    //     $f = $_POST;
    //     $Extrato = new Extrato();
    //     $Extrato->setValor($f['valor']);
    //     $Extrato->setAcao($f['acao']);
    //     $Extrato->setIdConta($conta->getId());

    //     if ($Extrato->getAcao() === "deposito") {
    //         $conta->setSaldo($conta->getSaldo() + $Extrato->getValor());
    //         $contaDAO->atualizar($conta);
    //     }

    //     if ($Extrato->getAcao() === "saque" || $Extrato->getAcao() === "pagamento") {
    //         if ($conta->getSaldo() < $Extrato->getValor()) {
    //             Sessao::recordMessage('Saldo insuficiente ');
    //             $this->redirect('/extrato/registro');
    //         } else {
    //             $conta->setSaldo($conta->getSaldo() - $Extrato->getValor());
    //             $contaDAO->atualizar($conta);
    //         }
    //     }

    //     Sessao::recordForm($f);
    //     $ExtratoDAO = new ExtratoDAO();
    //     if ($ExtratoDAO->salvar($Extrato)) {
    //         $this->redirect('/extrato');
    //     } else {
    //         Sessao::recordMessage('Ocorreu um erro!');
    //     }
    // }

    // public function edicao($params)
    // {
    //     $id = $params[0];

    //     $extratoDAO = new ExtratoDAO();

    //     $extrato = $extratoDAO->buscaId($id);

    //     if (!$extrato) {
    //         Sessao::recordMessage("Extrato inexistente");
    //         $this->redirect('/extrato');
    //     }

    //     self::setViewParam('extrato', $extrato);

    //     $this->render('/extrato/editar');

    //     Sessao::clearMessage();
    // }

    // public function atualizar()
    // {
    //     $f = $_POST;
    //     print_r($f);
    //     $extrato = new Extrato();
    //     $extrato->setId($f['id']);
    //     $extrato->setIdConta($f['id_conta']);
    //     $extrato->setValor($f['valor']);
    //     $extrato->setAcao($f['acao']);


    //     Sessao::recordForm($f);

    //     $extratoValidador = new ExtratoValidador();
    //     $resultadoValidacao = $extratoValidador->validar($extrato);

    //     if ($resultadoValidacao->getErros()) {
    //         Sessao::recordError($resultadoValidacao->getErros());
    //         $this->redirect('/extrato/edicao/' . $f['id']);
    //     }

    //     $investimentoDAO = new ExtratoDAO();

    //     $investimentoDAO->atualizar($extrato);

    //     Sessao::clearForm();
    //     Sessao::clearMessage();
    //     Sessao::clearError();

    //     $this->redirect('/extrato');
    // }
    // public function exclusao($params)
    // {
    //     $id = $params[0];

    //     $extratoDAO = new ExtratoDAO();

    //     $extrato = $extratoDAO->buscaId($id);

    //     $contaDAO = new ContaDAO();
    //     self::setViewParam('listaContas', $contaDAO->listar());

    //     if (!$extrato) {
    //         Sessao::recordMessage("Extrato inexistente!");
    //         $this->redirect('/extrato');
    //     }

    //     self::setViewParam('extrato', $extrato);

    //     $this->render('/extrato/exclusao');

    //     Sessao::clearMessage();
    // }

    // public function excluir()
    // {
    //     $f = $_POST;
    //     $extrato = new Extrato();
    //     $extrato->setId($f['id']);

    //     $extratoDAO = new ExtratoDAO();

    //     if (!$extratoDAO->excluir($extrato)) {
    //         Sessao::recordMessage('Extrato Inexistente!');
    //         $this->redirect('/extrato');
    //     }

    //     Sessao::recordMessage('Extrato excluido com sucesso!');
    //     $this->redirect('/extrato');
    // }
}