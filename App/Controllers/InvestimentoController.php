<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ContaDAO;
use App\Models\DAO\InvestimentoDAO;
use App\Models\Entidades\Investimento;
use App\Models\DAO\UsuarioDAO;
use App\Models\Validacao\InvestimentoValidador;
use Exception;

class InvestimentoController extends Controller
{

    public function index()
    {
        $investimentoDAO = new InvestimentoDAO();
        $contaDAO = new ContaDAO();

        self::setViewParam('listaInvestimentos', $investimentoDAO->listar());
        self::setViewParam('listaContas', $contaDAO->listar());

        $this->render('/investimento/index');

        Sessao::clearMessage();
    }

    public function cadastroInvestimento()
    {
        $this->render('/investimento/cadastro-investimento');

        Sessao::clearMessage();
    }

    public function listaInvestimento()
    {
        $id_usuario = Sessao::get('usuario_id');

        $contaDAO = new ContaDAO();
        $investimentoDAO = new InvestimentoDAO();

        $conta = $contaDAO->buscarPorUsuario($id_usuario);

        $investimentos = $investimentoDAO->buscar(['id_conta' => $conta->getId()]);

        self::setViewParam('contaInvestimento', $conta);
        self::setViewParam('listaInvestimentos', $investimentos);

        $this->render('/investimento/lista-investimento');

        Sessao::clearMessage();
    }

    public function salvar()
    {
        $contaDAO = new ContaDAO();
        $investimentoDAO = new InvestimentoDAO();
        $f = $_POST;

        $id_usuario = Sessao::get('usuario_id');

        $valor = $f['valor'];
        $tipo_investimento = $f['tipo_investimento'];

        $taxaJuros = $this->getTaxaJuros();


        $conta = $contaDAO->buscarPorUsuario($id_usuario);

        $valorTaxado = $valor - ($valor * $taxaJuros[$tipo_investimento]);


        $investimento = new Investimento();

        $investimento->setIdConta($conta->getId());
        $investimento->setTaxa($taxaJuros[$tipo_investimento]);
        $investimento->setTipoInvestimento($tipo_investimento);
        $investimento->setValor($valor);
        $investimento->setValorTaxado($valorTaxado);

        if ($investimentoDAO->salvar($investimento)) {
            $this->redirect('/home');
        } else {
            throw new Exception('Erro interno do servidor', 500);
        }

    }

    private function getTaxaJuros()
    {
        $taxaJuros = [
            TIPOS_INVESTIMENTO[1] => 0.05,
            TIPOS_INVESTIMENTO[2] => 0.03,
            TIPOS_INVESTIMENTO[3] => 0.08,
            TIPOS_INVESTIMENTO[4] => 0.02
        ];

        return $taxaJuros;
    }

    // public function registro()
    // {
    //     $this->render('investimento/registro');

    //     Sessao::clearForm();
    //     Sessao::clearError();
    //     Sessao::clearMessage();
    // }
    // public function salvar()
    // {

    //     /*
    //     Esse trecho de código está pegando o primeiro usuário da tabela para criar um investimento com a conta dele
    //     pois no exato momento ainda não há controle de sessão no sistema.

    //     ELE SERÁ RETIRADO NA VERSÃO FINAL DO PROJETO
    //     */
    //     $usuarioDAO = new UsuarioDAO();
    //     $usuarios = $usuarioDAO->listar();

    //     if (!count($usuarios)) {
    //         Sessao::recordMessage('Não existem usuários cadastrados!');
    //         $this->redirect('/investimento/registro');
    //     }

    //     $conditions = [
    //         'id_usuario' => $usuarios[0]->getId()
    //     ];

    //     $contaDAO = new ContaDAO();

    //     $contas = $contaDAO->buscar($conditions);

    //     if (!count($contas)) {
    //         Sessao::recordMessage('Não existem contas cadastradas para esse usuário cadastrados!');
    //         $this->redirect('/investimento/registro');
    //     }

    //     //  Fim do trecho para buscar uma conta para realizar o cadastro!


    //     $f = $_POST;
    //     $Investimento = new Investimento();
    //     $Investimento->setTipoInvestimento($f['tipo']);
    //     $Investimento->setValor($f['valor']);
    //     $Investimento->setTaxa($f['taxa']);
    //     $Investimento->setIdConta($contas[0]->getId());

    //     Sessao::recordForm($f);
    //     $InvestimentoDAO = new InvestimentoDAO();
    //     if ($InvestimentoDAO->salvar($Investimento)) {
    //         $this->redirect('/investimento');
    //     } else {
    //         Sessao::recordMessage('Ocorreu um erro!');
    //     }
    // }

    // public function edicao($params)
    // {
    //     $id = $params[0];

    //     $investimentoDAO = new InvestimentoDAO();

    //     $investimento = $investimentoDAO->buscaId($id);

    //     if (!$investimento) {
    //         Sessao::recordMessage("Investimento inexistente");
    //         $this->redirect('/investimento');
    //     }

    //     self::setViewParam('investimento', $investimento);

    //     $this->render('/investimento/editar');

    //     Sessao::clearMessage();
    // }

    // public function atualizar()
    // {
    //     $f = $_POST;
    //     print_r($f);
    //     $investimento = new Investimento();
    //     $investimento->setId($f['id']);
    //     $investimento->setIdConta($f['id_conta']);
    //     $investimento->setTaxa($f['taxa']);
    //     $investimento->setTipoInvestimento($f['tipo']);
    //     $investimento->setValor($f['valor']);

    //     Sessao::recordForm($f);

    //     $investimentoValidador = new InvestimentoValidador();
    //     $resultadoValidacao = $investimentoValidador->validar($investimento);

    //     if ($resultadoValidacao->getErros()) {
    //         Sessao::recordError($resultadoValidacao->getErros());
    //         $this->redirect('/investimento/edicao/' . $f['id']);
    //     }

    //     $investimentoDAO = new InvestimentoDAO();

    //     $investimentoDAO->atualizar($investimento);

    //     Sessao::clearForm();
    //     Sessao::clearMessage();
    //     Sessao::clearError();

    //     $this->redirect('/investimento');
    // }

    // public function exclusao($params)
    // {
    //     $id = $params[0];

    //     $investimentoDAO = new InvestimentoDAO();

    //     $investimento = $investimentoDAO->buscaId($id);

    //     $contaDAO = new ContaDAO();
    //     self::setViewParam('listaContas', $contaDAO->listar());

    //     if (!$investimento) {
    //         Sessao::recordMessage("Investimento inexistente!");
    //         $this->redirect('/investimento');
    //     }

    //     self::setViewParam('investimento', $investimento);

    //     $this->render('/investimento/exclusao');

    //     Sessao::clearMessage();
    // }

    // public function excluir()
    // {
    //     $f = $_POST;
    //     $investimento = new Investimento();
    //     $investimento->setId($f['id']);

    //     $investimentoDAO = new InvestimentoDAO();

    //     if (!$investimentoDAO->excluir($investimento)) {
    //         Sessao::recordMessage('Investimento Inexistente!');
    //         $this->redirect('/investimento');
    //     }

    //     Sessao::recordMessage('Investimento excluido com sucesso!');
    //     $this->redirect('/investimento');
    // }
}