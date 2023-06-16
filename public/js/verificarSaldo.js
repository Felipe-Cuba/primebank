const convertToNumber = (value) => {
  const numberFormatRegex = /^[\d.,]+$/;
  if (typeof value === 'number') {
    return value;
  }
  let number = value.replace(/\s{1}/, '').replace('R$', '').replace('.', '');

  if (!number || !numberFormatRegex.test(number)) {
    return 0.0;
  }
  number = number.replace(',', '.');
  return Number(number);
};

const toDecimal = (value) => {
  return parseFloat(Number(value).toFixed(2));
};

function verificarSaldo(saldoAtual, event) {
  const valorDigitado = parseFloat(document.getElementById('valor').value);

  if (valorDigitado > saldoAtual) {
    const alertElement = document.getElementById('warningAlert');
    const msgElement = document.getElementById('msg');

    msgElement.textContent = 'Saldo insuficiente!';
    alertElement.hidden = false;

    event.preventDefault();
  }
}

function validarPagamentoParcela(radioId) {
  const saldoAtual = convertToNumber(
    document.getElementById('saldo-conta').textContent.replace('R$', '').trim()
  );
  const valorParcela = toDecimal(
    document.getElementById('valor-parcela').value.replace('R$', '').trim()
  );

  // console.log(toDecimal(saldoAtual), toDecimal(valorParcela));

  const radio = document.getElementById(radioId);
  if (radio.checked) {
    const tipoPagamento = radio.value;
    if (tipoPagamento === '1') {
      if (saldoAtual < valorParcela) {
        document.getElementById('warningAlert').hidden = false;
        document.getElementById('msg').textContent = 'Saldo insuficiente.';

        document.getElementById('pagar').setAttribute('disabled', true);
      } else {
        document.getElementById('warningAlert').hidden = true;
        document.getElementById('pagar').removeAttribute('disabled');
      }
    } else if (tipoPagamento === '2') {
      document.getElementById('warningAlert').hidden = true;
      document.getElementById('pagar').removeAttribute('disabled');
    }
  }
}
