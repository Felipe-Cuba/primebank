<div class="container my-3">
  <div class="row">
    <div class="col-md-12 mt-3">
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      if (!count($viewVar['listaExtratos'])) {
        ?>
        <div class="alert alert-info" role="alert">Nenhum extrato encontrado</div>
        <?php
      } else {
        ?>

        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead class="table-dark text-center table-bordered table-hover">

              <th>Número da conta</th>
              <th>Ação</th>
              <th>Valor</th>
              <th>Data de Cadastro</th>

              </tr>
            </thead>
            <tbody>
              <?php


              $conta = $viewVar['contaExtrato'];
              foreach ($viewVar['listaExtratos'] as $extrato) {
                ?>


                <tr>
                  <td>
                    <?= $conta->getNumero() ?>
                  </td>
                  <td>
                    <?= $extrato->getAcao() ?>
                  </td>

                  <td>
                    <p
                      class="m-0 p-0 extrato-valor value-<?= $extrato->getAcao() === TIPOS_TRANSACAO[2] ? 'green' : 'red' ?>">
                      <?= $extrato->getValorFormatado() ?>
                    </p>
                  </td>

                  <td>
                    <?= $extrato->getDataCadastro()->format('d/m/Y') ?>
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