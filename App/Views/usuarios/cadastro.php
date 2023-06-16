<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Cadastro de conta</h2>
            <form action="http://<?php echo APP_HOST; ?>/usuarios/cadastrar" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="documento" class="form-label">Documento (CPF/CNPJ)</label>
                    <input type="text" class="form-control" id="documento" name="documento" required>
                </div>
                <div class="mb-3">
                    <label for="data_nasc" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="mb-3">
                    <label for="agencia" class="form-label">Agência</label>
                    <select class="form-control" id="agencia" name="agencia" required>
                        <option value="">Selecione a Agência</option>
                        <?php foreach ($viewVar['agencias'] as $agencia) { ?>
                            <option value="<?php echo $agencia->getid(); ?>"><?php echo $agencia->getNome(); ?> - <?php echo $agencia->getNumero(); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipo_conta" class="form-label">Tipo de Conta</label>
                    <select class="form-control" id="tipo_conta" name="tipo_conta" required>
                        <option value="">Selecione o Tipo de Conta</option>
                        <?php foreach (TIPOS_CONTA as $valor => $tipo): ?>
                            <option value="<?php echo $valor; ?>"><?php echo $tipo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <span class="register-link">Já possui uma conta? <a
                            href="http://<?php echo APP_HOST; ?>/usuarios/login" class="link-primary">Clique
                            aqui</a></span>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </div>
</div>