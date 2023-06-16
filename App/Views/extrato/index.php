<div class="container my-3">
  <div class="row">
    <div class="col-md-12">
      <a href="http://<?= APP_HOST ?>/extrato/registro" class="btn btn-secondary btn-sm">Adicionar</a>
    </div>

    <div class="col-md-12 mt-3">
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      if (!count($viewVar['listaExtratos'])) {
        ?>
        <div class="alert alert-info" role="alert">Nenhum investimento encontrado</div>
        <?php
      } else {
        ?>

        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead class="table-dark text-center table-bordered table-hover">
              <tr>
                <th>ID</th>
                <th>Número da conta</th>
                <th>Ação</th>
                <th>Valor</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php


              $contas = $viewVar['listaContas'];
              foreach ($viewVar['listaExtratos'] as $extrato) {
                $conta = array_values(array_filter($contas, function ($conta) use ($extrato) {
                  return $conta->getId() === $extrato->getIdConta();
                }));
                ?>


                <tr>
                  <td>
                    <?= $extrato->getId() ?>
                  </td>
                  <td>
                    <?= $conta[0]->getNumero() ?>
                  </td>
                  <td>
                    <?= $extrato->getAcao() ?>
                  </td>

                  <td>
                    <?= $extrato->getValorFormatado() ?>
                  </td>

                  <td>
                    <?= $extrato->getDataCadastro()->format('d/m/Y') ?>
                  </td>

                  <td>
                    <a href="http://<?= APP_HOST ?>/extrato/edicao/<?= $extrato->getId() ?>"
                      class="btn btn-primary btn-sm">Editar</a>
                    <a href="http://<?= APP_HOST ?>/extrato/exclusao/<?= $extrato->getId() ?>"
                      class="btn btn-danger btn-sm">Excluir</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>