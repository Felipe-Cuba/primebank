<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Agencia;

class AgenciaValidador
{
  public function validar(Agencia $agencia): ResultadoValidacao
  {
    $resultado = new ResultadoValidacao();

    if (empty($agencia->getNome())) {
      $resultado->addErro('nome', 'O campo nome da agência é obrigatório.');
    }

    // Adicione aqui outras validações para os campos desejados

    return $resultado;
  }
}