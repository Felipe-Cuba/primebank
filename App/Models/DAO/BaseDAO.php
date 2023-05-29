<?php

namespace App\Models\DAO;

use App\Lib\Conexao;
use PDO;

abstract class BaseDAO
{
    private string $tableName;
    protected $conexao;


    public function __construct(string $tableName)
    {
        $this->conexao = Conexao::getConnection();
        $this->tableName = $tableName;
    }

    protected function getTableName(): string
    {
        return $this->tableName;
    }

    protected function create(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$values})";

        $stmt = $this->conexao->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        return $stmt->execute();
    }

    protected function update(int $id, array $data): bool
    {
        $setStatements = [];

        foreach ($data as $key => $value) {
            $setStatements[] = "{$key} = :{$key}";
        }

        $setStatements = implode(', ', $setStatements);

        $query = "UPDATE {$this->tableName} SET {$setStatements} WHERE id = :id";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id', $id);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        return $stmt->execute();
    }


    protected function delete(int $id): bool
    {
        $query = "DELETE FROM {$this->tableName} WHERE id = :id";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    protected function getAll(): array
    {
        $query = "SELECT * FROM {$this->tableName}";

        $stmt = $this->conexao->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getById(int $id): ?array
    {
        $query = "SELECT * FROM {$this->tableName} WHERE id = :id";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id', $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }

    protected function getWhere(array $conditions): array
    {
        $whereStatements = [];

        foreach ($conditions as $key => $value) {
            $whereStatements[] = "{$key} = :{$key}";
        }

        $whereClause = implode(' AND ', $whereStatements);

        $query = "SELECT * FROM {$this->tableName} WHERE {$whereClause}";

        $stmt = $this->conexao->prepare($query);

        foreach ($conditions as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function executeQuery(string $query, array $params = []): array
    {
        $stmt = $this->conexao->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}