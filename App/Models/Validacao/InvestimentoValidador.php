<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Investimento;

class InvestimentoValidador
{
  public function validar(Investimento $investimento): ResultadoValidacao
  {
    $resultado = new ResultadoValidacao();

    if (empty($investimento->getTipoInvestimento())) {
      $resultado->addErro('tipo_investimento', 'O campo tipo de investimento é obrigatório.');
    }

    if ($investimento->getTaxa() <= 0) {
      $resultado->addErro('taxa', 'A taxa de investimento deve ser um valor maior que zero.');
    }

    if ($investimento->getValor() <= 0) {
      $resultado->addErro('valor', 'O valor de investimento deve ser um valor maior que zero.');
    }

    return $resultado;
  }
}