<div class="container my-3">
  <div class="row">
    <div class="col-md-12">
      <a href="http://<?= APP_HOST ?>/agencia/cadastro" class="btn btn-secondary btn-sm">Adicionar</a>
    </div>

    <div class="col-md-12 mt-3">
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      if (!count($viewVar['listaAgencias'])) {
        ?>
        <div class="alert alert-info" role="alert">Nenhum usuário encontrado</div>
        <?php
      } else {
        ?>

        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead class="table-dark text-center table-bordered table-hover">
              <tr>
                <th>ID</th>
                <th>Numero</th>
                <th>Nome</th>
                <th>Banco</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $agencias = $viewVar['listaAgencias'];
              $bancos = $viewVar['listaBancos'];
              foreach ($agencias as $agencia) {
                $banco = array_values(array_filter($bancos, function ($banco) use ($agencia) {
                  return $banco->getId() === $agencia->getIdBanco();
                }))[0];
                ?>

                <tr>
                  <td>
                    <?= $agencia->getId() ?>
                  </td>
                  <td>
                    <?= $agencia->getNumero() ?>
                  </td>
                  <td>
                    <?= $agencia->getNome() ?>
                  </td>
                  <td>
                    <?= $banco->getNome() ?>
                  </td>
                  <td>
                    <a href="http://<?= APP_HOST ?>/agencia/edicao/<?= $agencia->getId() ?>"
                      class="btn btn-primary btn-sm">Editar</a>
                    <a href="http://<?= APP_HOST ?>/agencia/exclusao/<?= $agencia->getId() ?>"
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