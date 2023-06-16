<?php

$saldo = $viewVar['saldo_conta'];

$tipoTransacao = $viewVar['tipo_transacao'];

?>

<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">

      <div id="warningAlert" class="alert alert-warning" role="alert" hidden>
        <span id="msg"></span>
      </div>

      <h2>Realizar
        <?= $tipoTransacao ?>
      </h2>
      <form action="http://<?php echo APP_HOST; ?>/conta/check-in" method="POST" <?php if ($tipoTransacao !== 'Depósito') { ?> onsubmit="verificarSaldo(<?php echo $saldo; ?>, event)" <?php } ?>>
        <div class="mb-3">
          <label for="tipo_trasacao" class="form-label">Tipo da transação</label>
          <input type="text" class="form-control" id="tipo_trasacao" name="tipo_trasacao" value="<?= $tipoTransacao ?>"
            readonly required>
        </div>

        <div class="mb-3">
          <label for="saldo_atual_formatado" class="form-label">Saldo atual</label>
          <input type="text" class="form-control" id="saldo_atual_formatado" name="saldo_atual_formatado"
            value="<?= $viewVar['saldo_conta_formatado'] ?>" disabled required>
        </div>

        <div class="mb-3">
          <label for="valor" class="form-label">Valor</label>
          <input type="text" class="form-control" id="valor" name="valor" required>
        </div>
        <button type="submit" class="btn btn-primary">Alterar</button>
      </form>
    </div>
  </div>
</div>