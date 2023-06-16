<?php
$parcelas = [
    1 => '1 Parcela',
    2 => '2 Parcelas',
    3 => '3 Parcelas',
    4 => '4 Parcelas',
    5 => '5 Parcelas',
    6 => '6 Parcelas',
    7 => '7 Parcelas',
    8 => '8 Parcelas',
    9 => '9 Parcelas',
    10 => '10 Parcelas',
    11 => '11 Parcelas',
    12 => '12 Parcelas',
];
?>


<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Cadastro de conta</h2>
            <form action="http://<?php echo APP_HOST; ?>/emprestimo/salvar" method="POST">
                <div class="mb-3">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" required>
                </div>
                <div class="mb-3">
                    <label for="parcelas" class="form-label">Em quantas parcelas deseja pagar?</label>
                    <select class="form-control" id="parcelas" name="parcelas" required>
                        <option value="">Selecione a quantidade de parcelas</option>
                        <?php foreach ($parcelas as $valor => $tipo): ?>
                            <option value="<?php echo $valor; ?>"><?php echo $tipo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </div>
</div>