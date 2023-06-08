<!DOCTYPE html>
<html>
<head>
    <title>Solicitação de Investimento - PrimeBank</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 600px;
            max-width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: goldenrod;
        }

        .container label,
        .container input {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            color: #000000;
        }

        .container input[type="valor"],
        .container input[type="parcelas"]{
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2)
        }
        .container input[type="submit"]:hover {
            background-color: #ffcc00;
        }

        .container input[type="submit"]:focus {
            outline: none;
        }

        .container input::placeholder {
            color: #2e1bba;
        }
        .btn{
            width: 100%;
        }
        ul {
        list-style-type: none;
    }

    </style>
</head>
<body>
    <div class="container">
        <h2>PrimeBank - Transações</h2>
        <p>Olá! Você está prestes a fazer uma transação no PrimeBank.</p>
        <p>Por favor, preencha o formulário abaixo com os dados solicitados para prosseguir com sua transação:</p>
        <form action="processar_cadastro.php" method="POST"> <div class="mt-2">
            <form>
                <div class="mt-2">
                    <label class="form-label" for="tipo">Tipo de transação:</label>
                    <select class="form-control" id="tipo" name="tipo" required>
                        <option value="">Selecione o tipo de transação</option>
                        <option value="renda fixa">Pagamento</option>
                        <option value="renda variavel">Deposito</option>
                        <option value="tesouro direto">Saque</option>
                    </select>
                </div>
                
                <div class="mt-2">
                    <label class="form-label" for="valor">Valor da transação:</label>
                    <input type="number" class="form-control" id="valor" name="valor" required>
                </div>
                <button type="button" class="btn btn-outline-info">Enviar Valor</button>
        </form>
    </div>
</body>
</html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
