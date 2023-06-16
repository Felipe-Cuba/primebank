<?php
// Verifique se há um objeto Conta disponível
$conta = $viewVar['conta'];
?>

<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Atualizar Conta</h1>
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <form class="form-group" action="http://<?php echo APP_HOST; ?>/conta/atualizar" method="post">
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $conta->getId(); ?>">
        <div class="mt-2">
          <label class="form-lable" for="numero_agencia">Agência:</label>
          <select class="form-control" id="id_agencia" name="id_agencia" required>
            <option value="0">Seleciona uma agência</option>
            <?php foreach ($viewVar['agencias'] as $agencia) {
              $selected = ($agencia->getId() == $conta->getIdAgencia()) ? 'selected' : '';
              ?>
              <option value="<?php echo $agencia->getId(); ?>" <?php echo $selected; ?>><?php echo $agencia->getNome(); ?>
                - <?php echo $agencia->getNumero(); ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="tipo_conta">Tipo de Conta:</label>
          <select class="form-control" id="tipo_conta" name="tipo_conta" required>
            <option value="">Selecione um tipo de conta</option>
            <?php
            $tiposConta = array(
              1 => "Conta Corrente",
              2 => "Conta Poupança",
              3 => "Conta de Investimento"
            );
            foreach ($tiposConta as $valor => $tipo) {
              $selected = ($valor == $conta->getTipoConta()) ? 'selected' : '';
              echo "<option value='" . $valor . "' " . $selected . ">" . $tipo . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="numero">Numero da conta:</label>
          <input type="text" class="form-control" id="numero" name="numero" step="0.01"
            value="<?php echo $conta->getNumero(); ?>" required>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="saldo">Saldo:</label>
          <input type="number" class="form-control" id="saldo" name="saldo" step="0.01"
            value="<?php echo $conta->getSaldo(); ?>" required>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="id_usuario">Usuário:</label>
          <select class="form-control" id="id_usuario" name="id_usuario" required>
            <option value="0">Selecione um usuário</option>
            <?php foreach ($viewVar['usuarios'] as $usuario) {
              $selected = ($usuario->getId() == $conta->getUsuario()) ? 'selected' : '';
              ?>
              <option value="<?php echo $usuario->getId(); ?>" <?php echo $selected; ?>><?php echo $usuario->getNome(); ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
      </form>
    </div>
  </div>
</div>