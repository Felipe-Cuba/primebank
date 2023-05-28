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

    public function getAll(): array
    {
        return $this->getAll();
    }

    public function getById(int $id): ?array
    {
        return $this->getById($id);
    }

    public function getWhere(array $conditions): array
    {
        return $this->getWhere($conditions);
    }
}