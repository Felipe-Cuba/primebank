<?php

namespace App\Models\Entidades;

class Conta
{
    private int $id;
    private int $id_agencia;
    private int $tipo_conta;
    private float $saldo;
    private int $id_usuario;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdAgencia(): int
    {
        return $this->id_agencia;
    }

    public function setIdAgencia(int $idAgencia): void
    {
        $this->id_agencia = $idAgencia;
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

    public function getUsuario(): int
    {
        return $this->id_usuario;
    }

    public function setUsuario($id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

}