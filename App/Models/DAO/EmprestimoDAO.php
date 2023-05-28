<?php

namespace App\Models\DAO;

use App\Models\Entidades\Emprestimo;

class EmprestimoDAO extends BaseDAO
{

    public function __construct()
    {
        parent::__construct('emprestimo');
    }

    public function salvar(Emprestimo $emprestimo): bool
    {
        $data = [
            'id_conta' => $emprestimo->getIdConta(),
            'valor' => $emprestimo->getValor(),
            'taxa' => $emprestimo->getTaxa(),
            'parcelas' => $emprestimo->getParcelas(),
            'parcelas_pagas' => $emprestimo->getParcelasPagas()
        ];

        return $this->create($data);
    }

    public function atualizar(Emprestimo $emprestimo): bool
    {
        $data = [
            'id_conta' => $emprestimo->getIdConta(),
            'valor' => $emprestimo->getValor(),
            'taxa' => $emprestimo->getTaxa(),
            'parcelas' => $emprestimo->getParcelas(),
            'parcelas_pagas' => $emprestimo->getParcelasPagas()
        ];

        return $this->update($emprestimo->getId(), $data);
    }

    public function excluir(Emprestimo $emprestimo): bool
    {
        return $this->delete($emprestimo->getId());
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