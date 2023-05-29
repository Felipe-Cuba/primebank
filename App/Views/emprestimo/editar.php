<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Atualizar Emprestimo</h1>
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      $emprestimo = $viewVar['emprestimo'];
      ?>

      <form class="form-group" action="http://<?php echo APP_HOST; ?>/emprestimo/atualizar" method="post">
        <input type="text" hidden class="form-control" id="id" name="id" value="<?= $emprestimo->getId() ?>" required>
        <input type="text" hidden class="form-control" id="id_conta" name="id_conta" value="<?= $emprestimo->getidConta() ?>"
          required>
        <div class="mt-2">
          <label class="form-lable" for="valor">Valor do financiamento:</label>
          <input type="number" class="form-control" id="valor" name="valor" value="<?= $emprestimo->getValor() ?>"
            required>
        </div>

        <div class="mt-2">
          <label class="form-lable" for="taxa">Taxa:</label>
          <input type="number" class="form-control" id="taxa" name="taxa" value="<?= $emprestimo->getTaxa() ?>"
            required>
        </div>

        <div class="mt-2">
          <label class="form-lable" for="parcelas">Parcelas:</label>
          <input type="number" class="form-control" id="parcelas" name="parcelas"
            value="<?= $emprestimo->getParcelas() ?>" required>
        </div>

        <div class="mt-2">
          <label class="form-lable" for="parcelasPagas">Parcelas pagas:</label>
          <input type="number" class="form-control" id="parcelasPagas" name="parcelas_pagas"
            value="<?= $emprestimo->getParcelasPagas() ?>" required>
        </div>



        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>

      </form>
    </div>
  </div>

</div>