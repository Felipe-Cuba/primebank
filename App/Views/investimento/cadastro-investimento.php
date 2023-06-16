<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2>Cadastro de conta</h2>
      <form action="http://<?php echo APP_HOST; ?>/investimento/salvar" method="POST">
        <div class="mb-3">
          <label for="valor" class="form-label">Valor</label>
          <input type="text" class="form-control" id="valor" name="valor" required>
        </div>
        <div class="mb-3">
          <label for="tipo_investimento" class="form-label">Tipo do Investimento</label>
          <select class="form-control" id="tipo_investimento" name="tipo_investimento" required>
            <option value="">Selecione o Tipo do Investimento</option>
            <?php foreach (TIPOS_INVESTIMENTO as $valor => $tipo): ?>
              <option value="<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </form>
    </div>
  </div>
</div>