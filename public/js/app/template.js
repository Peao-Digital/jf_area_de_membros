$(document).ready(function () {

  const wpp = $("#btn-wpp");
  const divFlutuante = $(".div_flutuant");

  wpp.on("click", function () {

    console.log(divFlutuante.hasClass("oculto"))
    if (divFlutuante.hasClass("oculto")) {
      divFlutuante.removeClass("oculto");
    } else {
      divFlutuante.addClass("oculto");
    }
  });

});