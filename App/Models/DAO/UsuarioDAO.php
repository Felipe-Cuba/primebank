<?php

namespace App\Models\DAO;

use App\Models\Entidades\Usuario;

class UsuarioDAO extends BaseDAO
{

    public function __construct()
    {
        parent::__construct('usuario');
    }

    public function salvar(Usuario $usuario): bool
    {
        $data = [
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha(),
            'documento' => $usuario->getDocumento(),
            'data_nasc' => $usuario->getDataNasc(),
            'tipo' => $usuario->getTipo()
        ];

        return $this->create($data);
    }

    public function atualizar(Usuario $usuario): bool
    {
        $data = [
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha(),
            'documento' => $usuario->getDocumento(),
            'data_nasc' => $usuario->getDataNasc(),
            'tipo' => $usuario->getTipo()
        ];

        return $this->update($usuario->getId(), $data);
    }

    public function excluir(Usuario $usuario): bool
    {
        return $this->delete($usuario->getId());
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

    public function emailExists(string $email): bool
    {
        $query = "SELECT COUNT(*) FROM {$this->getTableName()} WHERE email = :email";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}