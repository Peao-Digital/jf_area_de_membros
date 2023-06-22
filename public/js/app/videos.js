$(document).ready(function () {

  const BtnVoltar = $("#voltarBtn");
  const divEmbed = $("#embed-video");
  const divTitle = $("#aviso_video");

  const links = {
    1: { copy: "Assista a aula sobre uso do Aplicativo MEU INSS! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    2: { copy: "Assista a aula com Dr. Rafael e saiba como lidar com suas dívidas! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    3: { copy: "Assista a aula com Dr. Marcus e saiba tudo sobre imóveis! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    4: { copy: "Assista a aula com Ian Alone e saiba escolher o melhor cartão de crédito! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    5: { copy: "Assista a aula com a Dr. Tati Sampaio e saiba tudo sobre a revisão do seu benefício! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    6: { copy: "Assista a aula com a Paula e saiba como ganhar uma renda extra! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    7: { copy: "Assista a aula com o Ezequiel e saiba como investir e rentabilizar o seu dinheiro! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    8: { copy: "Assista a aula com o Felipe e saiba como aliviar as suas dores! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    9: { copy: "Assista a aula com a Jureci e saiba como ter uma alimentação mais saudável! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    10: { copy: "Assista a aula com o Mathias e saiba como ter mais saúde física! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    11: { copy: "Assista a aula com o Dr. Davi e saiba como ter ainda mais saúde! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    12: { copy: "Assista a aula com a Dr. Michele e saiba como ter uma pele de pessego! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    13: { copy: "Assista a aula com o Jr. Marabá e saiba como ter uma vida mais feliz! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    14: { copy: "Assista a aula com o Renato e saiba como ter uma memória ainda melhor! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
    15: { copy: "Assista a aula com o Dr. Gleison e saiba como ter um sono melhor! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9481606c-eb6b-4886-a6f3-aa3afd61961f" },
  }

  const obter_embed = () => {
    const query = window.location.search;
    const params = new URLSearchParams(query);
    const id = params.get('id')
    const src = links[id]['link'];

    divTitle.html(links[id]['copy']);
    divEmbed.append(`<iframe class="embed-responsive-item iframe-video" src="${src}"allowfullscreen></iframe>`);
  }

  BtnVoltar.click(function () {
    window.history.back();
    window.close();
  });

  obter_embed();

});