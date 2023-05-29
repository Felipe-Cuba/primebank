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
            'id_agencia' => $conta->getId(),
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

    public function listar(): array
    {
        $contas = parent::getAll();

        $contaObjects = [];
        foreach ($contas as $conta) {
            $contaObjects[] = $this->setConta($conta);
        }

        return $contaObjects;
    }

    public function buscaId(int $id): ?Conta
    {
        $conta = parent::getById($id);

        if ($conta) {
            return $this->setConta($conta);
        }

        return null;
    }

    public function buscar(array $conditions): array
    {
        $contas = parent::getWhere($conditions);

        $contaObjects = [];
        foreach ($contas as $conta) {
            $contaObjects[] = $this->setConta($conta);
        }

        return $contaObjects;
    }

    private function setConta(array $contaData): Conta
    {
        $conta = new Conta();
        $conta->setId($contaData['id']);
        $conta->setIdAgencia($contaData['id_agencia']);
        $conta->setTipoConta($contaData['tipo_conta']);
        $conta->setSaldo($contaData['saldo']);
        $conta->setUsuario($contaData['id_usuario']);

        return $conta;
    }
}