<div class="container my-3">
    <div class="card text-start">
        <div class="card-body">
            <h1 class="card-title">Registro de banco</h1>
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <form class="form-group" action="http://<?php echo APP_HOST; ?>/banco/salvar" method="post">
                <div class="mt-2">
                    <label class="form-lable" for="nome">nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required> 
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="numero">numero:</label>
                    <input type="number" class="form-control" id="numero" name="numero" required>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Enviar</button>
                
            </form>
        </div>
    </div>

</div>