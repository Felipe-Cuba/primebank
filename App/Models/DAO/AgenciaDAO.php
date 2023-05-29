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