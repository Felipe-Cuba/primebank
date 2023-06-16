<?php

namespace App\Models\Entidades;

class Agencia
{
    private int $id;
    private int $id_banco;
    private string $nome;
    private int $numero;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdBanco(): int
    {
        return $this->id_banco;
    }

    public function setIdBanco($idBanco): void
    {
        $this->id_banco = $idBanco;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

}