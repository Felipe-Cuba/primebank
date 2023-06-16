function verificarSaldo(saldoAtual, event) {
  var valorDigitado = parseFloat(document.getElementById("valor").value);

  if (valorDigitado > saldoAtual) {
    var alertElement = document.getElementById("warningAlert");
    var msgElement = document.getElementById("msg");

    msgElement.innerText = "Saldo insuficiente!";
    alertElement.hidden = false;

    event.preventDefault();
  }
}

// Função para verificar o saldo antes de enviar o formulário
function validarPagamentoParcela(radioId) {
  // Obtém o valor do saldo atual e o valor da parcela do HTML
  var saldoAtual = parseFloat(
    document.getElementById("saldo-conta").textContent.replace("R$", "").trim()
  );
  var valorParcela = parseFloat(
    document.getElementById("valor-parcela").value.replace("R$", "").trim()
  );

  // Verifica qual rádio está selecionado
  var radio = document.getElementById(radioId);
  if (radio.checked) {
    var tipoPagamento = radio.value;
    if (tipoPagamento === "1") {
      // Verifica se o saldo é suficiente

      console.log(saldoAtual, valorParcela)

      if (saldoAtual < valorParcela) {
        // Exibe o alerta de saldo insuficiente
        document.getElementById("warningAlert").hidden = false;
        document.getElementById("msg").textContent = "Saldo insuficiente.";

        // Bloqueia o envio do formulário
        document.getElementById("pagar").setAttribute("disabled", true);
      } else {
        // Habilita o envio do formulário
        document.getElementById("warningAlert").hidden = true;
        document.getElementById("pagar").removeAttribute("disabled");
      }
    } else if (tipoPagamento === "2") {
      // Habilita o envio do formulário
      document.getElementById("warningAlert").hidden = true;
      document.getElementById("pagar").removeAttribute("disabled");
    }
  }
}
