<?php

$conta = $viewVar['conta'];

$valor_parcela = $viewVar['valor_parcela'];
$valor_parcela_formatado = $viewVar['valor_parcela_formatado'];

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <div id="warningAlert" class="alert alert-warning" role="alert" hidden>
                <span id="msg"></span>
            </div>

            <h2>Pagar parcela</h2>
            <form action="http://<?php echo APP_HOST; ?>/emprestimo/finalizar/<?= $viewVar['id_emprestimo'] ?>" method="POST">
                <div class="mb-3">
                    <small>Saldo da Conta: <span id="saldo-conta">
                            <?= $conta->getSaldoFormatado() ?>
                        </span></small>
                </div>
                <div class="mb-3">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" required
                        value="<?= $valor_parcela_formatado ?>" readonly>
                    <input type="hidden" id="valor-parcela" name="valor_parcela" value="<?= $valor_parcela ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de Pagamento</label><br>
                    <?php foreach (TIPOS_PAGAMENTO as $key => $tipo): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo_pagamento"
                                id="tipo_pagamento_<?= $key ?>" value="<?= $key ?>" required
                                onchange="validarPagamentoParcela('tipo_pagamento_<?= $key ?>');">
                            <label class="form-check-label" for="tipo_pagamento_<?= $key ?>"><?= $tipo ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="submit" id="pagar" class="btn btn-primary">Pagar</button>
            </form>
        </div>
    </div>
</div>