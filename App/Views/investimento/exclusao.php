<div class="container">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <h1>Excluir Investimento</h1>

    <?php if ($Sessao::returnError()) { ?>
      <div class="alert alert-warning" role="alert">
        <a href="" class="close" data-dismiss="alert" aria-label="close"><i class="bi bi-x-square"></i></a>
        <?php foreach ($Sessao::returnError() as $key => $mensagem) { ?>
          <?php echo $mensagem; ?> <br>
        <?php } ?>
      </div>
    <?php } ?>

    <?php
    $contas = $viewVar['listaContas'];
    $investimento = $viewVar['investimento'];
    $conta = array_values(array_filter($contas, function ($conta) use ($investimento) {
      return $conta->getId() === $investimento->getIdConta();
    }));
    ?>

    <form action="http://<?php echo APP_HOST; ?>/investimento/excluir" method="post" id="form_cadastro">
      <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $investimento->getId(); ?>">

      <div class="panel panel-danger">
        <div class="panel-body">
          Deseja realmente esse investimento?

          <p class="my-3">
            Dados do investimento:
          </p>
          <p class="my-3">
            Conta:
            <b>
              <?= $conta[0]->getNumero() ?>
            </b>
          </p>
          <p class="my-3">
            Tipo de investimento:
            <b>
              <?= $investimento->getTipoInvestimento() ?>
            </b>
          </p>
          <p class="my-3">
            Valor do investimento: <b>
              <?= $investimento->getValorFormatado() ?>
            </b>
          </p>

        </div>
        <br />
        <div class="panel-footer">
          <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
          <a href="http://<?php echo APP_HOST; ?>/investimento" class="btn btn-info btn-sm">Voltar</a>
        </div>
      </div>
    </form>
  </div>
  <div class=" col-md-3"></div>
</div>