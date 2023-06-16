<?php
if (isset($_GET['wrong'])) {
    $wrong = true;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php if (isset($wrong)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Senha errada! Para prosseguir digite sua senha antiga corretamente." ?>
                </div>
            <?php endif; ?>

            <h2>Alterar senha</h2>
            <form action="http://<?php echo APP_HOST; ?>/usuarios/change" method="POST">
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha antiga</label>
                    <input type="password" class="form-control" id="senha" name="senha_antiga" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Nova senha</label>
                    <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
                </div>
                <button type="submit" class="btn btn-primary">Alterar</button>
            </form>
        </div>
    </div>
</div>