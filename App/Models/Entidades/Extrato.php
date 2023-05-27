<?php

namespace App\Models\Entidades;

use DateTime;

class Extrato
{
    private int $id;
    private int $id_conta;
    private float $valor;
    private string $acao;
    private string $data_cadastro;

    public function getId(): int
    {
        return $this->id;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getAcao(): string
    {
        return $this->acao;
    }

    public function getDataCadastro(): DateTime
    {
        return new DateTime($this->data_cadastro);
    }

    public function getIdConta(): int
    {
        return $this->id_conta;
    }

}