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

    public function setId(int $id)
    {
        $this->id = $id;
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

    public function getAcao(): string
    {
        return $this->acao;
    }

    public function setAcao(string $acao): void
    {
        $this->acao = $acao;
    }

    public function getDataCadastro(): DateTime
    {
        return new DateTime($this->data_cadastro);
    }

    public function setDataCadastro(string $data_cadastro): void
    {
        $this->data_cadastro = $data_cadastro;
    }

    public function getIdConta(): int
    {
        return $this->id_conta;
    }

    public function setIdConta(int $id_conta): void
    {
        $this->id_conta = $id_conta;
    }

}