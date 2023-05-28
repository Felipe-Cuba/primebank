<div class="container my-3">
    <div class="card text-start">
        <div class="card-body">
            <h1 class="card-title">Cadastro Agencia</h1>
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <form class="form-group" action="http://<?php echo APP_HOST; ?>/agencia/salvar" method="post">

                <div class="mt-2">
                    <label class="form-lable" for="nome">Nome:</label>
                    <input type="text" class="form-control" id=" nome" name="nome" required> 
                </div>

                <button type="submit" class="btn btn-primary mt-2">Enviar</button>
                
            </form>
        </div>
    </div>

</div>