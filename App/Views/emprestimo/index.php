<div class="container my-3">
  <div class="row">
    <div class="col-md-12">
      <a href="http://<?= APP_HOST ?>/emprestimo/cadastro" class="btn btn-secondary btn-sm">Adicionar</a>
    </div>

    <div class="col-md-12 mt-3">
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      if (!count($viewVar['listaEmprestimos'])) {
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
                <th>Taxa</th>
                <th>Valor</th>
                <th>Parcelas</th>
                <th>Parcelas Pagas</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $contas = $viewVar['listaContas'];
              foreach ($viewVar['listaEmprestimos'] as $emprestimo) {
                $conta = array_values(array_filter($contas, function ($conta) use ($emprestimo) {
                  return $conta->getId() === $emprestimo->getIdConta();
                }));
                ?>

                <tr>
                  <td>
                    <?= $emprestimo->getId() ?>
                  </td>
                  <td>
                    <?= $conta[0]->getNumero() ?>
                  </td>
                  <td>
                    <?= $emprestimo->getTaxa() . '%' ?>
                  </td>
                  <td>
                    <?= $emprestimo->getValorFormatado() ?>
                  </td>
                  <td>
                    <?= $emprestimo->getParcelas() ?>
                  </td>
                  <td>
                    <?= $emprestimo->getParcelasPagas() ?>
                  </td>


                  <td>
                    <a href="http://<?= APP_HOST ?>/emprestimo/edicao/<?= $emprestimo->getId() ?>"
                      class="btn btn-primary btn-sm">Editar</a>
                    <a href="http://<?= APP_HOST ?>/emprestimo/exclusao/<?= $emprestimo->getId() ?>"
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