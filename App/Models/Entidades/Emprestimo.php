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
}