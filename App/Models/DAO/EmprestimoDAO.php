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

    public function listar(): array
    {
        $emprestimos = parent::getAll();

        $emprestimoObjects = [];
        foreach ($emprestimos as $emprestimo) {
            $emprestimoObjects[] = $this->setEmprestimo($emprestimo);
        }

        return $emprestimoObjects;
    }

    public function buscaId(int $id): ?Emprestimo
    {
        $emprestimo = parent::getById($id);

        if ($emprestimo) {
            return $this->setEmprestimo($emprestimo[0]);
        }

        return null;
    }

    public function buscar(array $conditions): array
    {
        $emprestimos = parent::getWhere($conditions);

        $emprestimoObjects = [];
        foreach ($emprestimos as $emprestimo) {
            $emprestimoObjects[] = $this->setEmprestimo($emprestimo);
        }

        return $emprestimoObjects;
    }

    private function setEmprestimo(array $emprestimoData): Emprestimo
    {
        $emprestimo = new Emprestimo();
        $emprestimo->setId($emprestimoData['id']);
        $emprestimo->setIdConta($emprestimoData['id_conta']);
        $emprestimo->setParcelas($emprestimoData['parcelas']);
        $emprestimo->setParcelasPagas($emprestimoData['parcelas_pagas']);
        $emprestimo->setTaxa($emprestimoData['taxa']);
        $emprestimo->setValor($emprestimoData['valor']);

        return $emprestimo;
    }

}