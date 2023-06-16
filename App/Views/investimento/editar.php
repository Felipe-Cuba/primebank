<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Atualizar Investimento</h1>
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
        $investimento = $viewVar['investimento'];
      ?>

      <form class="form-group" action="http://<?php echo APP_HOST; ?>/investimento/atualizar" method="post">
        <input type="hidden" class="form-control" name="id" id="id" value="<?= $investimento->getId(); ?>">
        <input type="hidden" class="form-control" name="id_conta" id="id_conta" value="<?= $investimento->getIdConta(); ?>">
        <div class="mt-2">
          <label class="form-lable" for="tipo">Tipo de investimento:</label>
          <select class="form-control" id="tipo" name="tipo" required>
            <option value="">Selecione um tipo de investimento</option>
            <option value="renda fixa" <?php echo $investimento->getTipoInvestimento() === 'renda fixa' ? 'selected' : ''; ?>>Renda Fixa</option>
            <option value="renda variavel" <?php echo $investimento->getTipoInvestimento() === 'renda variavel' ? 'selected' : ''; ?>>Renda Variável</option>
            <option value="tesouro direto" <?php echo $investimento->getTipoInvestimento() === 'tesouro direto' ? 'selected' : ''; ?>>Tesouro Direto</option>
            <option value="fundo imobiliario" <?php echo $investimento->getTipoInvestimento() === 'fundo imobiliario' ? 'selected' : ''; ?>>Fundo Imobiliário</option>
          </select>
        </div>

        <div class="mt-2">
          <label class="form-lable" for="taxa">Taxa:</label>
          <input type="number" class="form-control" id="taxa" name="taxa" value="<?= $investimento->getTaxa() ?>" required>
        </div>

        <div class="mt-2">
          <label class="form-lable" for="valor">Valor do financiamento:</label>
          <input type="number" class="form-control" id="valor" name="valor" value="<?= $investimento->getValor() ?>" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>

      </form>
    </div>
  </div>

</div>