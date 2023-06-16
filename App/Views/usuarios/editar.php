<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Atualizar Usuário</h1>

      <?php if ($Sessao::returnError()) { ?>
        <div class="alert alert-warning" role="alert">
          <a href="" class="close" data-dismiss="alert" aria-label="close"><i class="bi bi-x-square"></i></a>
          <?php foreach ($Sessao::returnError() as $key => $mensagem) { ?>
            <?php echo $mensagem; ?> <br>
          <?php } ?>
        </div>
      <?php } ?>

      <form class="form-group" action="http://<?php echo APP_HOST; ?>/usuarios/atualizar" method="post">
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->getId(); ?>">
        <div class="mt-2">
          <label class="form-lable" for="nome">Nome:</label>
          <input type="text" class="form-control" id="nome" name="nome"
            value="<?php echo $viewVar['usuario']->getNome(); ?>" required>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="email">E-mail:</label>
          <input type="email" class="form-control" id="email" name="email"
            value="<?php echo $viewVar['usuario']->getEmail(); ?>" required>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="senha">Senha:</label>
          <input type="password" class="form-control" id="senha" name="senha"
            value="<?php echo $viewVar['usuario']->getSenha(); ?>" required>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="documento">Documento:</label>
          <input type="text" class="form-control" id="documento" name="documento"
            value="<?php echo $viewVar['usuario']->getDocumento(); ?>" required>
        </div>
        <div class="mt-2">
          <label class="form-lable" for="data_nasc">Data de Nascimento:</label>
          <input type="date" class="form-control" id="data_nasc" name="data_nasc"
            value="<?php echo $viewVar['usuario']->getDataNasc()->format('Y-m-d'); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
      </form>
    </div>
  </div>

</div>