$(document).ready(function () {
  const input_cnpjf = $("#cnpjf");
  const form = $("#formulario")
  const csrf_name = $("input[name='csrf_name']").val();
  const csrf_value = $("input[name='csrf_value']").val();

  var CpfCnpjMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
  }, cpfCnpjpOptions = {
      onKeyPress: function (val, e, field, options) {
        field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
      }
    };

  input_cnpjf.mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);

  form.submit(() => {
    if (!valida_cpf_cnpj(input_cnpjf.val())) {
      input_cnpjf.addClass('is-invalid');
    } else {
      const cliente = input_cnpjf.val().replace(/[^0-9]/g, '');
      window.location.href = `produtos?cliente=${cliente}&csrf_name=${csrf_name}&csrf_value=${csrf_value}`
    }

    return false;
  });

});