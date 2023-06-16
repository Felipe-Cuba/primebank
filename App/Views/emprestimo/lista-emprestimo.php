<div class="container my-3">
    <div class="row">
        <div class="col-md-12">
            <a href="http://<?= APP_HOST ?>/emprestimo/cadastro-emprestimo" class="btn btn-secondary btn-sm">Novo
                emprestimo</a>
        </div>

        <div class="col-md-12 mt-3">
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <?php
            if (!count($viewVar['listaEmprestimos'])) {
                ?>
                <div class="alert alert-info" role="alert">Nenhum emprestimo encontrado</div>
                <?php
            } else {
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark text-center table-bordered table-hover">
                            <tr>
                                <th>Número da conta</th>
                                <th>Taxa</th>
                                <th>Valor</th>
                                <th>Parcelas</th>
                                <th>Parcelas Pagas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conta = $viewVar['contaEmprestimo'];
                            foreach ($viewVar['listaEmprestimos'] as $emprestimo) {
                                ?>

                                <tr>
                                    <td>
                                        <?= $conta->getNumero() ?>
                                    </td>
                                    <td>
                                        <?= $emprestimo->getTaxa() . '%' ?>
                                    </td>
                                    <td>
                                        <?= $emprestimo->getValorFormatado() ?>
                                    </td>
                                    <td>
                                        <?= $emprestimo->getParcelas() ?>
                                    </td>
                                    <td>
                                        <?= $emprestimo->getParcelasPagas() ?>
                                    </td>

                                    <td>
                                        <a href="http://<?= APP_HOST ?>/emprestimo/pagar-parcela/<?= $emprestimo->getId() ?>"
                                            class="btn btn-primary btn-sm">Pagar parcela</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>