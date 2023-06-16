<?php
$msg = '';

if (isset($_GET['wrong'])) {
  $wrong = true;

  $msg = "Senha errada! Para prosseguir digite sua senha corretamente.";
}

if (isset($_GET['wrong_email'])) {
  $wrong = true;

  $msg = "Esse email já está registrado em outra conta!";
}

?>

<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <?php if (isset($wrong)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $msg ?>
        </div>
      <?php endif; ?>

      <h2>Alterar senha</h2>
      <form action="http://<?php echo APP_HOST; ?>/usuarios/change" method="POST">
        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <div class="mb-3">
          <label for="senha" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" name="novo_email" required>
        </div>
        <button type="submit" class="btn btn-primary">Alterar</button>
      </form>
    </div>
  </div>
</div>