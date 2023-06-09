<?php

namespace App\Models\Entidades;

class Emprestimo
{
    private int $id;
    private int $id_conta;
    private float $valor;
    private float $taxa;
    private int $parcelas;
    private int $parcelas_pagas;

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

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getValorFormatado(): string
    {
        $valor = $this->valor;
        $valorFormatado = number_format($valor, 2, ',', '.');
        return 'R$ ' . $valorFormatado; // Adapte para o símbolo de moeda desejado
    }

    public function getTaxa(): float
    {
        return $this->taxa;
    }

    public function setTaxa(float $taxa): void
    {
        $this->taxa = $taxa;
    }

    public function getParcelas(): int
    {
        return $this->parcelas;
    }

    public function setParcelas(int $parcelas): void
    {
        $this->parcelas = $parcelas;
    }

    public function getParcelasPagas(): int
    {
        return $this->parcelas_pagas;
    }

    public function setParcelasPagas(int $parcelas_pagas): void
    {
        $this->parcelas_pagas = $parcelas_pagas;
    }

    public function getValorParcela(): float
    {
        $valorParcela = $this->valor / $this->parcelas;
        $valorTaxado = $valorParcela + ($valorParcela * ($this->taxa / 100));
        return $valorTaxado;
    }

    public function getValorParcelaFormatado(): string
    {
        $valor = $this->getValorParcela();
        $valorFormatado = number_format($valor, 2, ',', '.');
        return 'R$ ' . $valorFormatado; // Adapte para o símbolo de moeda desejado
    }

}