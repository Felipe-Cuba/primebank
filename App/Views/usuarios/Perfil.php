<?php

$usuario = $viewVar['usuario'];
$conta = $viewVar['conta'];

$nomeCompleto = $usuario->getNome();
$primeiroNome = explode(' ', $nomeCompleto)[0];

?>

<div class="container my-3">
    <div class="row">
        <div class="col-md-12">
            <h2>Olá,
                <?php echo $primeiroNome; ?>
            </h2>
            <div class="container-fluid">
                <div class="row d-flex flex-row profile-text">
                    <div class="col-6">
                        <p>Configurações de conta</p>
                        <form class="p-0" action="">
                            <label for="">E-mail:</label> <br>
                            <input type="text" class="input-data" placeholder="exemplo@gmail.com"
                                value="<?php echo $usuario->getEmail(); ?>" disabled><br>

                            <label for="">Nome:</label><br>
                            <input type="text" class="input-data" placeholder="Bruno"
                                value="<?php echo $usuario->getNome(); ?>" disabled><br>

                            <label for="">Documento</label><br>
                            <input type="text" class="input-data" placeholder="documento..."
                                value="<?php echo $usuario->getDocumentoFormatado(); ?>" disabled>
                            <div class="col-md-12 d-flex flex-column  align-items-center alter-buttons mt-3">
                                <a href="http://<?php echo APP_HOST; ?>/usuarios/alterar-email"
                                    class="btn btn-primary col-12 mb-3">Alterar Email</a>
                                <a href="http://<?php echo APP_HOST; ?>/usuarios/alterar-documento"
                                    class="btn btn-primary col-12 mb-3">Alterar Documento</a>
                                <a href="http://<?php echo APP_HOST; ?>/usuarios/alterar-senha"
                                    class="btn btn-primary col-12">Alterar Senha</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="cart">
                            <label for="" class="font">Número da conta: </label>
                            <input type="text" class="conta" value="<?php echo $conta->getNumero(); ?>" disabled> <br>

                            <label for="" class="font">Saldo: </label>
                            <input type="text" class="conta" value="<?php echo $conta->getSaldoFormatado(); ?>"
                                disabled>
                        </div>

                        <div class="card my-5">
                            <span class="title m-0 span-0 text-center">Ações disponíves</span>
                            <div class="row d-flex flex-colunm align-items-center text-center">
                                <a href="http://<?php echo APP_HOST; ?>/extrato/extrato-conta"class="my-2 btn btn-secondary">Extrato</a>
                                <a href="http://<?php echo APP_HOST; ?>/conta/transacao/3"
                                    class="my-2 btn btn-secondary">Pagamento</a>
                                <a href="http://<?php echo APP_HOST; ?>/conta/transacao/2"
                                    class="my-2 btn btn-secondary">Deposito</a>
                                <a href="http://<?php echo APP_HOST; ?>/conta/transacao/1"
                                    class="my-2 btn btn-secondary">Saque</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>