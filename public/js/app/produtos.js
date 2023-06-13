$(document).ready(function () {
  var divProducts = $("#products");

  const buscar_cliente = () => {
    const query = window.location.search;
    const params = new URLSearchParams(query);

    const parametros = [];

    const cliente = params.get('cliente');
    const csrf_name = params.get('csrf_name');
    const csrf_value = params.get('csrf_value');

    parametros.push(cliente);
    parametros.push(csrf_name);
    parametros.push(csrf_value);

    return parametros;
  };

  const buscar_produtos = (params) => {
    const csrfParams = `&csrf_name=${params[1]}&csrf_value=${params[2]}`;
    const url = `produtos/consultar?cliente=${params[0]}${csrfParams}`;

    fetch(url, { method: 'GET' })
      .then(response => response.json())
      .then(json => {
        json.forEach((val, i) => {
          let html = '';

          if (val.liberado == 'S') {
            html = `
              <form method="POST" action="leitor/arquivo">
                <input type="hidden" name="pdf" value="${val.produto_id}">
                <input type="hidden" class="valid" name="csrf_name" value="${params[1]}">
                <input type="hidden" class="valid" name="csrf_value" value="${params[2]}">

                <div class="card card-product mb-2">
                  <div class="card-body"> 
                    <div class="title-product">
                      <h4>${val.nome_produto}</h4>
                    </div>
                  </div>
                </div>

                <button type"submit">teste</button>
              </form>`;
          } else {
            html = `
              <div class="card card-product mb-2">
                <div class="card-body"> 
                  <div class="title-product">
                    <h4>${val.nome_produto}</h4>
                  </div>
                </div>
              </div>`;
          }

          divProducts.append(html);
        });

      })
      .catch(error => {
        console.log(error);
      });
  };

  const params = buscar_cliente();
  buscar_produtos(params);
});
