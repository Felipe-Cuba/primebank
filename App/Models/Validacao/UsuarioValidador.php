<?php

namespace App\Models\Validacao;

use App\Models\Entidades\Usuario;

class UsuarioValidador
{
  public function validar(Usuario $usuario): ResultadoValidacao
  {
    $resultado = new ResultadoValidacao();

    if (empty($usuario->getNome())) {
      $resultado->addErro('nome', 'O campo nome é obrigatório.');
    } elseif (strlen($usuario->getNome()) < 4) {
      $resultado->addErro('nome', 'O campo nome deve ter pelo menos 4 caracteres.');
    }

    if (empty($usuario->getEmail())) {
      $resultado->addErro('email', 'O campo email é obrigatório.');
    } elseif (!filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL)) {
      $resultado->addErro('email', 'O campo email deve ser um endereço de email válido.');
    }

    if (empty($usuario->getSenha())) {
      $resultado->addErro('senha', 'O campo senha é obrigatório.');
    } elseif (strlen($usuario->getSenha()) < 8) {
      $resultado->addErro('senha', 'O campo senha deve ter pelo menos 8 caracteres.');
    }

    if (empty($usuario->getDocumento())) {
      $resultado->addErro('documento', 'O campo documento é obrigatório.');
    } elseif (strlen($usuario->getDocumento()) !== 11 && strlen($usuario->getDocumento()) !== 14) {
      $resultado->addErro('documento', 'O campo documento deve ter 11 dígitos para CPF ou 14 dígitos para CNPJ.');
    }

    return $resultado;
  }
}