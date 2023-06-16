<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Atualizar Agencia</h1>
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>
      <form class="form-group" action="http://<?php echo APP_HOST; ?>/agencia/atualizar" method="post">
        <?php $agencia = $viewVar['agencia']; ?>
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $agencia->getId(); ?>">
        <div class="mt-2">
          <label class="form-lable" for="nome">Nome:</label>
          <input type="text" class="form-control" id=" nome" name="nome" value="<?php echo $agencia->getNome(); ?>"
            required>
        </div>

        <div class="mt-2">
          <label class="form-lable" for="numero">Numero:</label>
          <input type="text" class="form-control" id=" numero" name="numero"
            value="<?php echo $agencia->getNumero(); ?>" required>
        </div>

        <div class="mt-2">
          <label class="form-label" for="id_banco">Banco:</label>
          <select class="form-control" id="id_banco" name="id_banco" required>
            <option value="0">Selecione um banco</option>
            <?php foreach ($viewVar['bancos'] as $banco) {
              $selected = ($banco->getId() == $agencia->getIdBanco()) ? 'selected' : '';
              ?>
              <option value="<?php echo $banco->getId(); ?>" <?php echo $selected; ?>><?php echo $banco->getNome(); ?>
              </option>
            <?php } ?>
          </select>
        </div>


        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>

      </form>
    </div>
  </div>

</div>