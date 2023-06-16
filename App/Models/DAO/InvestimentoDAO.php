<?php

namespace App\Models\DAO;

use App\Models\Entidades\Investimento;

class InvestimentoDAO extends BaseDAO
{

    public function __construct()
    {
        parent::__construct('investimento');
    }

    public function salvar(Investimento $investimento): bool
    {
        $data = [
            'id_conta' => $investimento->getIdConta(),
            'tipo_investimento' => $investimento->getTipoInvestimento(),
            'taxa' => $investimento->getTaxa(),
            'valor' => $investimento->getValor(),
            'valor_taxado' => $investimento->getValorTaxado(),
        ];

        return $this->create($data);
    }

    public function atualizar(Investimento $investimento): bool
    {
        $data = [
            'id_conta' => $investimento->getIdConta(),
            'tipo_investimento' => $investimento->getTipoInvestimento(),
            'taxa' => $investimento->getTaxa(),
            'valor' => $investimento->getValor(),
            'valor_taxado' => $investimento->getValorTaxado(),
        ];

        return $this->update($investimento->getId(), $data);
    }

    public function excluir(Investimento $investimento): bool
    {
        return $this->delete($investimento->getId());
    }

    public function listar(): array
    {
        $investimentos = parent::getAll();

        $investimentoObjects = [];
        foreach ($investimentos as $investimento) {
            $investimentoObjects[] = $this->setInvestimento($investimento);
        }

        return $investimentoObjects;
    }

    public function buscaId(int $id): ?Investimento
    {
        $investimento = parent::getById($id);

        if ($investimento) {
            return $this->setInvestimento($investimento[0]);
        }

        return null;
    }

    public function buscar(array $conditions): array
    {
        $investimentos = parent::getWhere($conditions);

        $investimentoObjects = [];
        foreach ($investimentos as $investimento) {
            $investimentoObjects[] = $this->setInvestimento($investimento);
        }

        return $investimentoObjects;
    }

    private function setInvestimento(array $investimentoData): Investimento
    {
        $investimento = new Investimento();
        $investimento->setId($investimentoData['id']);
        $investimento->setIdConta($investimentoData['id_conta']);
        $investimento->setTipoInvestimento($investimentoData['tipo_investimento']);
        $investimento->setTaxa($investimentoData['taxa']);
        $investimento->setValor($investimentoData['valor']);
        $investimento->setValorTaxado($investimentoData['valor_taxado']);

        return $investimento;
    }
}