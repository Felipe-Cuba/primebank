<div class="container my-3">
    <div class="card text-start">
        <div class="card-body">
            <h1 class="card-title">Registro de Emprestimo</h1>
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <form class="form-group" action="http://<?php echo APP_HOST; ?>/emprestimo/salvar" method="post">
                <div class="mt-2">
                    <label class="form-lable" for="valor">Valor do financiamento:</label>
                    <input type="number" class="form-control" id="valor" name="valor" required>
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="taxa">Taxa:</label>
                    <input type="number" class="form-control" id="taxa" name="taxa" required>
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="parcelas">Parcelas:</label>
                    <input type="number" class="form-control" id="parcelas" name="parcelas" required>
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="parcelasPagas">Parcelas pagas:</label>
                    <input type="number" class="form-control" id="parcelasPagas" name="parcelasPagas" required>
                </div>



                <button type="submit" class="btn btn-primary mt-2">Enviar</button>

            </form>
        </div>
    </div>

</div>