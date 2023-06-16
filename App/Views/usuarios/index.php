<div class="container my-3">
    <div class="row">
        <div class="col-md-12">
            <a href="http://<?= APP_HOST ?>/usuarios/registro" class="btn btn-secondary btn-sm">Adicionar</a>
        </div>

        <div class="col-md-12 mt-3">
            <?php if ($Sessao::returnMessage()) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $Sessao::returnMessage(); ?>
                </div>
            <?php } ?>

            <?php
            if (!count($viewVar['listaUsuarios'])) {
                ?>
                <div class="alert alert-info" role="alert">Nenhum usuário encontrado</div>
                <?php
            } else {
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark text-center table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Documento</th>
                                <th>Data de Nascimento</th>
                                <th>Data de Cadastro</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($viewVar['listaUsuarios'] as $user) { ?>
                                <tr>
                                    <td>
                                        <?= $user->getId() ?>
                                    </td>
                                    <td>
                                        <?= $user->getNome() ?>
                                    </td>
                                    <td>
                                        <?= $user->getEmail() ?>
                                    </td>
                                    <td>
                                        <?= $user->getDocumentoFormatado() ?>
                                    </td>
                                    <td>
                                        <?= $user->getDataNasc()->format('d/m/Y') ?>
                                    </td>
                                    <td>
                                        <?= $user->getDataCadastro()->format('d/m/Y') ?>
                                    </td>
                                    <td>
                                        <?= $user->getTipo() ?>
                                    </td>

                                    <td>
                                        <a href="http://<?= APP_HOST ?>/usuarios/edicao/<?= $user->getId() ?>"
                                            class="btn btn-primary btn-sm">Editar</a>
                                        <a href="http://<?= APP_HOST ?>/usuarios/exclusao/<?= $user->getId() ?>"
                                            class="btn btn-danger btn-sm">Excluir</a>
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