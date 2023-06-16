<div class="container my-3">
  <div class="row">
    <div class="col-md-12">
      <a href="http://<?= APP_HOST ?>/banco/registro" class="btn btn-secondary btn-sm">Adicionar</a>
    </div>

    <div class="col-md-12 mt-3">
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      if (!count($viewVar['listaBancos'])) {
        ?>
        <div class="alert alert-info" role="alert">Nenhum banco encontrado</div>
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
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $bancos = $viewVar['listaBancos'];
              foreach ($bancos as $banco) {
                ?>

                <tr>
                  <td>
                    <?= $banco->getId() ?>
                  </td>
                  <td>
                    <?= $banco->getNumero() ?>
                  </td>
                  <td>
                    <?= $banco->getNome() ?>
                  </td>
                  <td>
                    <a href="http://<?= APP_HOST ?>/banco/edicao/<?= $banco->getId() ?>"
                      class="btn btn-primary btn-sm">Editar</a>
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