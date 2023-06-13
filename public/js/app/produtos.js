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

    const screenWidth = $(window).width();

    let device = "";

    if (screenWidth >= 1200) {
      device = 'desktop';
    } else if (screenWidth >= 600) {
      device = 'tablet';
    } else {
      device = 'mobile';
    }


    fetch(url, { method: 'GET' })
      .then(response => response.json())
      .then(json => {
        json.forEach((val, i) => {
          let html = '';

          


          if (val.liberado == 'S') {
            html = `
              <form method="POST" action="leitor">
                <input type="hidden" name="pdf" value="${val.produto_id}">
                <input type="hidden" class="valid" name="csrf_name" value="${params[1]}">
                <input type="hidden" class="valid" name="csrf_value" value="${params[2]}">

                <button class="btn-product" type="submit">
                  <div class="card card-product mb-2" style="background-image: url('img/${device}/${val.imagem}.png')">
                    <div class="card-body">
                    </div>
                  </div>
                </button>
              </form>`;
          } else {
            html = `

            <a class="btn-product" href="wa.me/54991102959">
              <div class="card card-product mb-2" style="background-image: url('img/${val.imagem}.png')">
                <div class="card-body">
                  <i class="fa-solid fa-lock"></i>
                </div>
                <div class="blur-effect"></div>
              </div>
            </a>`;
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
