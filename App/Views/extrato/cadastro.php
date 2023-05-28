<div class="container my-3">
    <div class="card text-start">
        <div class="card-body">
            <h1 class="card-title">Cadastro de Extrato</h1>
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <form class="form-group" action="http://<?php echo APP_HOST; ?>/emprestimo/salvar" method="post">
                <div class="mt-2">
                    <label class="form-lable" for="acao">acao:</label>
                    <input type="text" class="form-control" id="acao" name="acao" required> 
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="valor">valor:</label>
                    <input type="number" class="form-control" id="valor" name="valor" required>
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="data">data do cadastro:</label>
                    <input type="date-time" class="form-control" id="data" name="data" required> 
                </div>

                <button type="submit" class="btn btn-primary mt-2">Enviar</button>
                
            </form>
        </div>
    </div>

</div>