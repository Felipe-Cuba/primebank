<?php

namespace App\Models\DAO;

use App\Models\Entidades\Extrato;

class ExtratoDAO extends BaseDAO
{

    public function __construct()
    {
        parent::__construct('extrato');
    }

    public function salvar(Extrato $extrato): bool
    {
        $data = [
            'id_conta' => $extrato->getIdConta(),
            'valor' => $extrato->getValor(),
            'acao' => $extrato->getAcao(),
            'data_cadastro' => $extrato->getDataCadastro()->format('Y-m-d H:i:s')
        ];

        return $this->create($data);
    }

    public function atualizar(Extrato $extrato): bool
    {
        $data = [
            'id_conta' => $extrato->getIdConta(),
            'valor' => $extrato->getValor(),
            'acao' => $extrato->getAcao(),
            'data_cadastro' => $extrato->getDataCadastro()->format('Y-m-d H:i:s')
        ];

        return $this->update($extrato->getId(), $data);
    }

    public function excluir(Extrato $extrato): bool
    {
        return $this->delete($extrato->getId());
    }

    private function setExtrato(array $data): Extrato
    {
        $extrato = new Extrato();
        $extrato->setId($data['id']);
        $extrato->setIdConta($data['id_conta']);
        $extrato->setValor($data['valor']);
        $extrato->setAcao($data['acao']);
        $extrato->setDataCadastro($data['data_cadastro']);

        return $extrato;
    }

    public function listar(): array
    {
        $results = parent::getAll();

        $extratos = [];

        foreach ($results as $result) {
            $extrato = $this->setExtrato($result);
            $extratos[] = $extrato;
        }

        return $extratos;
    }

    public function buscaId(int $id): ?Extrato
    {
        $result = parent::getById($id);

        if ($result) {
            $extrato = $this->setExtrato($result);
            return $extrato;
        }

        return null;
    }

    public function buscar(array $conditions): array
    {
        $results = parent::getWhere($conditions);

        $extratos = [];

        foreach ($results as $result) {
            $extrato = $this->setExtrato($result);
            $extratos[] = $extrato;
        }

        return $extratos;
    }

}