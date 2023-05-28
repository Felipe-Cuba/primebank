<?php

namespace App\Models\DAO;

use App\Models\Entidades\Conta;

class ContaDAO extends BaseDAO
{

    public function __construct()
    {
        parent::__construct('conta');
    }

    public function salvar(Conta $conta): bool
    {
        $data = [
            'id_agencia' => $conta->getIdAgencia(),
            'tipo_conta' => $conta->getTipoConta(),
            'saldo' => $conta->getSaldo(),
            'id_usuario' => $conta->getUsuario()
        ];

        return $this->create($data);
    }

    public function atualizar(Conta $conta): bool
    {
        $data = [
            'id_agencia' => $conta->getIdAgencia(),
            'tipo_conta' => $conta->getTipoConta(),
            'saldo' => $conta->getSaldo(),
            'id_usuario' => $conta->getUsuario()
        ];

        return $this->update($conta->getId(), $data);
    }

    public function excluir(int $id): bool
    {
        return $this->delete($id);
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