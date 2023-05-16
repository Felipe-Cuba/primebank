<?php

namespace App\Models\Entidades;

class Conta
{
    private int $agencia;
    private int $numero;
    private int $tipo_conta;
    private float $saldo;
    private int $usuarios_id;

    public function getAgencia(): int
    {
        return $this->agencia;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getTipoConta(): int
    {
        return $this->tipo_conta;
    }

    public function setTipoConta(int $tipo_conta)
    {
        $this->tipo_conta = $tipo_conta;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function setSaldo(float $saldo): void
    {
        $this->saldo = $saldo;
    }

    public function getUsuariosId(): int
    {
        return $this->usuarios_id;
    }

}