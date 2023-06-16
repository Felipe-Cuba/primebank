<div class="container my-3">
  <div class="row">
    <!-- <div class="col-md-12">
      <a href="http://<?= APP_HOST ?>/investimento/registro" class="btn btn-secondary btn-sm">Adicionar</a>
    </div> -->

    <div class="col-md-12 mt-3">
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      if (!count($viewVar['listaInvestimentos'])) {
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
                <th>Tipo de investimento</th>
                <th>Taxa</th>
                <th>Valor</th>
                <th>Valor taxado</th>
                <!-- <th>Ações</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              $contas = $viewVar['listaContas'];
              foreach ($viewVar['listaInvestimentos'] as $investimento) {
                $conta = array_values(array_filter($contas, function ($conta) use ($investimento) {
                  return $conta->getId() === $investimento->getIdConta();
                }));
                ?>

                <tr>
                  <td>
                    <?= $investimento->getId() ?>
                  </td>
                  <td>
                    <?= $conta[0]->getNumero() ?>
                  </td>
                  <td>
                    <?= $investimento->getTipoInvestimento() ?>
                  </td>
                  <td>
                    <?= ($investimento->getTaxa() * 100) . '%' ?>
                  </td>
                  <td>
                    <?= $investimento->getValorFormatado() ?>
                  </td>
                  <td>
                    <?= $investimento->getValorTaxadoFormatado() ?>
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