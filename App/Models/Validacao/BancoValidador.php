<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Banco;

class BancoValidador
{
  public function validar(Banco $banco): ResultadoValidacao
  {
    $resultado = new ResultadoValidacao();

    if (empty($banco->getNumero())) {
      $resultado->addErro('numero', 'O campo número do banco deve ser um valor maior que zero.');
    }

    if (empty($banco->getNome())) {
      $resultado->addErro('nome', 'O campo nome do banco é obrigatório.');
    }

    return $resultado;
  }
}