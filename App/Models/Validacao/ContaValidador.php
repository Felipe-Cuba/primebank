<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Conta;

class ContaValidador
{
  public function validar(Conta $conta): ResultadoValidacao
  {
    $resultado = new ResultadoValidacao();

    if ($conta->getIdAgencia() <= 0) {
      $resultado->addErro('id_agencia', 'O campo ID da agência deve ser um valor maior que zero.');
    }

    if ($conta->getTipoConta() <= 0) {
      $resultado->addErro('tipo_conta', 'O campo tipo de conta deve ser um valor maior que zero.');
    }

    if ($conta->getSaldo() < 0) {
      $resultado->addErro('saldo', 'O saldo da conta não pode ser negativo.');
    }

    if ($conta->getUsuario() <= 0) {
      $resultado->addErro('id_usuario', 'O campo ID do usuário deve ser um valor maior que zero.');
    }

    // Adicione aqui outras validações para os campos desejados

    return $resultado;
  }
}