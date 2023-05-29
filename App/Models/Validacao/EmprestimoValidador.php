<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Emprestimo;

class EmprestimoValidador
{
  public function validar(Emprestimo $emprestimo): ResultadoValidacao
  {
    $resultado = new ResultadoValidacao();

    if ($emprestimo->getIdConta() <= 0) {
      $resultado->addErro('id_conta', 'O campo ID da conta deve ser um valor maior que zero.');
    }

    if ($emprestimo->getValor() <= 0) {
      $resultado->addErro('valor', 'O valor do empréstimo deve ser um valor maior que zero.');
    }

    if ($emprestimo->getTaxa() <= 0) {
      $resultado->addErro('taxa', 'A taxa do empréstimo deve ser um valor maior que zero.');
    }

    if ($emprestimo->getParcelas() <= 0) {
      $resultado->addErro('parcelas', 'O número de parcelas deve ser um valor maior que zero.');
    }

    if ($emprestimo->getParcelasPagas() < 0) {
      $resultado->addErro('parcelas_pagas', 'O número de parcelas pagas não pode ser negativo.');
    }

    return $resultado;
  }
}