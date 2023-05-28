<div class="container my-3">
    <div class="card text-start">
        <div class="card-body">
            <h1 class="card-title">Cadastro de Emprestimo</h1>
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <form class="form-group" action="http://<?php echo APP_HOST; ?>/emprestimo/salvar" method="post">
                <div class="mt-2">
                    <label class="form-lable" for="valor">valor do financiamento:</label>
                    <input type="number" class="form-control" id="valor" name="valor" required> 
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="taxa">taxa:</label>
                    <input type="number" class="form-control" id="taxa" name="taxa" required>
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="parcelas">parcelas:</label>
                    <input type="number" class="form-control" id="parcelas" name="parcelas" required> 
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="parcelaspagas">parcelas pagas:</label>
                    <input type="number" class="form-control" id="parcelaspagas" name="parcelaspagas" required> 
                </div>



                <button type="submit" class="btn btn-primary mt-2">Enviar</button>
                
            </form>
        </div>
    </div>

</div>