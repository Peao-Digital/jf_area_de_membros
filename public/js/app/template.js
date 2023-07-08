$(document).ready(function () {

  const wpp = $("#btn-wpp");
  const divFlutuante = $(".div_flutuant");
  const container = $("body");

  const backbutton = $("#BackButton");

  const footer = () => {
    let dataAtual = new Date();
    let anoAtual = dataAtual.getFullYear();

    let html = `
    <footer class="footer" id="footer">
      <p>Plataforma Caminho da Riqueza</p>
      <p>Todos os direitos reservados - ${anoAtual}.</p>
    </footer>
    `;

    container.append(html);
  }

  wpp.on("click", function () {

    console.log(divFlutuante.hasClass("oculto"))
    if (divFlutuante.hasClass("oculto")) {
      divFlutuante.removeClass("oculto");
    } else {
      divFlutuante.addClass("oculto");
    }
  });


  backbutton.on("click", function () {
    window.history.back();
  });


  footer();
});