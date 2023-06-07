<div>
    <link rel="stylesheet" href="usuario.css">
</div>
<div>
    <div class="card">
        <div class="center">
            <img src="./img/perfil.jpg" alt=""><br><br>
            <h2>Olá, Bruno</h2>
        </div>
    </div>
    <div class="cart">
        <p >Configurações de conta</p>
        <form action="">
            <label for="">E-mail:</label> <br>
            <input type="text" placeholder="exemplo@gmail.com" disabled><br>
            
            <label for="">Nome:</label><br>
            <input type="text" placeholder="Bruno" disabled><br>

            <label for="">Documento</label><br>
            <input type="text" placeholder="documento..." disabled>
            <button>Alterar documento</button>

            <a href="./alterSenha.php"><button>Alterar senha</a></button>
        </form>
    </div>
    <div class="cart">
        <label for="" class="font">Número da conta: </label>
        <input type="text" class="conta" value="8936" disabled> <br>

        <label for=""class="font">Saldo: </label>
        <input type="text" class="conta" value="R$ 5.000,00" disabled>
    </div>
    <div class="cart movimentos card">
        <h1>O que deseja fazer?</h1><br>
        <button>Pagamento</button>
        <button>Deposito</button>
        <button>Saque</button>
    </div>
</div>