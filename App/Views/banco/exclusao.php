<div class="container">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <h1>Excluir Banco</h1>

    <?php if ($Sessao::returnError()) { ?>
      <div class="alert alert-warning" role="alert">
        <a href="" class="close" data-dismiss="alert" aria-label="close"><i class="bi bi-x-square"></i></a>
        <?php foreach ($Sessao::returnError() as $key => $mensagem) { ?>
          <?php echo $mensagem; ?> <br>
        <?php } ?>
      </div>
    <?php } ?>

    <form action="http://<?php echo APP_HOST; ?>/banco/excluir" method="post" id="form_cadastro">
      <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['banco']->getId(); ?>">

      <div class="panel panel-danger">
        <div class="panel-body">
          Deseja realmente excluir o banco: <b>
            <?= $viewVar['banco']->getNome() ?> - <?= $viewVar['banco']->getNumero() ?>
          </b>?
        </div>
        <br />
        <div class="panel-footer">
          <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
          <a href="http://<?php echo APP_HOST; ?>/banco" class="btn btn-info btn-sm">Voltar</a>
        </div>
      </div>
    </form>
  </div>
  <div class=" col-md-3"></div>
</div>