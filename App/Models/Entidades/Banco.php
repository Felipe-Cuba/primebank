<?php

namespace App\Models\Entidades;

class Banco
{
    private int $id;
    private int $numero;
    private string $nome;

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero)
    {
        $this->numero = $numero;
    }
}