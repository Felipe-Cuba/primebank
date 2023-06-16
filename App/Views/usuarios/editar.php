<div class="container my-3">
  <div class="card text-start">
    <div class="card-body">
      <h1 class="card-title">Atualizar Usuário</h1>

      <form class="form-group"
        action="http://<?php echo APP_HOST; ?>/usuarios/atualizar/<?= $viewVar['usuario']->getId() ?>" method="post">
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
          <label class="form-lable" for="documento">Documento:</label>
          <input type="text" class="form-control" id="documento" name="documento"
            value="<?php echo $viewVar['usuario']->getDocumentoFormatado(); ?>" readonly>
          <input class="form--control" type="hidden" id="documento_sem_formatacao" name="documento_sem_formatacao" />
        </div>
        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
      </form>
    </div>
  </div>

</div>