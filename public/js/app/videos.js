$(document).ready(function () {

  const BtnVoltar = $("#voltarBtn");

  const divEmbed = $("#embed-video");

  const links = {
    1: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f',
    2: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9a8b3ee7-32dc-406f-ace7-5b737e3743ea',
    3: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=65c7c03b-8de5-4a30-9975-a135dab28111',
    4: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=fa67df6e-bbb1-4232-a726-1c6c400072d6',
    5: 'https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=4a292c03-bf7b-4dae-a6cc-946a7a90cd8c',
  }

  const obter_embed = () => {
    const query = window.location.search;
    const params = new URLSearchParams(query);
    const id = params.get('id')
    const src = links[id];

    divEmbed.append(`<iframe class="embed-responsive-item iframe-video" src="${src}"allowfullscreen></iframe>`);
  }

  BtnVoltar.click(function () {
    window.history.back();
    window.close();
  });

  obter_embed();

});