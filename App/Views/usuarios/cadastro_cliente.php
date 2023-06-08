<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .h2{
            background-color: #b2ba3f;

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
            color: #000000;
        }

        .container label,
        .container input {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            color: #000000;
        }

        .container input[type="text"],
        .container input[type="email"],
        .container input[type="password"] {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de usuario</h2>
        <form action="processar_cadastro.php" method="POST"> <div class="mt-2">
            <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">nome</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">sobrenome</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                  </div>

                <div class="mb-10 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Não sou robo</label>
                </div>
                <button type="button" class="btn btn-outline-info">Concluir</button>
        </form>
    </div>
</body>
</html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
