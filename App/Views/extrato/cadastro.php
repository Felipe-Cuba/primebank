<div class="container my-3">
    <div class="card text-start">
        <div class="card-body">
            <h1 class="card-title">Cadastro de Extrato</h1>
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>
            <form class="form-group" action="http://<?php echo APP_HOST; ?>/extrato/salvar" method="post">
                <div class="mt-2">
                    <label class="form-lable" for="acao">Ação:</label>
                    <select class="form-control" id="acao" name="acao" required>
                        <option value="">Selecione uma ação</option>
                        <option value="deposito">Depósito</option>
                        <option value="saque">Saque</option>
                        <option value="pagamento">Pagamento</option>
                    </select>
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="valor">Valor:</label>
                    <input type="number" class="form-control" id="valor" name="valor" required>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Enviar</button>

            </form>
        </div>
    </div>

</div>