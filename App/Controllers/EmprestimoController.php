<?php

namespace App\Controllers;

use App\Models\DAO\ContaDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Sessao;
use App\Models\DAO\EmprestimoDAO;
use App\Models\Entidades\Emprestimo;
use App\Models\Validacao\EmprestimoValidador;
use Exception;

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

    public function cadastroEmprestimo()
    {
        $this->render('/emprestimo/cadastro-emprestimo');
        Sessao::clearMessage();
    }

    public function listaEmprestimo()
    {
        $id_usuario = Sessao::get('usuario_id');

        $contaDAO = new ContaDAO();
        $emprestimoDAO = new EmprestimoDAO();

        $conta = $contaDAO->buscarPorUsuario($id_usuario);

        $emprestimos = $emprestimoDAO->buscar(['id_conta' => $conta->getId()]);

        self::setViewParam('contaEmprestimo', $conta);
        self::setViewParam('listaEmprestimos', $emprestimos);

        $this->render('/emprestimo/lista-emprestimo');

        Sessao::clearMessage();
    }

    public function salvar()
    {
        $f = $_POST;
        $id = Sessao::get('usuario_id');


        $contaDAO = new ContaDAO();
        $emprestimoDAO = new EmprestimoDAO();


        $valor = $f['valor'];
        $parcelas = $f['parcelas'];

        $taxa = $this->getTaxa($parcelas);

        $conta = $contaDAO->buscarPorUsuario($id);

        $emprestimo = new Emprestimo();

        $emprestimo->setIdConta($conta->getId());
        $emprestimo->setParcelas($parcelas);
        $emprestimo->setParcelasPagas(0);
        $emprestimo->setTaxa($taxa);
        $emprestimo->setValor($valor);

        if ($emprestimoDAO->salvar($emprestimo)) {
            $this->redirect('/emprestimo/lista-emprestimo');
        } else {

            throw new Exception('Erro interno do servidor', 500);
        }

    }

    public function pagarParcela($params)
    {
        $id_emprestimo = $params[0];
        $id = Sessao::get('usuario_id');

        $contaDAO = new ContaDAO();
        $emprestimoDAO = new EmprestimoDAO();

        $conta = $contaDAO->buscarPorUsuario($id);

        $emprestimo = $emprestimoDAO->buscaId($id_emprestimo);

        self::setViewParam('conta', $conta);
        self::setViewParam('id_emprestimo', $id_emprestimo);
        self::setViewParam('valor_parcela', $emprestimo->getValorParcela());
        self::setViewParam('valor_parcela_formatado', $emprestimo->getValorParcelaFormatado());

        $this->render('/emprestimo/pagar-parcela');

        Sessao::clearMessage();

    }

    public function finalizar($params)
    {
        $id_emprestimo = $params[0];
        $id = Sessao::get('usuario_id');

        $contaDAO = new ContaDAO();
        $emprestimoDAO = new EmprestimoDAO();

        $conta = $contaDAO->buscarPorUsuario($id);

        $emprestimo = $emprestimoDAO->buscaId($id_emprestimo);

        $f = $_POST;

        // print_r($f);

        $valor = floatval($f['valor_parcela']);
        $tipo_pagamento = $f['tipo_pagamento'];


        $valor_parcela = $emprestimo->getValorParcela();

        $tolerancia = 0.0001;

        $diferença = number_format(abs($valor - $valor_parcela), 10);
        if ($diferença < $tolerancia) {

            if (TIPOS_PAGAMENTO[$tipo_pagamento] === 'Cartão de crédito') {
                $emprestimo->setParcelasPagas(1);
            }

            if (TIPOS_PAGAMENTO[$tipo_pagamento] === 'Saldo primebank') {
                if ($conta->getSaldo() < $valor) {
                    throw new Exception('Saldo insuficiente', 400);
                } else {
                    $emprestimo->setParcelasPagas(1);
                    $conta->setSaldo($conta->getSaldo() - $valor);

                    if (!$contaDAO->atualizar($conta)) {
                        throw new Exception('Erro interno do servidor', 500);
                    }
                }

            }



            if ($emprestimoDAO->atualizar($emprestimo)) {
                $this->redirect('/emprestimo/lista-emprestimo');
            } else {
                throw new Exception('Erro interno do servidor', 500);

            }

        } else {
            throw new Exception('valor da parcela alterado indevidamente', 403);
        }


    }

    private function getTaxa(int $key)
    {
        $taxas = [
            1 => 0,
            2 => 1.5,
            3 => 2.5,
            4 => 3.5,
            5 => 4.5,
            6 => 5.5,
            7 => 6.5,
            8 => 7.5,
            9 => 8.5,
            10 => 9.5,
            11 => 10.5,
            12 => 11.5,
        ];


        return $taxas[$key];
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