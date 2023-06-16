<div class="container my-3">
    <div class="card text-start">
        <div class="card-body">
            <h1 class="card-title">Registrar usuário</h1>
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <form class="form-group" action="http://<?php echo APP_HOST; ?>/usuarios/registrar" method="post">
                <div class="mt-2">
                    <label class="form-lable" for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mt-2">
                    <label class="form-lable" for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mt-2">
                    <label class="form-lable" for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="mt-2">
                    <label class="form-lable" for="documento">Documento:</label>
                    <input type="text" class="form-control" id="documento" name="documento" required>
                </div>
                <div class="mt-2">
                    <label class="form-lable" for="data_nasc">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
                </div>
                <div class="mb-3">
                    <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                    <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                        <option value="">Selecione o Tipo de Usuario</option>
                        <?php foreach (TIPOS_USUARIO as $valor => $tipo): ?>
                            <option value="<?php echo $valor; ?>"><?php echo $tipo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Enviar</button>
            </form>
        </div>
    </div>

</div>