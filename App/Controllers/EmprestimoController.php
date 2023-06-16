<?php

namespace App\Controllers;

use App\Models\DAO\ContaDAO;
use App\Models\DAO\ExtratoDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Extrato;
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
        $extratoDAO = new ExtratoDAO();

        $conta = $contaDAO->buscarPorUsuario($id);

        $emprestimo = $emprestimoDAO->buscaId($id_emprestimo);

        $extrato = new Extrato();

        $f = $_POST;


        $valor = floatval($f['valor_parcela']);
        $tipo_pagamento = $f['tipo_pagamento'];


        $valor_parcela = $emprestimo->getValorParcela();

        $tolerancia = 0.0001;

        $diferença = number_format(abs($valor - $valor_parcela), 10);
        if ($diferença < $tolerancia) {

            if (TIPOS_PAGAMENTO[$tipo_pagamento] === 'Cartão de crédito') {
                $parcelasPagas = $emprestimo->getParcelasPagas();

                $novasParcelas = $parcelasPagas + 1;

                $emprestimo->setParcelasPagas($novasParcelas);
            }

            if (TIPOS_PAGAMENTO[$tipo_pagamento] === 'Saldo primebank') {
                if ($conta->getSaldo() < $valor) {
                    throw new Exception('Saldo insuficiente', 400);
                } else {
                    $conta->setSaldo($conta->getSaldo() - $valor);

                    if (!$contaDAO->atualizar($conta)) {
                        throw new Exception('Erro interno do servidor', 500);
                    }

                    $extrato->setIdConta($conta->getId());
                    $extrato->setValor($valor);
                    $extrato->setAcao(TIPOS_TRANSACAO[3]);

                    if (!$extratoDAO->salvar($extrato)) {
                        throw new Exception('Erro interno do servidor', 500);
                    }

                    $parcelasPagas = $emprestimo->getParcelasPagas();

                    $novasParcelas = $parcelasPagas + 1;

                    $emprestimo->setParcelasPagas($novasParcelas);

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

}