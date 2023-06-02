$(document).ready(function () {
  const input_cnpjf = $("#cnpjf");
  const formulario = $("#formulario")
  const csrf_name = $("input[name='csrf_name']").val();
  const csrf_value = $("input[name='csrf_value']").val();

  input_cnpjf.mask('000.000.000-00', { reverse: true });

  $("input[name='cnpjfCheck']").change(function () {
    if (this.value === "cpfCheck") {
      input_cnpjf.val("").attr("placeholder", "Informe o CPF");
      input_cnpjf.mask('000.000.000-00', { reverse: true });
    } else if (this.value === "cnpjCheck") {
      input_cnpjf.val("").attr("placeholder", "Informe o CNPJ");
      input_cnpjf.mask('00.000.000/0000-00', { reverse: true });
    }
  });

  formulario.submit(function () {
    const cliente = input_cnpjf.val();
    window.location.href = `produtos?cliente=${cliente}&csrf_name=${csrf_name}&csrf_value=${csrf_value}`
    return false;
  });
});
