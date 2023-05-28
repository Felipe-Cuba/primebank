<?php

namespace App\Models\DAO;

use App\Models\Entidades\Agencia;

class AgenciaDAO extends BaseDAO
{

    public function __construct()
    {
        parent::__construct('agencia');
    }
    public function salvar(Agencia $agencia): bool
    {
        $data = [
            'id_banco' => $agencia->getIdBanco(),
            'nome' => $agencia->getNome()
        ];

        return $this->create($data);
    }

    public function atualizar(Agencia $agencia): bool
    {
        $data = [
            'id_banco' => $agencia->getIdBanco(),
            'nome' => $agencia->getNome()
        ];

        return $this->update($agencia->getId(), $data);
    }

    public function excluir(Agencia $agencia): bool
    {
        return $this->delete($agencia->getId());
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