const inputNumber = document.getElementById('input-number');
const btnPlus = document.getElementById('btn-plus');
const btnMinus = document.getElementById('btn-minus');

btnPlus.addEventListener('click', function() {
  let value = parseInt(inputNumber.value);
  inputNumber.value = value + 1;
});

btnMinus.addEventListener('click', function() {
  let value = parseInt(inputNumber.value);
  if (value > 1) {
    inputNumber.value = value - 1;
  }
});

function calcularTroco() {
  const valorTotal = parseFloat(document.getElementById('valorTotal').value);
  const valorRecebido = parseFloat(document.getElementById('valorRecebido').value);

  if (valorRecebido >= valorTotal) {
    const troco = valorRecebido - valorTotal;
    document.getElementById('troco').value = troco.toFixed(2);
  } else {
    const novoValorTotal = valorTotal - valorRecebido;
    document.getElementById("valorTotal").value = novoValorTotal.toFixed(2);
    document.getElementById("troco").value = "Sem troco";
  }
}

