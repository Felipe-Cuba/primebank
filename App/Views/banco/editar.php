<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Cadastro banco</h1>
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      $banco = $viewVar['banco'];
      ?>

      <form class="form-group" action="http://<?php echo APP_HOST; ?>/banco/atualizar" method="post">
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $banco->getId(); ?>">
        <div class="mt-2">
          <label class="form-lable" for="nome">nome:</label>
          <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $banco->getNome(); ?>"
            required>
        </div>

        <div class="mt-2">
          <label class="form-lable" for="numero">numero:</label>
          <input type="number" class="form-control" id="numero" name="numero" value="<?php echo $banco->getNumero(); ?>"
            required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Enviar</button>

      </form>
    </div>
  </div>

</div>