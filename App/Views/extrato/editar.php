<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Atualizar Extrato</h1>
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      $extrato = $viewVar['extrato'];
      ?>
      <form class="form-group" action="http://<?php echo APP_HOST; ?>/extrato/atualizar" method="post">
        <input type="hidden" class="form-control" name="id" id="id" value="<?= $extrato->getId(); ?>">
        <input type="hidden" class="form-control" name="id_conta" id="id_conta" value="<?= $extrato->getIdConta(); ?>">
        <div class="mt-2">
          <label class="form-lable" for="acao">Ação:</label>
          <select class="form-control" id="acao" name="acao" required>
            <option value="">Selecione uma ação</option>
            <option value="deposito" <?php echo $extrato->getAcao() === 'deposito' ? 'selected' : ''; ?>>Depósito</option>
            <option value="saque" <?php echo $extrato->getAcao() === 'saque' ? 'selected' : ''; ?>>Saque</option>
            <option value="pagamento" <?php echo $extrato->getAcao() === 'pagamento' ? 'selected' : ''; ?>>Pagamento
            </option>
          </select>
        </div>

        <div class="mt-2">
          <label class="form-lable" for="valor">Valor:</label>
          <input type="number" class="form-control" id="valor" name="valor" value="<?= $extrato->getValor() ?>"
            required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>

      </form>
    </div>
  </div>

</div>