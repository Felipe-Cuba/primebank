<div class="container my-3">
  <div class="row">
    <div class="col-md-12">
      <a href="http://<?= APP_HOST ?>/conta/registro" class="btn btn-secondary btn-sm">Adicionar</a>
    </div>

    <div class="col-md-12 mt-3">
      <?php if ($Sessao::returnMessage()) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $Sessao::returnMessage(); ?>
        </div>
      <?php } ?>

      <?php
      if (!count($viewVar['listaContas'])) {
        ?>
        <div class="alert alert-info" role="alert">Nenhuma conta encontrado</div>
        <?php
      } else {
        ?>

        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead class="table-dark text-center table-bordered table-hover">
              <tr>
                <th>ID</th>
                <th>Agencia</th>
                <th>Número da conta</th>
                <th>Tipo de conta</th>
                <th>Saldo</th>
                <th>Usuário</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $contas = $viewVar['listaContas'];
              $usuarios = $viewVar['listaUsuarios'];
              $agencias = $viewVar['listaAgencias'];
              foreach ($contas as $conta) {
                $usuario = array_values(array_filter($usuarios, function ($usuario) use ($conta) {
                  return $usuario->getId() === $conta->getUsuario();
                }));

                $agencia = array_values(array_filter($agencias, function ($agencia) use ($conta) {
                  return $agencia->getId() === $conta->getIdAgencia();
                }));

                ?>

                <tr>
                  <td>
                    <?= $conta->getId() ?>
                  </td>
                  <td>
                    <?= $agencia[0]->getNome() ?>
                  </td>
                  <td>
                    <?= $conta->getNumero() ?>
                  </td>
                  <td>
                    <?= $conta->getTipoconta() ?>
                  </td>

                  <td>
                    <?= $conta->getSaldoFormatado() ?>
                  </td>
                  <td>
                    <?= $usuario[0]->getNome() ?>
                  </td>

                  <td>
                    <a href="http://<?= APP_HOST ?>/conta/edicao/<?= $conta->getId() ?>"
                      class="btn btn-primary btn-sm">Editar</a>
                    <a href="http://<?= APP_HOST ?>/conta/exclusao/<?= $conta->getId() ?>"
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