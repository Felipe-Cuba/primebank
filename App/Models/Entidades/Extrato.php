<?php

namespace App\Models\Entidades;

use DateTime;

class Extrato
{
    private int $id;
    private float $valor;
    private string $acao;
    private string $data_cadastro;
    private int $conta_agencia;
    private int $conta_numero;

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

    public function getContaAgencia(): int
    {
        return $this->conta_agencia;
    }

    public function getContaNumero(): int
    {
        return $this->conta_numero;
    }

}