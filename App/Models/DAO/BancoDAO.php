<?php

namespace App\Models\DAO;

use App\Models\Entidades\Banco;

class BancoDAO extends BaseDAO
{
    public function __construct()
    {
        parent::__construct('banco');
    }

    public function salvar(Banco $banco): bool
    {
        $data = [
            'numero' => $banco->getNumero(),
            'nome' => $banco->getNome()
        ];

        return $this->create($data);
    }

    public function atualizar(Banco $banco): bool
    {
        $data = [
            'numero' => $banco->getNumero(),
            'nome' => $banco->getNome()
        ];

        return $this->update($banco->getId(), $data);
    }

    public function excluir(Banco $banco): bool
    {
        $agenciaDAO = new AgenciaDAO();
        $agencias = $agenciaDAO->buscar(['id_banco' => $banco->getId()]);
        foreach ($agencias as $agencia) {
            $agenciaDAO->excluir($agencia);
        }

        return $this->delete($banco->getId());
    }

    public function buscaId(int $id): ?Banco
    {
        $data = $this->getById($id);

        if ($data) {
            return $this->createBancoObject($data[0]);
        }

        return null;
    }

    public function listar(): array
    {
        $data = $this->getAll();

        $bancos = [];
        foreach ($data as $bancoData) {
            $bancos[] = $this->createBancoObject($bancoData);
        }

        return $bancos;
    }

    private function createBancoObject(array $data): Banco
    {
        $banco = new Banco();
        $banco->setId($data['id']);
        $banco->setNumero($data['numero']);
        $banco->setNome($data['nome']);

        return $banco;
    }
}