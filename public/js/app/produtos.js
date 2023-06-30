$(document).ready(function () {
  const mascara = $("#mascara");
  var divProducts = $("#products");
  var modalProdutos = $("#modal_products");

  modalProdutos.on("click", ".close-modal", function () {
    modalProdutos.modal("hide");
  });

  const ObterDispositivo = (screenWidth) => {
    if (screenWidth >= 1000) {
      return 'desktop';
    } else if (screenWidth >= 600) {
      return 'tablet';
    } else {
      return 'mobile';
    }
  };

  const ObterItem = (productId) => {


    /*
      Caminho da Riqueza - #36673
      Comunidade da Riqueza (SEMESTRAL) - #76587
      Comunidade da Riqueza (ANUAL) - #76204 
      MÉTODO: Ganhe mais dinheiro com as suas finanças - #71102 
    */
    //https://api.whatsapp.com/send/?phone=5491025477& 
    const items = {
      '36673': { tipo: 'pdf', file: 'ebook.pdf', linkAlt: 'https://seucaminhodariqueza.com.br/caminhodariqueza?utm_content=area-de-membros' },
      '76587': { tipo: 'link', link: 'https://www.redirectmais.com/run/8978', linkAlt: 'https://seucaminhodariqueza.com.br/comunidade/?utm_content=area-membros' },
      '76204': { tipo: 'link', link: 'https://www.redirectmais.com/run/8978', linkAlt: 'https://seucaminhodariqueza.com.br/comunidade/?utm_content=area-membros' },
      '71102': {
        tipo: 'video',
        linkAlt: 'https://seucaminhodariqueza.com.br/metodo-ganhe/?utm_content=area-membros',
        videos: [
          { nome: 'INTRO CURSO', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f' },
          { nome: 'Trocando de conta', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9a8b3ee7-32dc-406f-ace7-5b737e3743ea' },
          { nome: 'Extrato e uso do Meu INSS', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=65c7c03b-8de5-4a30-9975-a135dab28111' },
          { nome: 'Consulte o seu Extrato', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=fa67df6e-bbb1-4232-a726-1c6c400072d6' },
          { nome: 'Domine suas contas', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=4a292c03-bf7b-4dae-a6cc-946a7a90cd8c' },
          { nome: 'Dinheiro no seu bolso', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=21723dd7-a066-403d-9338-3ddb1c3e9cb7' },
          { nome: 'Ganhe dinheiro de volta do seguro ', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=87998b87-3e4d-4b59-8b4c-360c60cdee92' },
          { nome: 'Passo a passo para recebr essa grana', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=7e846a60-8e06-420c-b113-4fe0013d6187' },
          { nome: 'Ganhe $ com o seguro do seu cartão de crédito', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=987f25b9-bc3f-4584-9687-927a3176609d' },
          { nome: 'Ganhe dinheiro com a sua conta de luz', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=8acd5bf1-bbb6-4913-b47d-79d7a5862203' },
          { nome: 'Receba de volta essa tarifa', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=4a8177b2-1f29-4f45-b56b-22150b8e4bf8' },
          { nome: 'Como funciona o cartão de crédito', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=7c62dadb-d494-47f9-b583-535df06a52e6' },
          { nome: 'Os bancos não querem que você saiba disso', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=957991d2-ae61-42af-b6ee-f5fbb3d27f32' },
          { nome: 'Compra sem juros no cartão', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=7f47a55d-7383-4949-8e49-d9368669329b' },
          { nome: 'Qual o melhor cartão pra você', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=a32256da-a71c-4d09-8cdd-4385efc8d50c' },
          { nome: 'Troque de cartão e ganhe dinheiro', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=3d814d15-4bb3-433c-9f96-0947f76b4af4' },
          { nome: 'Sua conta sem despesas', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=012e8166-513f-4965-8c79-682ee135a3ec' },
          { nome: 'Não caia nisso!', link: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=b3611c0d-d15b-4fb2-aacf-f1ee9a3bf325' },
        ]
      }
    };

    return items[productId];
  };

  const CardVideo = (device, productId, productName, linkAlt, isLiberado) => {

    if (productName === null) {
      productName = 'MÉTODO GANHE + DIN';
    }

    if (isLiberado) {
      return `
        <a class="btn-product open-modal" data-value="${productId}" data-name="${productName}" href="#">
          <div class="card card-product mb-2" style="background-image: url('img/${device}/${productId}.png?v=1')">
            <div class="card-body"></div>
          </div>
        </a>`;
    } else {
      return `
        <a class="btn-product" href="${linkAlt}">
          <div class="card card-product mb-2" style="background-image: url('img/${device}/${productId}.png?v=1')">
            <div class="card-body">
              <i class="fa-solid fa-lock"></i>
            </div>
            <div class="blur-effect"></div>
          </div>
        </a>`;
    }
  };

  const CardPDF = (device, productId, file, linkAlt, isLiberado, csrfName, csrfValue) => {
    if (isLiberado) {
      return `
        <form method="POST" action="leitor">
          <input type="hidden" name="pdf" value="${file}">
          <input type="hidden" class="valid" name="csrf_name" value="${csrfName}">
          <input type="hidden" class="valid" name="csrf_value" value="${csrfValue}">
          <button class="btn-product" type="submit">
            <div class="card card-product mb-2" style="background-image: url('img/${device}/${productId}.png?v=1')">
              <div class="card-body"></div>
            </div>
          </button>
        </form>`;
    } else {
      return `
        <a class="btn-product" href="${linkAlt}">
          <div class="card card-product mb-2" style="background-image: url('img/${device}/${productId}.png?v=1')">
            <div class="card-body">
              <i class="fa-solid fa-lock"></i>
            </div>
            <div class="blur-effect"></div>
          </div>
        </a>`;
    }
  };

  const CardLink = (device, productId, link, linkAlt, isLiberado) => {
    if (isLiberado) {
      return `
        <a class="btn-product" id="product-${productId}" data-liberado="${isLiberado}" href="${link}">
          <div class="card card-product mb-2" style="background-image: url('img/${device}/${productId}.png?v=1')">
            <div class="card-body">
            </div>
          </div>
        </a>`;
    } else {
      return `
        <a class="btn-product" id="product-${productId}" data-liberado="${isLiberado}" href="${linkAlt}">
          <div class="card card-product mb-2" style="background-image: url('img/${device}/${productId}.png?v=1')">
            <div class="card-body">
              <i class="fa-solid fa-lock"></i>
            </div>
            <div class="blur-effect"></div>
          </div>
        </a>`;
    }
  }

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
    const device = ObterDispositivo(screenWidth);

    mascara.show();

    fetch(url, { method: 'GET' })
      .then(response => response.json())
      .then(json => {

        json.forEach((val) => {
          const isLiberado = val.liberado === 'S';
          const item = ObterItem(val.produto_id);

          let html = '';
          if (item != undefined) {

            if (item.tipo == 'video') {
              html = CardVideo(device, val.produto_id, val.nome_produto, item.linkAlt, isLiberado);

            } else if (item.tipo == 'link') {
              html = CardLink(device, val.produto_id, item.link, item.linkAlt, isLiberado);


            } else {
              html = CardPDF(device, val.produto_id, item.file, item.linkAlt, isLiberado, params[1], params[2]);
            }

            divProducts.append(html);
          }


        });

        divProducts.on("click", ".open-modal", function () {
          var modalbody = modalProdutos.find(".modal-body");
          var modaltitle = modalProdutos.find(".modal-title");

          var productId = $(this).data('value');
          var productName = $(this).data('name');

          const item = ObterItem(productId);

          modalbody.empty();
          var embedHtml = "";
          item.videos.forEach((video) => {

            embedHtml += `
          <div class="videos">
            <p>${video.nome}</p>
            <div class="embed-responsive">
              <iframe class="embed-responsive-item" src="${video.link}" allowfullscreen></iframe>
            </div>
          </div>
          <br>`;
          });

          modaltitle.html(productName)
          modalbody.html(embedHtml);
          modalProdutos.modal("show");
        });

        let productCard1 = $(`#product-76587`);
        let productCard2 = $(`#product-76204`);

        if(productCard1.data('liberado') === false){
          productCard1.addClass("oculto");
        }else if(productCard2.data('liberado') === false){
          productCard2.addClass("oculto");
        }

        if (productCard1.hasClass('oculto') && productCard2.hasClass('oculto')) {
          productCard2.removeClass('oculto');
        }

        mascara.hide();
      })
      .catch(error => {
        mascara.hide();
        console.log(error);
      });
  };

  const params = buscar_cliente();
  buscar_produtos(params);
});
