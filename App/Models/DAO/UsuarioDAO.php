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
            'data_nasc' => $usuario->getDataNasc()->format('Y-m-d'),
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
            'data_nasc' => $usuario->getDataNasc()->format('Y-m-d'),
            'tipo' => $usuario->getTipo()
        ];

        return $this->update($usuario->getId(), $data);
    }

    public function excluir(Usuario $usuario): bool
    {
        $contaDAO = new ContaDAO();
        $contas = $contaDAO->buscar(['id_usuario' => $usuario->getId()]);
        foreach ($contas as $conta) {
            $contaDAO->excluir($conta);
        }

        return $this->delete($usuario->getId());
    }

    public function listar(): array
    {
        $usuarios = parent::getAll();

        $usuarioObjects = [];
        foreach ($usuarios as $usuarioData) {
            $usuarioObjects[] = $this->setUsuario($usuarioData);
        }

        return $usuarioObjects;
    }

    public function buscaId(int $id): ?Usuario
    {
        $usuarioData = parent::getById($id);

        if ($usuarioData) {
            return $this->setUsuario($usuarioData[0]);
        }

        return null;
    }

    public function buscar(array $conditions): array
    {
        $usuarios = parent::getWhere($conditions);

        $usuarioObjects = [];
        foreach ($usuarios as $usuarioData) {
            $usuarioObjects[] = $this->setUsuario($usuarioData);
        }

        return $usuarioObjects;
    }

    public function emailExists(string $email): bool
    {
        $query = "SELECT COUNT(*) FROM {$this->getTableName()} WHERE email = :email";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    private function setUsuario(array $usuarioData): Usuario
    {
        // print_r($usuarioData);
        $usuario = new Usuario();
        $usuario->setId($usuarioData['id']);
        $usuario->setNome($usuarioData['nome']);
        $usuario->setEmail($usuarioData['email']);
        $usuario->setSenha($usuarioData['senha']);
        $usuario->setDocumento($usuarioData['documento']);
        $usuario->setDataCadastro($usuarioData['data_cadastro']);
        $usuario->setDataNasc($usuarioData['data_nasc']);
        $usuario->setTipo($usuarioData['tipo']);

        return $usuario;
    }

}