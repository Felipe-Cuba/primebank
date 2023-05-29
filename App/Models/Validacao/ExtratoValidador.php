<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Extrato;

class ExtratoValidador
{
  public function validar(Extrato $extrato): ResultadoValidacao
  {
    $resultado = new ResultadoValidacao();

    if ($extrato->getIdConta() <= 0) {
      $resultado->addErro('id_conta', 'O campo ID da conta deve ser um valor maior que zero.');
    }

    if ($extrato->getValor() <= 0) {
      $resultado->addErro('valor', 'O valor do extrato deve ser um valor maior que zero.');
    }

    if (empty($extrato->getAcao())) {
      $resultado->addErro('acao', 'O campo ação é obrigatório.');
    }

    if (empty($extrato->getDataCadastro())) {
      $resultado->addErro('data_cadastro', 'O campo data de cadastro é obrigatório.');
    }

    return $resultado;
  }
}