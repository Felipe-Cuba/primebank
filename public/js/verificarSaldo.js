function verificarSaldo(saldoAtual, event) {
  var valorDigitado = parseFloat(document.getElementById('valor').value);

  if (valorDigitado > saldoAtual) {
    var alertElement = document.getElementById('warningAlert');
    var msgElement = document.getElementById('msg');

    msgElement.innerText = 'Saldo insuficiente!';
    alertElement.hidden = false;

    event.preventDefault();
  }
}
