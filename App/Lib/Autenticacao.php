<?php

namespace App\Lib;

use Exception;

class Autenticacao
{
  public static function checkPermission($requiredPermission)
  {
    if (!Autenticacao::isAuthenticated()) {
      self::redirectToLogin();
    }

    if (!Autenticacao::hasPermission($requiredPermission)) {
      self::handleUnauthorizedAccess();
    }
  }

  private static function redirectToLogin()
  {
    header('Location: /primebank/usuarios/login');
    exit;
  }

  private static function handleUnauthorizedAccess()
  {
    throw new Exception('Acesso não autorizado', 403);
  }

  public static function isAuthenticated(): bool
  {
    return isset($_SESSION['usuario_id']);
  }

  public static function hasPermission($requiredPermission): bool
  {
    if (!isset($_SESSION['usuario_tipo'])) {
      return false;
    }

    $userType = $_SESSION['usuario_tipo'];

    return $userType === $requiredPermission;
  }
}