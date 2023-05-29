<div class="container my-3">
    <div class="card text-start">
        <div class="card-body">
            <h1 class="card-title">Cadastro de Investimento</h1>
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <form class="form-group" action="http://<?php echo APP_HOST; ?>/investimento/salvar" method="post">
                <div class="mt-2">
                    <label class="form-lable" for="tipo">Tipo de investimento:</label>
                    <select class="form-control" id="tipo" name="tipo" required>
                        <option value="">Selecione um tipo de investimento</option>
                        <option value="renda fixa">Renda Fixa</option>
                        <option value="renda variavel">Renda Variável</option>
                        <option value="tesouro direto">Tesouro Direto</option>
                        <option value="fundo imobiliario">Fundo Imobiliário</option>
                    </select>
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="taxa">Taxa:</label>
                    <input type="number" class="form-control" id="taxa" name="taxa" required>
                </div>

                <div class="mt-2">
                    <label class="form-lable" for="valor">Valor do financiamento:</label>
                    <input type="number" class="form-control" id="valor" name="valor" required>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Enviar</button>

            </form>
        </div>
    </div>

</div>