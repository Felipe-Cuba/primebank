<div class="container">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <h1>Excluir Extrato</h1>

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
    $extrato = $viewVar['extrato'];

    $acao = '';

    if ($extrato->getAcao() === 'deposito') {
      $acao = "Depósito";
    } else if ($extrato->getAcao() === 'saque') {
      $acao = "Saque";
    } else {
      $acao = "Pagamento";
    }
    $conta = array_values(array_filter($contas, function ($conta) use ($extrato) {
      return $conta->getId() === $extrato->getIdConta();
    }));
    ?>

    <form action="http://<?php echo APP_HOST; ?>/extrato/excluir" method="post" id="form_cadastro">
      <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $extrato->getId(); ?>">

      <div class="panel panel-danger">
        <div class="panel-body">
          Deseja realmente esse extrato?

          <p class="my-3">
            Dados do extrato:
          </p>
          <p class="my-3">
            Conta:
            <b>
              <?= $conta[0]->getNumero() ?>
            </b>
          </p>
          <p class="my-3">
            Ação do extrato:
            <b>
              <?= $acao ?>
            </b>
          </p>
          <p class="my-3">
            Valor do extrato: <b>
              <?= $extrato->getValorFormatado() ?>
            </b>
          </p>

        </div>
        <br />
        <div class="panel-footer">
          <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
          <a href="http://<?php echo APP_HOST; ?>/extrato" class="btn btn-info btn-sm">Voltar</a>
        </div>
      </div>
    </form>
  </div>
  <div class=" col-md-3"></div>
</div>