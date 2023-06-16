<?php

$usuarioId = $Sessao::get('usuario_id');
$tipoUsuario = $Sessao::get('usuario_tipo');
$nomeUsuario = $Sessao::get('usuario_nome');

$primeiroNome = explode(' ', $nomeUsuario)[0];

?>


<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
      <a class="navbar-brand text-white" href="http://<?php echo APP_HOST; ?>">PrimeBank</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <!-- Existing navigation items -->
          <li class="nav-item">
            <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>"><i class="fas fa-home"></i> Início</a>
          </li>
          <?php
          if (!is_null($tipoUsuario) && $tipoUsuario === TIPOS_USUARIO[1]) {
            ?>

            <li class="nav-item">
              <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>/usuarios"><i class="fas fa-user"></i>
                Usuários</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>/banco"><i
                  class="fas fa-building-columns"></i>
                Bancos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>/agencia"><i
                  class="fas fa-briefcase"></i>
                Agências</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>/conta"><i class="fas fa-wallet"></i>
                Contas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>/investimento"><i
                  class="fas fa-coins"></i>
                Investimentos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>/emprestimo"><i
                  class="fas fa-sack-dollar"></i>
                Empréstimos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="http://<?php echo APP_HOST; ?>/extrato"><i class="fas fa-history"></i>
                Extrato</a>
            </li>
            <?php
          }
          ?>

          <!-- Authentication dropdown menu -->
          <?php
          if (is_null($usuarioId)) {
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="authDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> Autenticação
              </a>
              <div class="dropdown-menu" aria-labelledby="authDropdown">
                <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuarios/login">Login</a>
                <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuarios/cadastro">Cadastro</a>
              </div>
            </li>
            <?php
          }
          ?>

          <!-- Profile and Logout dropdown menu -->

          <?php
          if (!is_null($usuarioId)) {
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="profileDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
                <?= $primeiroNome ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <?php
                if (!is_null($tipoUsuario) && $tipoUsuario === TIPOS_USUARIO[2]) {
                  ?>
                  <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuarios/perfil">Perfil</a>
                <?php } ?>
                <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuarios/logout">Logout</a>
              </div>
            </li>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>