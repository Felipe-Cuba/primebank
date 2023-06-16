<?php

$usuarioId = $Sessao::get('usuario_id');
$tipoUsuario = $Sessao::get('usuario_tipo');
$nomeUsuario = $Sessao::get('usuario_nome');

$primeiroNome = explode(' ', $nomeUsuario)[0];
?>

<div class="container home-page">
    <?php if (is_null($usuarioId)): ?>
        <h1 class="mt-5">Bem-vindo ao PrimeBank</h1>
        <p>Seu banco confiável para todas as suas necessidades financeiras.</p>
        <a href="http://<?php echo APP_HOST; ?>/usuarios/login" class="btn btn-primary">Acessar conta</a>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Conta</h2>
                        <p class="card-text">Gerencie suas finanças diárias com a nossas contas fáceis de usar.</p>
                        <a href="http://<?php echo APP_HOST; ?>/usuarios/cadastro" class="btn btn-secondary">Abrir conta</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Empréstimos</h2>
                        <p class="card-text">Obtenha o financiamento necessário para alcançar seus objetivos.</p>
                        <a href="http://<?php echo APP_HOST; ?>/usuarios/cadastro" class="btn btn-secondary">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Investimentos</h2>
                        <p class="card-text">Faça seu dinheiro crescer com nossas opções de investimento.</p>
                        <a href="http://<?php echo APP_HOST; ?>/usuarios/cadastro" class="btn btn-secondary">Explore</a>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($tipoUsuario === TIPOS_USUARIO[1]): ?>
        <h1 class="mt-5">Bem-vindo,
            <?php echo $primeiroNome; ?>!
        </h1>
        <p class="lead">Você está logado como administrador no PrimeBank.</p>


    <?php else: ?>
        <!-- Content for non-admin users -->
        <h1 class="mt-5">Bem-vindo,
            <?php echo $primeiroNome; ?>!
        </h1>
        <p class="lead">Você está logado como cliente no PrimeBank.</p>
        <!-- Add content specific to the non-admin user -->
        <p>Aqui estão algumas opções disponíveis para você:</p>
        <ul class="list-group home-list">
            <li class="list-group-item">Gerenciamento de contas</li>
            <li class="list-group-item">Realização de transferências</li>
            <li class="list-group-item">Acompanhamento de extratos</li>
            <!-- Add more options as needed -->
        </ul>

        <a href="http://<?php echo APP_HOST; ?>/usuarios/perfil" class="btn btn-primary mt-4">Acessar Perfil</a>
        <a href="http://<?php echo APP_HOST; ?>/investimento/lista-investimento" class="btn btn-primary mt-4">Acessar
            Investimentos</a>
        <a href="http://<?php echo APP_HOST; ?>/emprestimo/lista-emprestimo" class="btn btn-primary mt-4">Acessar
            Emprestimos</a>
    <?php endif; ?>
</div>