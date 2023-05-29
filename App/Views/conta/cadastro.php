<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Cadastro de Conta</h1>
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <form class="form-group" action="http://<?php echo APP_HOST; ?>/conta/salvar" method="post">
        <div class="mt-2">
          <label class="form-lable" for="numero_agencia">Agência:</label>
          <select class="form-control" id="id_agencia" name="id_agencia" required>
            <option value="0">Seleciona uma agência</option>
            <?php foreach ($viewVar['agencias'] as $agencia) { ?>
              <option value="<?php echo $agencia->getid(); ?>"><?php echo $agencia->getNome(); ?> - <?php echo $agencia->getNumero(); ?>
              </option>
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
              echo "<option value='" . $valor . "'>" . $tipo . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="saldo">Saldo:</label>
          <input type="number" class="form-control" id="saldo" name="saldo" step="0.01" required>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="id_usuario">Usuário:</label>
          <select class="form-control" id="id_usuario" name="id_usuario" required>
            <option value="0">Selecione um usuário</option>
            <?php foreach ($viewVar['usuarios'] as $usuario) { ?>
              <option value="<?php echo $usuario->getId(); ?>"><?php echo $usuario->getNome(); ?></option>
            <?php } ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Enviar</button>
      </form>
    </div>
  </div>
</div>