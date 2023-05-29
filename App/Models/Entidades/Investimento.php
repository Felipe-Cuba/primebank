<?php

namespace App\Models\Entidades;

class Investimento
{
    private int $id;
    private int $id_conta;
    private string $tipo_investimento;
    private float $taxa;
    private float $valor;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdConta(): int
    {
        return $this->id_conta;
    }

    public function setIdConta($idConta): void
    {
        $this->id_conta = $idConta;
    }

    public function getTipoInvestimento(): string
    {
        return $this->tipo_investimento;
    }

    public function setTipoInvestimento($tipoInvestimento): void
    {
        $this->tipo_investimento = $tipoInvestimento;
    }

    public function getTaxa(): float
    {
        return $this->taxa;
    }

    public function setTaxa($taxa): void
    {
        $this->taxa = $taxa;
    }

    public function getValorFormatado(): string
    {
        $valor = $this->valor;
        $valorFormatado = number_format($valor, 2, ',', '.');
        return 'R$ ' . $valorFormatado; // Adapte para o símbolo de moeda desejado
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor($valor): void
    {
        $this->valor = $valor;
    }

}