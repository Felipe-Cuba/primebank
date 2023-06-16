<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2>Login de Usuário</h2>
      <form action="http://<?php echo APP_HOST; ?>/usuarios/autenticar" method="POST">
        <div class="mb-3">
          <label for="documento" class="form-label">Documento (CPF/CNPJ)</label>
          <input type="text" class="form-control" id="documento" name="documento" required>
        </div>
        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <div class="mb-3">
          <span class="register-link">Ainda não tem uma conta? <a
              href="http://<?php echo APP_HOST; ?>/usuarios/cadastro" class="link-primary">Clique
              aqui</a></span>
        </div>

        <button type="submit" class="btn btn-primary">Entrar</button>
      </form>
    </div>
  </div>
</div>