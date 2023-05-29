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
            'nome' => $agencia->getNome(),
            'numero' => $agencia->getNumero()
        ];

        return parent::create($data);
    }

    public function atualizar(Agencia $agencia): bool
    {
        $data = [
            'id_banco' => $agencia->getIdBanco(),
            'nome' => $agencia->getNome(),
            'numero' => $agencia->getNumero()
        ];

        return parent::update($agencia->getId(), $data);
    }

    public function excluir(Agencia $agencia): bool
    {
        // Excluir contas relacionados à agencia
        $contaDAO = new ContaDAO();
        $contas = $contaDAO->buscar(['id_agencia' => $agencia->getId()]);
        foreach ($contas as $conta) {
            $contaDAO->excluir($conta);
        }

        return parent::delete($agencia->getId());
    }

    public function buscaId(int $id): ?Agencia
    {
        $data = parent::getById($id);

        if ($data) {
            return $this->setAgencia($data[0]);
        }

        return null;
    }

    public function listar(): array
    {
        $data = parent::getAll();

        $agencias = [];
        foreach ($data as $agenciaData) {
            $agencias[] = $this->setAgencia($agenciaData);
        }

        return $agencias;
    }

    public function buscar(array $conditions): array
    {
        $agencias = parent::getWhere($conditions);

        $agenciaObjects = [];
        foreach ($agencias as $agencia) {
            $agenciaObjects[] = $this->setAgencia($agencia);
        }

        return $agenciaObjects;
    }

    private function setAgencia(array $data): Agencia
    {
        $agencia = new Agencia();
        $agencia->setId($data['id']);
        $agencia->setNumero($data['numero']);
        $agencia->setNome($data['nome']);
        $agencia->setIdBanco($data['id_banco']);

        return $agencia;
    }
}