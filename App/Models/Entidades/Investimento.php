<?php

namespace App\Models\Entidades;

class Investimento
{
    private int $id;
    private int $id_conta;
    private string $tipo_investimento;
    private float $taxa;
    private float $valor;
}